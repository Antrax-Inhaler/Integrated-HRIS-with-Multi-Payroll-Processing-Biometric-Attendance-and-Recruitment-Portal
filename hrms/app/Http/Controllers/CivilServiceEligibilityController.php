<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CivilServiceEligibility;
use Illuminate\Support\Facades\Auth;

class CivilServiceEligibilityController extends Controller
{
    // Display the list of civil service eligibilities and show the form for creating or editing
    public function index(Request $request)
    {
        $applicantId = Auth::id();
        $civilServices = CivilServiceEligibility::where('applicant_id', $applicantId)->get();

        // If there's an ID in the request, we are editing; otherwise, we're adding a new one
        $civilService = null;
        if ($request->has('id')) {
            $civilService = CivilServiceEligibility::find($request->id);
        }

        // Return the view with civil service records and the current record for editing (if applicable)
        return view('applicant.civilserviceeligibility', compact('civilServices', 'civilService'));
    }

    // Store or update a civil service eligibility
    public function save(Request $request)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'career_service' => 'required|string|max:255',
            'rating' => 'nullable|numeric|min:0|max:100',
            'date_of_examination' => 'required|date',
            'place_of_examination' => 'required|string|max:255',
            'license_number' => 'nullable|string|max:100',
            'license_validity' => 'nullable|date',
        ]);

        $applicantId = Auth::id();

        // If there's an ID, we're updating; otherwise, we're creating a new record
        if ($request->has('id')) {
            $civilService = CivilServiceEligibility::findOrFail($request->id);
            $civilService->update(array_merge($validatedData, ['applicant_id' => $applicantId]));
        } else {
            CivilServiceEligibility::create(array_merge($validatedData, ['applicant_id' => $applicantId]));
        }

        return redirect()->route('civilserviceeligibility.index')->with('success', 'Civil Service Eligibility saved successfully!');
    }

    // Delete a civil service eligibility
    public function destroy($id)
    {
        $civilService = CivilServiceEligibility::findOrFail($id);
        $civilService->delete();

        return redirect()->route('civilserviceeligibility.index')->with('success', 'Civil Service Eligibility deleted successfully!');
    }
}
