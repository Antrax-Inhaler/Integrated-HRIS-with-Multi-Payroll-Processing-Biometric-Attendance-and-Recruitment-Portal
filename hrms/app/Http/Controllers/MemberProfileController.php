<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MemberProfileController extends Controller
{
    // Display the member profile page
    public function showProfile()
    {
        // Get the authenticated member
        $member = Auth::user();

        // Return the profile view with member data
        return view('member.profile', compact('member'));
    }

    // Update the member profile
    public function updateProfile(Request $request)
    {
        $member = Auth::user();

        // Validate the profile form data, including password rules
        $request->validate([
            'surname' => 'required|string|max:255',
            'given_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:members,email,' . $member->id,
            'contact_number' => 'required|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'valid_id' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|string|min:8|confirmed|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/',
        ], [
            'password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
        ]);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete the old profile picture if exists
            if ($member->profile_picture) {
                Storage::delete($member->profile_picture);
            }
            $path = $request->file('profile_picture')->store('profile_pictures');
            $member->profile_picture = $path;
        }

        // Handle valid ID upload
        if ($request->hasFile('valid_id')) {
            if ($member->valid_id) {
                Storage::delete($member->valid_id);
            }
            $validIdPath = $request->file('valid_id')->store('valid_ids');
            $member->valid_id = $validIdPath;
        }

        // Update the password if provided
        if ($request->filled('password')) {
            $member->password = Hash::make($request->password);
        }

        // Update other fields
        $member->update($request->except(['profile_picture', 'valid_id', 'password']));

        // Redirect back to the profile page with success message
        return redirect()->route('member.profile')->with('success', 'Profile updated successfully.');
    }
}
