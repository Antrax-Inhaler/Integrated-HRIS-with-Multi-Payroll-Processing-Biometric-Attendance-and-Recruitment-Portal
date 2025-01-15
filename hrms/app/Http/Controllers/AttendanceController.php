<?php

namespace App\Http\Controllers;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Attendance;
use App\Models\Member;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Imports\AttendanceImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
public function index(Request $request)
{
    $startOfWeek = now()->startOfWeek();
    $endOfWeek = now()->endOfWeek();

    // Retrieve filter inputs, default to current week
    $selectedMember = $request->input('member_id');
    $startDate = $request->input('start_date', $startOfWeek->toDateString());
    $endDate = $request->input('end_date', $endOfWeek->toDateString());

    // Fetch attendance with filters
    $attendance = Attendance::with('member')
        ->when($selectedMember, function ($query, $selectedMember) {
            return $query->where('member_id', $selectedMember);
        })
        ->whereBetween('datetime_log', [$startDate, $endDate])
        ->orderBy('datetime_log', 'asc')
        ->get();

    $members = Member::all();

    return view('admin.attendance', compact('attendance', 'members', 'selectedMember', 'startDate', 'endDate'));
}

    
    

    public function destroy($id)
    {
        Attendance::findOrFail($id)->delete();
        return redirect()->route('attendance.index')->with('success', 'Attendance record deleted successfully.');
    }

    public function removeAttendance($member_id, $date)
    {
        Attendance::where('member_id', $member_id)
            ->whereDate('datetime_log', $date)
            ->delete();

        return redirect()->route('attendance.index')->with('success', 'Attendance records for the selected date deleted successfully.');
    }
    
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'log_type' => 'required|in:AM IN,AM OUT,PM IN,PM OUT',
            'datetime_log' => 'required|date',
        ]);
    
        // Extract date from datetime_log to avoid time comparison issues
        $logDate = \Carbon\Carbon::parse($request->datetime_log)->format('Y-m-d');
    
        // Check for duplicate log_type on the same day
        $existingLog = \App\Models\Attendance::where('member_id', $request->member_id)
            ->whereDate('datetime_log', $logDate)
            ->where('log_type', $request->log_type)
            ->first();
    
        if ($existingLog) {
            return redirect()->back()->withErrors([
                'log_type' => 'This log type already exists for today.',
            ]);
        }
    
        // Ensure "OUT" log is only allowed if a corresponding "IN" log exists
        if (in_array($request->log_type, ['AM OUT', 'PM OUT'])) {
            $requiredInLog = $request->log_type === 'AM OUT' ? 'AM IN' : 'PM IN';
    
            $inLogExists = \App\Models\Attendance::where('member_id', $request->member_id)
                ->whereDate('datetime_log', $logDate)
                ->where('log_type', $requiredInLog)
                ->exists();
    
            if (!$inLogExists) {
                return redirect()->back()->withErrors([
                    'log_type' => "You cannot log {$request->log_type} without a prior {$requiredInLog}.",
                ]);
            }
        }
    
        // Create the attendance log
        \App\Models\Attendance::create([
            'member_id' => $request->member_id,
            'log_type' => $request->log_type,
            'datetime_log' => $request->datetime_log,
        ]);
    
        return redirect()->route('attendance.index')->with('success', 'New attendance record added successfully.');
    }
    public function update(Request $request, $id)
{
    // Validate input
    $request->validate([
        'member_id' => 'required|exists:members,id',
        'log_type' => 'required|in:AM IN,AM OUT,PM IN,PM OUT',
        'datetime_log' => 'required|date',
    ]);

    // Extract date from datetime_log to avoid time comparison issues
    $logDate = \Carbon\Carbon::parse($request->datetime_log)->format('Y-m-d');

    // Fetch the existing attendance record to update
    $attendance = \App\Models\Attendance::findOrFail($id);

    // Check if the log type already exists for this member on the same day (excluding the current record)
    $existingLog = \App\Models\Attendance::where('member_id', $request->member_id)
        ->whereDate('datetime_log', $logDate)
        ->where('log_type', $request->log_type)
        ->where('id', '!=', $id) // Exclude current record from duplicate check
        ->first();

    if ($existingLog) {
        return redirect()->back()->withErrors([
            'log_type' => 'This log type already exists for today.',
        ]);
    }

    // Ensure "OUT" log is only allowed if a corresponding "IN" log exists
    if (in_array($request->log_type, ['AM OUT', 'PM OUT'])) {
        $requiredInLog = $request->log_type === 'AM OUT' ? 'AM IN' : 'PM IN';

        $inLogExists = \App\Models\Attendance::where('member_id', $request->member_id)
            ->whereDate('datetime_log', $logDate)
            ->where('log_type', $requiredInLog)
            ->exists();

        if (!$inLogExists) {
            return redirect()->back()->withErrors([
                'log_type' => "You cannot log {$request->log_type} without a prior {$requiredInLog}.",
            ]);
        }
    }

    // Update the attendance record
    $attendance->update([
        'member_id' => $request->member_id,
        'log_type' => $request->log_type,
        'datetime_log' => $request->datetime_log,
    ]);

    return redirect()->route('attendance.index')->with('success', 'Attendance record updated successfully.');
}

    public function showFingerprintForm()
    {
        return view('admin.fingerprint');
    }

    public function processFingerprint(Request $request)
    {
        $fingerprint_hash = $request->input('fingerprint_hash');
        $current_time = Carbon::now();
        $current_date = $current_time->format('Y-m-d');
        $current_time_str = $current_time->format('H:i:s');

        // Attempt to find the member with the matching fingerprint
        $member = Member::where('fingerprint_hash', $fingerprint_hash)->first();

        if (!$member) {
            return back()->with('error', 'Fingerprint not recognized. Please try again.');
        }

        // Check if the member already has attendance for AM IN/OUT or PM IN/OUT
        $attendance_today = Attendance::where('member_id', $member->id)
            ->whereDate('datetime_log', $current_date)
            ->get();

        $log_type = $this->determineLogType($attendance_today, $current_time);

        // Log attendance
        Attendance::create([
            'member_id' => $member->id,
            'log_type' => $log_type,
            'datetime_log' => $current_time,
        ]);

        $greeting = $this->generateGreeting($log_type);

        
        return view('admin.fingerprint_success', [
            'member' => $member,
            'greeting' => $greeting,
            'time' => $current_time_str,
        ]);
    }

    private function determineLogType($attendance_today, $current_time)
    {
        $am_in = $attendance_today->where('log_type', 'AM IN')->first();
        $pm_in = $attendance_today->where('log_type', 'PM IN')->first();

        if (!$am_in && $current_time->hour < 12) {
            return 'AM IN';
        } elseif ($am_in && !$attendance_today->where('log_type', 'AM OUT')->first() && $current_time->hour < 12) {
            return 'AM OUT';
        } elseif (!$pm_in && $current_time->hour >= 12) {
            return 'PM IN';
        } elseif ($pm_in && !$attendance_today->where('log_type', 'PM OUT')->first() && $current_time->hour >= 12) {
            return 'PM OUT';
        }

        return 'AM IN'; // Default fallback
    }

    private function generateGreeting($log_type)
    {
        if (in_array($log_type, ['AM IN', 'PM IN'])) {
            return 'Welcome!';
        } elseif (in_array($log_type, ['AM OUT', 'PM OUT'])) {
            return 'Thank you for your attendance!';
        }
        return '';
    }

