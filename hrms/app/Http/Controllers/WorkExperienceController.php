<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkExperience;
use Illuminate\Support\Facades\Auth;

class WorkExperienceController extends Controller
{
    public function index()
    {
        $workExperiences = WorkExperience::where('applicant_id', Auth::id())->get();
        return view('applicant.workexperience', compact('workExperiences'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'position_title' => 'required',
            'department' => 'required',
            'monthly_salary' => 'required|numeric',
            'salary_grade_step' => 'nullable',
            'status_of_appointment' => 'required',
            'government_service' => 'required|in:Yes,No',
            'inclusive_dates_from' => 'required|date',
            'inclusive_dates_to' => 'required|date',
        ]);

        WorkExperience::create([
            'applicant_id' => Auth::id(),
            'position_title' => $request->position_title,
            'department' => $request->department,
            'monthly_salary' => $request->monthly_salary,
            'salary_grade_step' => $request->salary_grade_step,
            'status_of_appointment' => $request->status_of_appointment,
            'government_service' => $request->government_service,
            'inclusive_dates_from' => $request->inclusive_dates_from,
            'inclusive_dates_to' => $request->inclusive_dates_to,
        ]);

        return redirect()->back()->with('success', 'Work experience added successfully!');
    }

    public function update(Request $request, $id)
    {
        $workExperience = WorkExperience::findOrFail($id);

        $request->validate([
            'position_title' => 'required',
            'department' => 'required',
            'monthly_salary' => 'required|numeric',
            'salary_grade_step' => 'nullable',
            'status_of_appointment' => 'required',
            'government_service' => 'required|in:Yes,No',
            'inclusive_dates_from' => 'required|date',
            'inclusive_dates_to' => 'required|date',
        ]);

        $workExperience->update([
            'position_title' => $request->position_title,
            'department' => $request->department,
            'monthly_salary' => $request->monthly_salary,
            'salary_grade_step' => $request->salary_grade_step,
            'status_of_appointment' => $request->status_of_appointment,
            'government_service' => $request->government_service,
            'inclusive_dates_from' => $request->inclusive_dates_from,
            'inclusive_dates_to' => $request->inclusive_dates_to,
        ]);

        return redirect()->back()->with('success', 'Work experience updated successfully!');
    }

    public function destroy($id)
    {
        $workExperience = WorkExperience::findOrFail($id);
        $workExperience->delete();

        return redirect()->back()->with('success', 'Work experience deleted successfully!');
    }
}
