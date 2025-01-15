<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EducationalBackground;
use Illuminate\Support\Facades\Auth;

class EducationalBackgroundController extends Controller
{
    // Show educational background form
    public function index()
    {
        // Get all educational backgrounds for the authenticated user
        $educationalBackgrounds = EducationalBackground::where('applicant_id', Auth::id())->get();

        // Group the educational backgrounds by their level
        $groupedBackgrounds = $educationalBackgrounds->keyBy('level');

        // Pass the grouped data to the view
        return view('applicant.educationalbackground', compact('groupedBackgrounds'));
    }

    // Update or add educational background
    public function store(Request $request)
    {
        $request->validate([
            'level' => 'required|in:Elementary,Secondary,Vocational,College,Graduate Studies',
            'school_name' => 'required|string|max:255',
            'period_of_attendance_from' => 'nullable|digits:4|integer|min:1900|max:' . date('Y'),
            'period_of_attendance_to' => 'nullable|digits:4|integer|min:1900|max:' . date('Y'),
            'course_name' => 'nullable|string|max:255',
            'year_graduated' => 'nullable|digits:4|integer|min:1900|max:' . date('Y'),
            'highest_level_units_earned' => 'nullable|string|max:50',
            'honors_received' => 'nullable|string|max:255',
        ]);

        // Find if there's an existing record for the applicant with the same level
        $educationalBackground = EducationalBackground::firstOrNew([
            'applicant_id' => Auth::id(),
            'level' => $request->level
        ]);

        // Update or create new record with form data
        $educationalBackground->fill($request->all());
        $educationalBackground->save();

        return redirect()->back()->with('success', 'Educational background updated successfully!');
    }
}