public function showFingerprintImport()
{
    return view('admin.fingerprint');
}

public function importFingerprintAttendance(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls|mimetypes:application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    ]);

    $import = new AttendanceImport();

    try {
        Excel::import($import, $request->file('file'));

        if (!empty($import->errors)) {
            // Convert errors array to a MessageBag and return as warnings
            return Redirect::back()->withErrors(new MessageBag($import->errors))->with('error', 'Attendance imported with some issues.');
        }

        return Redirect::back()->with('success', 'Attendance imported successfully.');
    } catch (\Exception $e) {
        return Redirect::back()->withErrors(['error' => 'Failed to import attendance: ' . $e->getMessage()]);
    }
}

public function testImportedData($memberId)
{
    $attendanceData = Attendance::where('member_id', $memberId)->get();
    return view('admin.fingerprint', compact('attendanceData'));
}
public function showImportedData(Request $request)
    {
        $import = new AttendanceImport();
        Excel::import($import, $request->file('attendance_file'));

        return view('admin.fingerprint', [
            'attendanceData' => $import->processedData,
            'errors' => $import->errors,
        ]);
    }
public function showUploadForm(Request $request)
{
    // Fetch the latest attendance records with pagination
    $latestAttendance = DB::table('attendance')
        ->where('source', 'file')
        ->orderBy('datetime_log', 'desc')
        ->paginate(10); // Limit to 5 records per page

    // Fetch all attendance records from file source with pagination
    $allAttendance = DB::table('attendance')
        ->where('source', 'file')
        ->paginate(10); // Limit to 5 records per page

    return view('admin.upload', compact('latestAttendance', 'allAttendance'));
}

    
    public function import(Request $request)
    {
        $request->validate([
            'attendance_file' => 'required|file|mimes:txt',
        ]);
    
        $file = $request->file('attendance_file');
        $fileData = file($file->getRealPath(), FILE_IGNORE_NEW_LINES);
        
        $missingMembers = []; // Array to hold messages for missing members
        $duplicateRecords = []; // Array to hold messages for duplicate records
    
        foreach ($fileData as $index => $line) {
            // Skip the header row
            if ($index === 0) continue;
    
            $data = preg_split('/\s+/', $line);
    
            if (count($data) < 7) continue; // Skip if data is incomplete
    
            // Assuming EnNo corresponds to fingerprint_id
            $fingerprintId = (int)$data[2]; 
            $dateTime = $data[6] . ' ' . $data[7];
    
            // Convert to Carbon format
            $parsedDateTime = \Carbon\Carbon::createFromFormat('Y/m/d H:i:s', $dateTime);
    
            // Determine log type based on time
            $logType = $this->determineLogType2($parsedDateTime);
    
            // Find the member based on fingerprint_id
            $member = DB::table('members')->where('fingerprint_id', $fingerprintId)->first();
    
            if ($member) {
                // Check if the attendance record already exists
                $existingRecord = DB::table('attendance')
                    ->where('member_id', $member->id)
                    ->where('log_type', $logType)
                    ->where('datetime_log', $parsedDateTime)
                    ->first();
    
                if (!$existingRecord) {
                    // Insert attendance record with `source` set to 'file'
                    DB::table('attendance')->insert([
                        'member_id' => $member->id, // Use the member's ID
                        'log_type' => $logType,
                        'datetime_log' => $parsedDateTime,
                        'source' => 'file',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                } else {
                    // Append a message for duplicate record
                    $duplicateRecords[] = "Duplicate record found for member ID: {$member->id}, Log Type: {$logType}, DateTime: {$parsedDateTime}";
                    continue; // Skip this line if a duplicate record exists
                }
            } else {
                // Append a message for missing member
                $missingMembers[] = "No matching member found for fingerprint ID: {$fingerprintId}";
                continue; // Skip this line if no matching member
            }
        }
    
        // Prepare messages to show in the view
        $message = 'Attendance data imported successfully.';
        if (!empty($missingMembers)) {
            $message .= ' However, the following issues were encountered:';
            foreach ($missingMembers as $missing) {
                $message .= " {$missing}";
            }
        }
        if (!empty($duplicateRecords)) {
            $message .= ' Additionally, the following duplicate records were found:';
            foreach ($duplicateRecords as $duplicate) {
                $message .= " {$duplicate}";
            }
        }
    
        return redirect()->route('admin.upload')->with('success', $message);
    }
    
    
    
    // Optional helper function to determine log type based on time
    private function determineLogType2($datetimeLog)
{
    $hour = $datetimeLog->format('H');

    if ($hour < 12) {
        return 'AM IN';
    } elseif ($hour < 13) {
        return 'AM OUT';
    } elseif ($hour < 17) {
        return 'PM IN';
    } else {
        return 'PM OUT';
    }
}
        
}
