<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VoluntaryWork;
use Illuminate\Support\Facades\Auth;
class VoluntaryWorkController extends Controller
{
    // Show the form with all voluntary work entries, including the one for editing
    public function index(Request $request)
    {
        // Retrieve all voluntary work entries for the logged-in applicant
        $voluntaryWorks = VoluntaryWork::where('applicant_id', Auth::id())->get();

        // If an 'edit' parameter is present, retrieve the specific voluntary work entry
        $editWork = null;
        if ($request->has('edit')) {
            $editWork = VoluntaryWork::where('applicant_id', Auth::id())
                                     ->where('id', $request->edit)
                                     ->firstOrFail();
        }

        // Pass the entries and the edit entry (if any) to the view
        return view('applicant.voluntarywork', compact('voluntaryWorks', 'editWork'));
    }

    // Store a new voluntary work entry
    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'organization_name' => 'required|string|max:255',
            'organization_address' => 'required|string|max:255',
            'position_nature_of_work' => 'required|string|max:255',
            'inclusive_dates_from' => 'required|date',
            'inclusive_dates_to' => 'required|date|after_or_equal:inclusive_dates_from',
            'number_of_hours' => 'required|integer|min:1',
        ]);

        // Create the voluntary work entry
        VoluntaryWork::create([
            'applicant_id' => Auth::id(),
            'organization_name' => $request->organization_name,
            'organization_address' => $request->organization_address,
            'position_nature_of_work' => $request->position_nature_of_work,
            'inclusive_dates_from' => $request->inclusive_dates_from,
            'inclusive_dates_to' => $request->inclusive_dates_to,
            'number_of_hours' => $request->number_of_hours
        ]);

        return redirect()->route('applicant.voluntarywork');
    }

    // Update an existing voluntary work entry
    public function update(Request $request, $id)
    {
        // Validate the input
        $request->validate([
            'organization_name' => 'required|string|max:255',
            'organization_address' => 'required|string|max:255',
            'position_nature_of_work' => 'required|string|max:255',
            'inclusive_dates_from' => 'required|date',
            'inclusive_dates_to' => 'required|date|after_or_equal:inclusive_dates_from',
            'number_of_hours' => 'required|integer|min:1',
        ]);

        // Find the voluntary work entry by ID and update it
        $voluntaryWork = VoluntaryWork::where('applicant_id', Auth::id())->where('id', $id)->firstOrFail();
        $voluntaryWork->update($request->all());

        return redirect()->route('applicant.voluntarywork');
    }

    // Delete a voluntary work entry
    public function destroy($id)
    {
        // Find the voluntary work entry by ID and delete it
        $voluntaryWork = VoluntaryWork::where('applicant_id', Auth::id())->where('id', $id)->firstOrFail();
        $voluntaryWork->delete();

        return redirect()->route('applicant.voluntarywork');
    }
}