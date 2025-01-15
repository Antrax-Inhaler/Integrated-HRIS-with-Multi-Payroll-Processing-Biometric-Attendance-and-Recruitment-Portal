<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonalInformation;
use Illuminate\Support\Facades\Auth;

class ApplicantPersonalInformationController extends Controller
{
    // Show the form for personal information
    public function showForm()
    {
        // Get the personal information based on the logged-in applicant (user)
        $personalInformation = PersonalInformation::where('applicant_id', Auth::id())->firstOrNew();

        // Return the view with the applicant's personal information
        return view('applicant.personalinformation', compact('personalInformation'));
    }

    // Save or update the personal information
    public function savePersonalInformation(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'cs_id_no' => 'nullable|string|max:50',
            'surname' => 'required|string|max:100',
            'first_name' => 'required|string|max:100',
            'middle_name' => 'nullable|string|max:100',
            'name_extension' => 'nullable|string|max:10',
            'date_of_birth' => 'required|date',
            'place_of_birth' => 'required|string|max:255',
            'sex' => 'required|in:Male,Female',
            'civil_status' => 'required|in:Single,Married,Widowed,Separated,Other',
            'citizenship' => 'required|string|max:100',
            'dual_citizenship_country' => 'nullable|string|max:100',
            'dual_citizenship_by' => 'nullable|in:By birth,By naturalization',
        
            // Residential Address Fields
            'residential_house_no' => 'nullable|string|max:50',
            'residential_street' => 'nullable|string|max:255',
            'residential_subdivision' => 'nullable|string|max:255',
            'residential_barangay' => 'nullable|string|max:255',
            'residential_city_municipality' => 'nullable|string|max:255',
            'residential_province' => 'nullable|string|max:255',
            'residential_zip_code' => 'nullable|string|max:10',
        
            // Permanent Address Fields
            'permanent_house_no' => 'nullable|string|max:50',
            'permanent_street' => 'nullable|string|max:255',
            'permanent_subdivision' => 'nullable|string|max:255',
            'permanent_barangay' => 'nullable|string|max:255',
            'permanent_city_municipality' => 'nullable|string|max:255',
            'permanent_province' => 'nullable|string|max:255',
            'permanent_zip_code' => 'nullable|string|max:10',
        
            'telephone_no' => 'nullable|string|max:20',
            'mobile_no' => 'required|string|max:20',
            'email_address' => 'required|email|max:255',
        
            // Additional Fields
            'height' => 'nullable|numeric|between:0,999.99',  // 4,2 DECIMAL
            'weight' => 'nullable|numeric|between:0,999.99',  // 5,2 DECIMAL
            'blood_type' => 'nullable|string|max:5',
            'gsis_no' => 'nullable|string|max:50',
            'pagibig_no' => 'nullable|string|max:50',
            'philhealth_no' => 'nullable|string|max:50',
            'sss_no' => 'nullable|string|max:50',
            'tin_no' => 'nullable|string|max:50',
            'agency_employee_no' => 'nullable|string|max:50',
        ]);
        

        // Save or update the personal information
        $personalInformation = PersonalInformation::updateOrCreate(
            ['applicant_id' => Auth::id()],  // Find or create by applicant_id
            $request->except('_token')  // Exclude the _token field from the form data
        );

        // Redirect to the next step or a confirmation page
        return redirect()->route('applicant.references2')->with('success', 'Personal information saved successfully.');
    }
}
