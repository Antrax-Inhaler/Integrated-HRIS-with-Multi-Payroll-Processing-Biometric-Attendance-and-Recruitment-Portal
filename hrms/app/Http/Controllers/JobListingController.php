<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobListingController extends Controller
{
    // Display a listing of the job listings with optional search functionality
    public function index(Request $request)
    {
        $search = $request->input('search');
        $jobType = $request->input('job_type');
    
        // Retrieve job listings with search and filter logic
        $jobListings = JobListing::query();
    
        if ($search) {
            $jobListings->where(function ($query) use ($search) {
                $query->where('job_title', 'LIKE', "%{$search}%")
                      ->orWhere('department', 'LIKE', "%{$search}%")
                      ->orWhere('job_description', 'LIKE', "%{$search}%");
            });
        }
    
        if ($jobType) {
            $jobListings->where('job_type', $jobType);
        }
    
        $jobListings = $jobListings->get();
    
        $applicantName = Auth::guard('applicant')->user()->name ?? 'Guest';
    
        return view('applicant.index', compact('jobListings', 'applicantName'));
    }
    

    // Display the job details for a specific job ID
    public function show($jobId)
    {
        $job = JobListing::findOrFail($jobId); // Find the job by ID, 404 if not found

        return view('job_applications.apply', compact('job'));
    }

    // Handle the job application
    public function apply($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect to login if not authenticated
        }

        $job = JobListing::findOrFail($id);
        // Handle the application logic here, e.g., save application, show confirmation

        return view('job_applications.apply', compact('job'));
    }
}
