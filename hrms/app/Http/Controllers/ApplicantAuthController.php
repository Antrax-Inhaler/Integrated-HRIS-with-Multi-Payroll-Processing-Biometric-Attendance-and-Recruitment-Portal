<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Applicant;
use Illuminate\Support\Facades\Log;

class ApplicantAuthController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('applicant.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        Log::info('Login attempt', ['email' => $credentials['email']]);
    
        if (Auth::guard('applicant')->attempt($credentials)) {
            Log::info('Login successful', ['email' => $credentials['email']]);
            return redirect()->intended('/applicant/');

        }
    
        Log::warning('Login failed', ['email' => $credentials['email']]);
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Show registration form
    public function showRegisterForm()
    {
        return view('applicant.register');
    }

    // Handle registration
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:applicants',
            'password' => 'required|string|min:6|confirmed',
            'contact_number' => 'required|string|max:255',
        ]);

        $applicant = new Applicant();
        $applicant->name = $request->name;
        $applicant->email = $request->email;
        $applicant->password = Hash::make($request->password);
        $applicant->contact_number = $request->contact_number;
        $applicant->save();

        Auth::guard('applicant')->login($applicant);
        return redirect()->intended('/applicant');
    }

    // Logout
    public function logout()
    {
        Auth::guard('applicant')->logout();
        return redirect('/applicant/login');
    }
    public function showProfile()
    {
        $applicantName = Auth::guard('applicant')->user()->name;
        $applicant = Auth::guard('applicant')->user();
        return view('applicant.profile', compact('applicant', 'applicantName'));
    }

    /**
     * Update the applicant's profile information.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:applicants,email,' . Auth::id(),
            'contact_number' => 'required|string|max:255',
        ]);

        $applicant = Auth::guard('applicant')->user();
        $applicant->update([
            'name' => $request->name,
            'email' => $request->email,
            'contact_number' => $request->contact_number,
        ]);

        return redirect()->route('applicant.profile')->with('success', 'Profile updated successfully.');
    }

    /**
     * Update the applicant's password.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        $applicant = Auth::guard('applicant')->user();

        // Verify current password
        if (!Hash::check($request->current_password, $applicant->password)) {
            return redirect()->route('applicant.profile')->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        // Update the password
        $applicant->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('applicant.profile')->with('success', 'Password updated successfully.');
    }
}
