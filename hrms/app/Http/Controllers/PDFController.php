<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\PersonalInformation;
use App\Models\FamilyBackground;
use App\Models\Children;
use App\Models\EducationalBackground;
use App\Models\CivilServiceEligibility;
use App\Models\WorkExperience;
use App\Models\VoluntaryWork;
use App\Models\LearningDevelopment;
use App\Models\OtherInformation;
use App\Models\LegalQuestionnaire;
use App\Models\PdsReference;

use Illuminate\Support\Facades\Auth;

class PDFController extends Controller
{
    public function generateNarrowMarginPDF(Request $request)
    {
        // Validate the request
        $request->validate([
            'applicant_id' => 'required|exists:applicants,id', 
        ]);

        $applicantId = $request->input('applicant_id');

        // Fetch the applicant's personal information and other data
        $personalInformation = PersonalInformation::where('applicant_id', $applicantId)->first();
        $familyBackground = FamilyBackground::where('applicant_id', $applicantId)->first();
        $children = Children::where('applicant_id', $applicantId)->get();
        $educationalBackground = EducationalBackground::where('applicant_id', $applicantId)->get()->groupBy('level');
        $civilServiceEligibility = CivilServiceEligibility::where('applicant_id', $applicantId)->get();
        $workExperience = WorkExperience::where('applicant_id', $applicantId)->get();
        $voluntaryWork = VoluntaryWork::where('applicant_id', $applicantId)->get();
        $learningDevelopment = LearningDevelopment::where('applicant_id', $applicantId)->get();
        $otherInformation = OtherInformation::where('applicant_id', $applicantId)->get()->groupBy('type');
        $legalQuestionnaire = LegalQuestionnaire::where('applicant_id', $applicantId)->first();
        $pdsReferences = PdsReference::where('applicant_id', $applicantId)->get();

        // Generate a PDF file name based on the applicant's name
        $applicantName = $personalInformation->first_name . '_' . $personalInformation->last_name;
        $filename = strtolower(str_replace(' ', '_', $applicantName)) . '_personal_data_sheet.pdf';

        // Prepare data for the PDF view
        $data = [
            'title' => 'Personal Data Sheet',
            'date' => date('m/d/Y'),
            'personalInformation' => $personalInformation,
            'familyBackground' => $familyBackground,
            'children' => $children,
            'educationalBackground' => $educationalBackground,
            'civilServiceEligibility' => $civilServiceEligibility,
            'workExperience' => $workExperience,
            'voluntaryWork' => $voluntaryWork,
            'learningDevelopment' => $learningDevelopment,
            'otherInformation' => $otherInformation,
            'legalQuestionnaire' => $legalQuestionnaire,
            'pdsReferences' => $pdsReferences,
            'image1' => public_path('images/Personal-Data-Sheet-CS-Form-No.-212-Revised-2017_page-0001.jpg'),
            'image2' => public_path('images/Personal-Data-Sheet-CS-Form-No.-212-Revised-2017_page-0002.jpg'),
            'image3' => public_path('images/Personal-Data-Sheet-CS-Form-No.-212-Revised-2017_page-0003.jpg'),
            'image4' => public_path('images/Personal-Data-Sheet-CS-Form-No.-212-Revised-2017_page-0004.jpg'),
        ];

        $pdf = PDF::loadView('myPDF', $data)
            ->setPaper([0, 0, 612, 936])
            ->setOption('isRemoteEnabled', 'true');

        // Stream the PDF with a dynamic filename
        return $pdf->stream($filename);
    }
}

