<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Attendance;
use App\Models\Leave;
use App\Models\Notification;
use App\Models\Travel;
use App\Models\Member;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        // Get the current date
        $today = Carbon::now()->format('Y-m-d');

        // Count the number of attendees for today
        $attendeesToday = Attendance::whereDate('datetime_log', $today)->count();

        // Count the number of members on approved leave today
        // $onLeaveToday = Leave::where('status', 'Approved')
        //     ->whereDate('departure_date', '<=', $today)
        //     ->whereDate('return_date', '>=', $today)
        //     ->count();

        // Count the number of members on approved travel today
        $onTravelToday = Travel::where('status', 'approved')
            ->whereDate('departure_date', '<=', $today)
            ->whereDate('return_date', '>=', $today)
            ->count();

        // Count the number of members not verified yet
        $notVerifiedCount = Member::where('is_verified', 0)->count();

        // Count the total number of verified members
        $verifiedCount = Member::where('is_verified', 1)->count();

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

        // Return the view with the data
        return view('admin.index', compact(
            'attendeesToday', 
            'onTravelToday', 
            'notVerifiedCount', 
            'verifiedCount', 
            'dates', 
            'attendanceCounts'
        ));
    }
    // Show the profile view
    public function showProfile()
    {
        $admin = Auth::user(); // Get the currently authenticated admin
        return view('admin.profile', compact('admin'));
    }

    public function register(Request $request)
{
    // Validate the registration form data
    $validator = Validator::make($request->all(), [
        'surname' => 'required|string|max:255',
        'given_name' => 'required|string|max:255',
        'middle_name' => 'nullable|string|max:255',
        'email' => 'required|string|email|max:255|unique:members',
        'contact_number' => 'required|string|max:15',
        'password' => 'required|string|confirmed|min:8',
        'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validating the profile picture
        'valid_id' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validating the valid ID
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Handle the profile picture upload
    $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
    // Handle the valid ID upload
    $validIdPath = $request->file('valid_id')->store('valid_ids', 'public');

    // Create the new member
    $member = Member::create([
        'surname' => $request->input('surname'),
        'given_name' => $request->input('given_name'),
        'middle_name' => $request->input('middle_name'),
        'email' => $request->input('email'),
        'contact_number' => $request->input('contact_number'),
        'password' => Hash::make($request->input('password')),
        'profile_picture' => $profilePicturePath, // Save the profile picture path
        'valid_id' => $validIdPath, // Save the valid ID path
    ]);

    // Create a notification for the admin about the new member registration
    Notification::create([
        'user_id' => null, // Admin notification may not require a specific user ID
        'user_type' => 'admin', // Assuming 'admin' is the user type for this notification
        'type' => 'admin', // The type of notification
        'item_id' => $member->id, // Use the member ID as item ID
        'message' => 'A new member has registered: ' . $member->given_name . ' ' . $member->surname,
        'admin_message' => 'A new member has registered. Please review the new member registration for ' . $member->given_name . ' ' . $member->surname,
        'is_read' => 0, // Default to unread
        'is_read_admin' => 0, // Default to unread for admin
    ]);

    // Log the user in and redirect
    Auth::login($member);

    return redirect()->route('member.index'); // Redirect to a specific route
}
    
}
