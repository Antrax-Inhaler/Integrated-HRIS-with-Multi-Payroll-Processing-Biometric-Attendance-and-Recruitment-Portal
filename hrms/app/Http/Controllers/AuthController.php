<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Member;
use App\Models\Notification;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('login'); // Assuming your login view is in resources/views/login.blade.php
    }

    // Handle the login request
    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    // Check if email exists in the admins table
    $admin = Admin::where('email', $credentials['email'])->first();
    if ($admin && Hash::check($credentials['password'], $admin->password)) {
        // Login the admin
        Auth::guard('admin')->login($admin);
        $currentDateTime = now()->toDateTimeString();

        // Create a notification for the admin
        Notification::create([
            'user_id' => $admin->id,
            'user_type' => 'admin',
            'type' => 'admin',
            'item_id' => $admin->id,
            'message' => 'You have successfully logged in on ' . $currentDateTime . '.',
            'admin_message' => $admin->name . ' has logged in on ' . $currentDateTime . '.',
            'is_read' => 0,
            'is_read_admin' => 0,
        ]);

        return redirect()->route('admin.index')->with('success', 'Welcome back, ' . $admin->name . '!');
    }

    // Check if email exists in the members table
    $member = Member::where('email', $credentials['email'])->first();
    if ($member && Hash::check($credentials['password'], $member->password)) {
        // Login the member
        Auth::guard('member')->login($member);
        $currentDateTime = now()->toDateTimeString();

        // Create a notification for the member
        Notification::create([
            'user_id' => $member->id,
            'user_type' => 'member',
            'type' => 'admin',
            'item_id' => $member->id,
            'message' => 'You have successfully logged in on ' . $currentDateTime . '.',
            'admin_message' => 'New member ' . $member->given_name . ' ' . $member->surname . ' has logged in on ' . $currentDateTime . '.',
            'is_read' => 0,
            'is_read_admin' => 0,
        ]);

        return redirect()->route('member.index')->with('success', 'Welcome back, ' . $member->given_name . '!');
    }

    // If login fails for both, redirect back with error message
    return redirect()->back()->withErrors(['email' => 'The provided credentials do not match our records.']);
}

    
    // Show the registration form
    public function showRegisterForm()
    {
        return view('register'); // Assuming your register view is in resources/views/register.blade.php
    }

    // Handle the registration request
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
            'admin_message' => 'Please review the new member registration for ' . $member->given_name . ' ' . $member->surname,
            'is_read' => 0, // Default to unread
            'is_read_admin' => 0, // Default to unread for admin
        ]);
    
        // Log the user in and redirect
        Auth::login($member);
    
        return redirect()->route('member.index')->with('success', 'Registration successful! Welcome, ' . $member->given_name . '! You can now login and wait for the administrator to verify your account.');
}

    

    public function logout()
    {
        Auth::logout(); // This method logs out the currently authenticated user
        return redirect()->route('login')->with('status', 'You have been logged out.');
    }
}
