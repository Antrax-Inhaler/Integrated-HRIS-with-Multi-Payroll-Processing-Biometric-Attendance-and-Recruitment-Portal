<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Member;
use App\Models\Notification;
use App\Models\Department;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MemberController extends Controller
{
    /**
     * Show the profile of the currently logged-in member.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch the currently logged-in member
        $member = Auth::user();

        // Get the current date
        $today = Carbon::today();

        // Fetch the member's attendance logs for today
        $logs = DB::table('attendance')
            ->where('member_id', $member->id)
            ->whereDate('datetime_log', $today)
            ->orderBy('datetime_log')
            ->get();

        // Calculate the total hours worked
        $totalHours = $this->calculateTotalHours($logs);

        // Return the view with the member and total hours worked
        return view('member.index', compact('member', 'totalHours'));
    }
    
    public function getLogNotifications()
    {
        // Fetch notifications with the specific message for the logged-in user
        $notifications = Notification::where('user_type', 'member')
            ->where('user_id', Auth::id())
            ->where('message', 'LIKE', '%You have successfully logged%')
            ->orderBy('created_at', 'desc')
            ->get();

        // Return the logs view with the notifications
        return view('member.logs', compact('notifications'));
    }


    /**
     * Calculate total working hours from attendance logs.
     *
     * @param  \Illuminate\Support\Collection  $logs
     * @return float
     */
    private function calculateTotalHours($logs)
    {
        $totalMinutes = 0;

        // Group logs by AM/PM shifts
        $shifts = [
            'am' => ['in' => null, 'out' => null],
            'pm' => ['in' => null, 'out' => null],
        ];

        // Assign logs to respective shifts
        foreach ($logs as $log) {
            if ($log->log_type === 'AM IN') {
                $shifts['am']['in'] = Carbon::parse($log->datetime_log);
            } elseif ($log->log_type === 'AM OUT') {
                $shifts['am']['out'] = Carbon::parse($log->datetime_log);
            } elseif ($log->log_type === 'PM IN') {
                $shifts['pm']['in'] = Carbon::parse($log->datetime_log);
            } elseif ($log->log_type === 'PM OUT') {
                $shifts['pm']['out'] = Carbon::parse($log->datetime_log);
            }
        }

        // Calculate minutes for each shift
        foreach ($shifts as $shift) {
            if ($shift['in'] && $shift['out']) {
                $totalMinutes += $shift['out']->diffInMinutes($shift['in']);
            }
        }

        // Convert total minutes to hours
        return round($totalMinutes / 60, 2);
    }
}
