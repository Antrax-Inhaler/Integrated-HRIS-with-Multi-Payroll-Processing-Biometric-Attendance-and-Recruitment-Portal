<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\PayrollItem;
use App\Models\Member;
use App\Models\Attendance;
use App\Models\MemberBonus;
use App\Models\MemberDeduction;
use App\Models\Holiday;
use App\Models\LateDeduction;
use App\Models\AddCom;
use App\Models\PeraAca;
use Carbon\Carbon;
use PDF;

use Illuminate\Http\Request;


class JobOrderPayrollController extends Controller
{
    function showPayroll() 
    {
        $payrolls = Payroll::with(['payrollItems.member'])
            ->where('type', 'monthly') // Filter payrolls by type 'monthly'
            ->whereHas('payrollItems.member', function ($query) {
                $query->where('employment_status', 'job_order'); // Filter members by 'job_order'
            })
            ->get();
    
        return view('admin.payroll_job_order_monthly', compact('payrolls'));
    }

    // Store new payroll record
    public function store(Request $request)
    {
        // Validate the date inputs
        $request->validate([
            'dateFrom' => 'required|date',
            'dateTo' => 'required|date|after_or_equal:dateFrom',
        ]);
    
        $dateFrom = Carbon::parse($request->dateFrom)->startOfDay(); // Start of the selected range
        $dateTo = Carbon::parse($request->dateTo)->endOfDay();       // End of the selected range
    
        // Create a new payroll record with the specified date range
        $payroll = Payroll::create([
            'ref_no' => 'PAY-' . now()->format('Y-m-d-H-i-s'), // Generates ref_no as PAY-YYYY-MM-DD-HH-MM-SS
            'date_from' => $dateFrom,                          // Use the selected dateFrom
            'date_to' => $dateTo,                              // Use the selected dateTo
            'status' => 'computed',
        ]);
    
        // Fetch members who are verified and have employment status set to 'job_order'
        $members = Member::where('is_verified', 1)
                         ->where('employment_status', 'job_order')
                         ->get();
    
        foreach ($members as $member) {
            // Call the updatePayrollItem method with the selected date range
            $this->updatePayrollItem($payroll, $dateFrom, $dateTo, $member);
        }
    
        return redirect()->route('admin.payroll_job_order_monthly')->with('message', 'Payroll computed successfully.');
    }
    
    

    // Update payroll item for each member
    private function updatePayrollItem($payroll, $dateFrom, $dateTo, $member)
    {
        $attendanceRecords = Attendance::where('member_id', $member->id)
                                       ->whereBetween('datetime_log', [$dateFrom, $dateTo])
                                       ->whereRaw('DAYOFWEEK(datetime_log) != 1') // Exclude Sundays
                                       ->get()
                                       ->groupBy(function ($date) {
                                           return Carbon::parse($date->datetime_log)->format('Y-m-d');
                                       });
    
        $totalHoursWorkedAM = 0;
        $totalHoursWorkedPM = 0;
        $totalHolidayPay = 0;
        $totalUndertimeHours = 0;
    
        foreach ($attendanceRecords as $date => $logs) {
            $amIn = $logs->where('log_type', 'AM IN')->first();
            $amOut = $logs->where('log_type', 'AM OUT')->first();
            $pmIn = $logs->where('log_type', 'PM IN')->first();
            $pmOut = $logs->where('log_type', 'PM OUT')->first();
    
            $dailyHoursWorked = 0;
    
            // Calculate AM Shift Hours
            if ($amIn && $amOut) {
                $amHours = $amIn->datetime_log->diffInHours($amOut->datetime_log, true);
                $totalHoursWorkedAM += $amHours;
                $dailyHoursWorked += $amHours;
            }
    
            // Calculate PM Shift Hours
            if ($pmIn && $pmOut) {
                $pmHours = $pmIn->datetime_log->diffInHours($pmOut->datetime_log, true);
                $totalHoursWorkedPM += $pmHours;
                $dailyHoursWorked += $pmHours;
            }
    
            // Calculate holiday pay
            if ($this->isHoliday($date)) {
                $totalHolidayPay += max(8, $dailyHoursWorked);
            } else {
                // Check for undertime if it's a regular day and hours worked < 8
                if ($dailyHoursWorked < 8) {
                    $totalUndertimeHours += (8 - $dailyHoursWorked);
                }
            }
        }
    
        // Total hours worked
        $totalHoursWorked = $totalHoursWorkedAM + $totalHoursWorkedPM;
    
        // Calculate hourly rate (assuming it's stored in $member->salary for job order employees)
        $hourlyRate = $member->salary;
    
        // Calculate gross salary based on hourly rate and total hours
        $grossSalary = ($totalHoursWorked * $hourlyRate) + $totalHolidayPay;
        $bonuses = $this->calculateBonuses($member);
    
        // Add add_com and pera_aca if effective this month
        $monthYear = Carbon::parse($dateFrom)->format('Y-m-01');
        $addComTotal = AddCom::where('member_id', $member->id)->where('month_year', $monthYear)->sum('amount');
        $peraAcaTotal = PeraAca::where('member_id', $member->id)->where('month_year', $monthYear)->sum('amount');
        
        $grossSalary += $addComTotal + $peraAcaTotal;
    
        // Calculate undertime deduction
        $undertimeDeduction = $totalUndertimeHours * $hourlyRate;
    
        // Set late deduction and count to zero for job order employees
        $lateDeduction = 0;
        $lateCount = 0;
    
        // Calculate total deductions
        $deductionsData = $this->calculateDeductions($member, $lateCount, $dateFrom, $dateTo);
        $totalDeductions = $deductionsData['total'] + $undertimeDeduction;
    
        // Calculate net salary
        $netSalary = $grossSalary + $bonuses - $totalDeductions;
    
        // Store payroll item with hourly rate and undertime details
        PayrollItem::updateOrCreate(
            ['payroll_id' => $payroll->id, 'member_id' => $member->id],
            [
                'gross_salary' => $grossSalary,
                'deductions' => $totalDeductions,
                'net_salary' => $netSalary,
                'late_deduction' => $lateDeduction,
                'late_count' => $lateCount,
                'total_hours' => $totalHoursWorked,
                'hourly_rate' => $hourlyRate,
                'undertime_hours' => $totalUndertimeHours, // Save undertime hours here
                'undertime_deduction' => $undertimeDeduction, // Save undertime deduction
                'add_com_total' => $addComTotal,
                'pera_aca_total' => $peraAcaTotal,
            ]
        );
    }
    

    
    
    
    // Calculate total deductions including late penalties and specific member deductions
    private function calculateDeductions($member, $lateCount, $dateFrom, $dateTo)
    {
        // Ensure $dateFrom is a Carbon instance
        $dateFrom = Carbon::parse($dateFrom);
    
        $deductions = MemberDeduction::where('member_id', $member->id)
                                     ->whereBetween('effective_date', [$dateFrom, $dateTo])
                                     ->sum('amount');
    
        // Calculate late penalty only if a penalty amount exists for the month
        $latePenalty = LateDeduction::where('effective_month', $dateFrom->format('Y-m-01'))->first()->amount ?? 0;
        $late_deduction = $lateCount * $latePenalty;
    
        // Add late deduction to the total deductions
        $deductions += $late_deduction;
    
        // Return both total deductions and the separate late deduction
        return ['total' => $deductions, 'late_deduction' => $late_deduction];
    }

