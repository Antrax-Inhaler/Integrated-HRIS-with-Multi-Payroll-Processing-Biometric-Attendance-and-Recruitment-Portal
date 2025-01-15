<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OtherInformation;
use Illuminate\Support\Facades\Auth;

class OtherInformationController extends Controller
{
    // Display all other information entries and allow for add, edit, delete
    public function index(Request $request)
    {
        // Retrieve all other information entries for the logged-in applicant
        $otherInformations = OtherInformation::where('applicant_id', Auth::id())->get();

        // If 'edit' is set, get the specific other information entry
        $editOtherInformation = null;
        if ($request->has('edit')) {
            $editOtherInformation = OtherInformation::where('applicant_id', Auth::id())
                ->where('id', $request->edit)
                ->firstOrFail();
        }

        // Return the view with the entries and the edit entry if exists
        return view('applicant.other_information', compact('otherInformations', 'editOtherInformation'));
    }

    // Store a new other information entry
    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'type' => 'required|in:Special Skill or Hobby,Non-Academic Distinction,Membership',
            'description' => 'required|string|max:255',
        ]);

        // Create the other information entry
        OtherInformation::create([
            'applicant_id' => Auth::id(),
            'type' => $request->type,
            'description' => $request->description
        ]);

        return redirect()->route('applicant.other_information');
    }

    // Update an existing other information entry
    public function update(Request $request, $id)
    {
        // Validate the input
        $request->validate([
            'type' => 'required|in:Special Skill or Hobby,Non-Academic Distinction,Membership',
            'description' => 'required|string|max:255',
        ]);

        // Find the other information entry by ID and update it
        $otherInformation = OtherInformation::where('applicant_id', Auth::id())->where('id', $id)->firstOrFail();
        $otherInformation->update($request->all());

        return redirect()->route('applicant.other_information');
    }

    // Delete an other information entry
    public function destroy($id)
    {
        // Find the other information entry by ID and delete it
        $otherInformation = OtherInformation::where('applicant_id', Auth::id())->where('id', $id)->firstOrFail();
        $otherInformation->delete();

        return redirect()->route('applicant.other_information');
    }
}
