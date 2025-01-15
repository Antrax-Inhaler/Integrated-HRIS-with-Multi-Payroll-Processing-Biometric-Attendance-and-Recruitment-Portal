<?php

namespace App\Http\Controllers;

use App\Models\Requirement;
use App\Models\JobListing;
use Illuminate\Http\Request;

class RequirementsController extends Controller
{
    public function index()
    {
        $requirements = Requirement::with('jobListing')->get(); // Include job listing data
        $jobListings = JobListing::all(); // Fetch all job listings for the dropdown

        return view('admin.requirements', compact('requirements', 'jobListings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'job_listing_id' => 'required|exists:job_listings,id',
            'requirement_name' => 'required|string|max:255',
            'file_path' => 'required|string|max:255',
        ]);

        Requirement::create($request->all());

        return redirect()->route('admin.requirements.index')->with('success', 'Requirement added successfully.');
    }
}
