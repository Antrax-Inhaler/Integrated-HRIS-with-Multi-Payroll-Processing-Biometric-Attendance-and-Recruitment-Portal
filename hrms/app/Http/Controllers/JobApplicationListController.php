<?php

namespace App\Http\Controllers;
use App\Models\JobListing;
use Illuminate\Http\Request;

class JobApplicationListController extends Controller
{
    public function index()
    {
        // Fetch job listings from the database
        $jobListings = JobListing::all();

        // Return the view with job listings data
        return view('admin.job_list', compact('jobListings'));
    }
     // Store a new job listing
     public function store(Request $request)
     {
         $request->validate([
             'job_title' => 'required|string|max:255',
             'department' => 'required|string|max:100',
             'job_type' => 'required|in:Full-time,Part-time,Contract',
             'salary_range' => 'required|string|max:50',
             'experience_level' => 'required|in:Entry-level,Mid-level,Senior-level',
             'education_requirement' => 'required|string|max:100',
             'job_description' => 'required',
             'key_responsibilities' => 'required',
             'required_skills' => 'required',
             'application_deadline' => 'required|date',
             'posted_date' => 'required|date',
         ]);
 
         JobListing::create($request->all());
 
         return redirect()->route('admin.job_list')->with('success', 'Job listing added successfully.');
     }
 
     // Update an existing job listing
     public function update(Request $request, $id)
     {
         $request->validate([
             'job_title' => 'required|string|max:255',
             'department' => 'required|string|max:100',
             'job_type' => 'required|in:Full-time,Part-time,Contract',
             'salary_range' => 'required|string|max:50',
             'experience_level' => 'required|in:Entry-level,Mid-level,Senior-level',
             'education_requirement' => 'required|string|max:100',
             'job_description' => 'required',
             'key_responsibilities' => 'required',
             'required_skills' => 'required',
             'application_deadline' => 'required|date',
             'posted_date' => 'required|date',
         ]);
 
         $jobListing = JobListing::findOrFail($id);
         $jobListing->update($request->all());
 
         return redirect()->route('admin.job_list')->with('success', 'Job listing updated successfully.');
     }
 
     // Delete a job listing
     public function destroy($id)
     {
         $jobListing = JobListing::findOrFail($id);
         $jobListing->delete();
 
         return redirect()->route('admin.job_list')->with('success', 'Job listing deleted successfully.');
     }
}
