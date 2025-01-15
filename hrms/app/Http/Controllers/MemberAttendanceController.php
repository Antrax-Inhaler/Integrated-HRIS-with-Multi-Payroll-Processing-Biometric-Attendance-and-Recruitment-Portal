<?php

namespace App\Http\Controllers;
use App\Models\Attendance;
use App\Models\Member;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class MemberAttendanceController extends Controller
{
    public function showMemberAttendance(Request $request)
    {
        $userId = Auth::id(); // Get the ID of the currently logged-in user

        // Retrieve filter inputs
        $logType = $request->input('log_type');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Build query with optional filters
        $attendanceQuery = Attendance::where('member_id', $userId);

        if ($logType) {
            $attendanceQuery->where('log_type', $logType);
        }

        if ($startDate) {
            $attendanceQuery->whereDate('datetime_log', '>=', $startDate);
        }

        if ($endDate) {
            $attendanceQuery->whereDate('datetime_log', '<=', $endDate);
        }

        $attendance = $attendanceQuery->orderBy('datetime_log', 'asc')->get();

        return view('member.attendance', compact('attendance', 'logType', 'startDate', 'endDate'));
    }
}
