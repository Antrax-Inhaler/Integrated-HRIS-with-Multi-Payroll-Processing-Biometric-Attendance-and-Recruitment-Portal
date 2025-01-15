<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Leave;
use App\Models\Travel;
use App\Models\Member;
use App\Models\JobApplication;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class AdminDashboardController extends Controller
{
    // Function to show the admin dashboard
    public function index() 
{
    // Get the current date
    $today = Carbon::now()->format('Y-m-d');

    // Count the number of attendees for today
    $attendeesToday = Attendance::whereDate('datetime_log', $today)->count();

    // Count the number of members on approved leave today
    $onLeaveToday = Leave::where('status', 'Approved')
        ->whereDate('start_date', '<=', $today)
        ->whereDate('end_date', '>=', $today)
        ->count();

    // Count the number of members on approved travel today
    $onTravelToday = Travel::where('status', 'approved')
        ->whereDate('start_date', '<=', $today)
        ->whereDate('end_date', '>=', $today)
        ->count();
        $jobApplicationData = $this->jobApplicationStatus();
        $leaveTravelData = $this->leaveAndTravelStatus();
    // Count the number of members not verified yet
    $notVerifiedCount = Member::where('is_verified', 0)->count();

    // Count the total number of verified members
    $verifiedCount = Member::where('is_verified', 1)->count();

    // Count the number of pending job applications
    $pendingJobApplicationsCount = JobApplication::where('status', 'Pending')->count();

    // Get attendance counts for the last 7 days
    $attendanceData = Attendance::selectRaw('DATE(datetime_log) as date, COUNT(*) as count')
        ->whereDate('datetime_log', '>=', Carbon::now()->subDays(7))
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->get();

    // Format the data for the chart
    $dates = [];
    $attendanceCounts = [];
    foreach ($attendanceData as $data) {
        $dates[] = $data->date;
        $attendanceCounts[] = $data->count;
    }

    // Get the list of employees who are currently logged in (not logged out)
    $loggedInEmployees = Member::whereIn('id', function ($query) use ($today) {
            $query->select('member_id')
                  ->from('attendance')
                  ->whereDate('datetime_log', $today)
                  ->where(function ($subQuery) {
                      $subQuery->where('log_type', 'AM IN')
                               ->orWhere('log_type', 'PM IN');
                  })
                  ->whereNotIn('member_id', function ($subQuery) use ($today) {
                      $subQuery->select('member_id')
                                ->from('attendance')
                                ->whereDate('datetime_log', $today)
                                ->where(function ($innerQuery) {
                                    $innerQuery->where('log_type', 'AM OUT')
                                               ->orWhere('log_type', 'PM OUT');
                                });
                  })
                  ->groupBy('member_id');
        })
        ->get();

    // Return the view with the data
    return view('admin.index', compact(
        'attendeesToday', 
        'onLeaveToday', 
        'onTravelToday', 
        'notVerifiedCount', 
        'verifiedCount', 
        'dates', 
        'attendanceCounts',
        'loggedInEmployees', // Added this line to pass the logged-in employees
        'pendingJobApplicationsCount',
        'jobApplicationData', 'leaveTravelData' // Added this line for pending job applications
    ));
}
public function jobApplicationStatus()
{
    $statuses = ['Pending', 'Interview', 'Offered', 'Rejected'];

    $applicationCounts = JobApplication::select('status', DB::raw('COUNT(*) as count'))
        ->groupBy('status')
        ->pluck('count', 'status')
        ->toArray();

    // Ensure all statuses are represented in the data
    $formattedData = [];
    foreach ($statuses as $status) {
        $formattedData[$status] = $applicationCounts[$status] ?? 0;
    }

    return $formattedData;
}
public function leaveAndTravelStatus()
{
    $today = Carbon::now()->format('Y-m-d');

    // Count employees on approved leave today
    $leaveCount = Leave::where('status', 'Approved')
        ->whereDate('start_date', '<=', $today)
        ->whereDate('end_date', '>=', $today)
        ->count();

    // Count employees on approved travel today
    $travelCount = Travel::where('status', 'approved')
        ->whereDate('start_date', '<=', $today)
        ->whereDate('end_date', '>=', $today)
        ->count();

    return [
        'Leave' => $leaveCount,
        'Travel' => $travelCount
    ];
}

}
