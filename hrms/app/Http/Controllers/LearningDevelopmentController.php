<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LearningDevelopment;
use Illuminate\Support\Facades\Auth;

class LearningDevelopmentController extends Controller
{
    // Display all learning development entries and allow for add, edit, delete
    public function index(Request $request)
    {
        // Retrieve all learning development entries for the logged-in applicant
        $learningDevelopments = LearningDevelopment::where('applicant_id', Auth::id())->get();

        // If 'edit' is set, get the specific learning development entry
        $editLearningDevelopment = null;
        if ($request->has('edit')) {
            $editLearningDevelopment = LearningDevelopment::where('applicant_id', Auth::id())
                ->where('id', $request->edit)
                ->firstOrFail();
        }

        // Return the view with the entries and the edit entry if exists
        return view('applicant.learning_development', compact('learningDevelopments', 'editLearningDevelopment'));
    }

    // Store a new learning development entry
    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'title_of_program' => 'required|string|max:255',
            'type_of_ld' => 'required|in:Managerial,Supervisory,Technical,Other',
            'conducted_by' => 'required|string|max:255',
            'inclusive_dates_from' => 'required|date',
            'inclusive_dates_to' => 'required|date|after_or_equal:inclusive_dates_from',
            'number_of_hours' => 'required|integer|min:1',
        ]);

        // Create the learning development entry
        LearningDevelopment::create([
            'applicant_id' => Auth::id(),
            'title_of_program' => $request->title_of_program,
            'type_of_ld' => $request->type_of_ld,
            'conducted_by' => $request->conducted_by,
            'inclusive_dates_from' => $request->inclusive_dates_from,
            'inclusive_dates_to' => $request->inclusive_dates_to,
            'number_of_hours' => $request->number_of_hours
        ]);

        return redirect()->route('applicant.learning_development');
    }

    // Update an existing learning development entry
    public function update(Request $request, $id)
    {
        // Validate the input
        $request->validate([
            'title_of_program' => 'required|string|max:255',
            'type_of_ld' => 'required|in:Managerial,Supervisory,Technical,Other',
            'conducted_by' => 'required|string|max:255',
            'inclusive_dates_from' => 'required|date',
            'inclusive_dates_to' => 'required|date|after_or_equal:inclusive_dates_from',
            'number_of_hours' => 'required|integer|min:1',
        ]);

        // Find the learning development entry by ID and update it
        $learningDevelopment = LearningDevelopment::where('applicant_id', Auth::id())->where('id', $id)->firstOrFail();
        $learningDevelopment->update($request->all());

        return redirect()->route('applicant.learning_development');
    }

    // Delete a learning development entry
    public function destroy($id)
    {
        // Find the learning development entry by ID and delete it
        $learningDevelopment = LearningDevelopment::where('applicant_id', Auth::id())->where('id', $id)->firstOrFail();
        $learningDevelopment->delete();

        return redirect()->route('applicant.learning_development');
    }
}