    // Calculate total bonuses for the member
    private function calculateBonuses($member)
    {
        return MemberBonus::where('member_id', $member->id)->sum('amount');
    }

    // Check if the given date is a holiday
    private function isHoliday($date)
    {
        return Holiday::where('holiday_date', $date)->exists();
    }

    public function destroy($id)
    {
        $payroll = Payroll::findOrFail($id);
        $payroll->items()->delete();
        $payroll->delete();

        return redirect()->route('payrollJO.show')->with('success', 'Payroll deleted successfully.');
    }
    // Show detailed payroll information
public function show($id)
{
    // Fetch payroll details with related payroll items and their associated member
    $payroll = Payroll::with('payrollItems.member')->findOrFail($id);

    // Loop through each payroll item to gather additional data (attendances, deductions, bonuses)
    foreach ($payroll->payrollItems as $item) {
        $totalAMHours = 0;
        $totalPMHours = 0;

        // Fetch and group attendances by date
        $attendances = Attendance::where('member_id', $item->member_id)
            ->whereBetween('datetime_log', [$payroll->date_from, $payroll->date_to])
            ->get()
            ->groupBy(function ($attendance) {
                return $attendance->datetime_log->toDateString();
            });

        // Structure attendances with each date containing in/out times and total hours worked
        $item->groupedAttendances = $attendances->map(function ($logs) use (&$totalAMHours, &$totalPMHours) {
            $amIn = optional($logs->firstWhere('log_type', 'AM IN'))->datetime_log;
            $amOut = optional($logs->firstWhere('log_type', 'AM OUT'))->datetime_log;
            $pmIn = optional($logs->firstWhere('log_type', 'PM IN'))->datetime_log;
            $pmOut = optional($logs->firstWhere('log_type', 'PM OUT'))->datetime_log;

            // Calculate hours for AM and PM shifts
            $amHours = $amIn && $amOut ? $amIn->diffInHours($amOut) : 0;
            $pmHours = $pmIn && $pmOut ? $pmIn->diffInHours($pmOut) : 0;

            // Add to totals
            $totalAMHours += $amHours;
            $totalPMHours += $pmHours;

            return [
                'date' => $logs->first()->datetime_log->toDateString(),
                'am_in' => $amIn ? $amIn->format('H:i') : 'N/A',
                'am_out' => $amOut ? $amOut->format('H:i') : 'N/A',
                'pm_in' => $pmIn ? $pmIn->format('H:i') : 'N/A',
                'pm_out' => $pmOut ? $pmOut->format('H:i') : 'N/A',
                'total_hours' => $amHours + $pmHours,
            ];
        })->values()->all();

        // Set total hours worked for AM, PM, and combined total hours
        $item->totalHoursWorked = [
            'AM' => $totalAMHours,
            'PM' => $totalPMHours,
            'Total' => $totalAMHours + $totalPMHours,
        ];

        // Fetch deductions and bonuses
        $item->deductions = MemberDeduction::where('member_id', operator: $item->member_id)
            ->whereBetween('effective_date', [$payroll->date_from, $payroll->date_to])
            ->get();
        $item->bonuses = MemberBonus::where('member_id', $item->member_id)
            ->whereBetween('effective_date', [$payroll->date_from, $payroll->date_to])
            ->get();

        // Calculate totals
        $item->totalDeductions = $item->deductions->sum('amount');
        $item->totalBonuses = $item->bonuses->sum('amount');
    }

    // Return the view with payroll details
    return view('admin.payroll_job_order_monthly_detail', compact('payroll'));
}


    

// Helper method to calculate hours worked based on IN and OUT logs
private function calculateHoursWorked($inLogs, $outLogs)
{
    $total = 0;

    // Ensure that both IN and OUT logs are paired correctly
    $inCount = count($inLogs);
    $outCount = count($outLogs);

    // Use the minimum of IN and OUT logs for calculations
    $pairs = min($inCount, $outCount);

    for ($i = 0; $i < $pairs; $i++) {
        // Calculate the difference in hours for each paired IN and OUT log
        $total += Carbon::parse($outLogs[$i])->diffInHours(Carbon::parse($inLogs[$i]));
    }

    return $total;
}
public function recalculate(Request $request, $payrollId)
{
    // Retrieve the existing payroll record
    $payroll = Payroll::findOrFail($payrollId);
    $dateFrom = Carbon::parse($payroll->date_from)->startOfDay(); // Start of the selected date
    $dateTo = Carbon::parse($payroll->date_to)->endOfDay();

    // Fetch members who are verified and have employment status set to 'job_order'
    $members = Member::where('is_verified', 1)
                     ->where('employment_status', 'job_order')
                     ->get();

    // Clear existing payroll items for this payroll
    PayrollItem::where('payroll_id', $payroll->id)->delete();

    foreach ($members as $member) {
        // Pass $payroll as the first argument in the method call
        $this->updatePayrollItem($payroll, $dateFrom, $dateTo, $member);
    }

    return redirect()->route('admin.payrollJO.show', $payroll->id)
    ->with('message', 'Payroll recalculated successfully');
}

public function updateStatus(Request $request, $id)
{
    // Validate the new status
    $request->validate([
        'status' => 'required|in:New,Computed,Paid',
    ]);

    // Find the payroll record by ID
    $payroll = Payroll::findOrFail($id);

    // Update the status field
    $payroll->status = $request->status;
    $payroll->save();

    // Redirect back to the payroll view with success message
    return redirect()->route('admin.payroll_job_order_monthly')
                     ->with('success', 'Payroll status updated successfully.');
}

public function printPayroll($payrollId)
{
    $payroll = Payroll::with('payrollItems.member')->findOrFail($payrollId);

    $data = [
        'payroll' => $payroll,
    ];

    $pdf = app('dompdf.wrapper');
    $pdf->getDomPDF()->set_option("enable_php", true);
    
    // Set paper size and orientation, add headers/footers for pagination
    $pdf = PDF::loadView('admin.printPayroll', $data)
        ->setPaper([0, 0, 612, 936], 'landscape')
        ->setOption('footer-center', 'Page [page] of [topage]')
        ->setOption('footer-font-size', 10);

    // Create a detailed file name using payroll data
    $startDate = \Carbon\Carbon::parse($payroll->date_from)->format('Y-m-d');
    $endDate = \Carbon\Carbon::parse($payroll->date_to)->format('Y-m-d');
    $fileName = "Payroll_Details_{$payroll->id}_From_{$startDate}_To_{$endDate}.pdf";

    return $pdf->stream($fileName);
}
public function printPayrollPayslip($payrollId) 
{
    $payroll = Payroll::with(['payrollItems.member'])->findOrFail($payrollId);
    $payrollData = [];

    foreach ($payroll->payrollItems as $item) {
        $memberId = $item->member_id;
        $fromDate = $payroll->date_from;
        $toDate = $payroll->date_to;

        // Fetch bonuses for the member in the given date range
        $bonuses = MemberBonus::where('member_id', $memberId)
            ->whereBetween('effective_date', [$fromDate, $toDate])
            ->select('bonus_name', 'amount')
            ->get();

        // Fetch deductions directly from the member_deductions table
        $deductions = MemberDeduction::where('member_id', $memberId)
            ->whereBetween('effective_date', [$fromDate, $toDate])
            ->select('deduction_name', 'amount')
            ->get();

        $payrollData[] = [
            'item' => $item,
            'bonuses' => $bonuses,
            'deductions' => $deductions,
        ];
    }

    $data = [
        'payroll' => $payroll, // Redirect back to the payroll view with success message
        'payrollData' => $payrollData,
    ];

    $pdf = app('dompdf.wrapper');
    $pdf->getDomPDF()->set_option("enable_php", true);
    $pdf->loadView('admin.payslip', $data);

    return $pdf->stream('Payslip_' . $payroll->id . '.pdf');
}
}
