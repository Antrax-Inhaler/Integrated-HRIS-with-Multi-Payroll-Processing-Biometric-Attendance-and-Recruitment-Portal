<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use App\Models\Requirement;
use App\Models\JobApplication;
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
use App\Models\Notification;
use App\Models\Applicant;

use App\Models\PdsReference;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class JobApplicationController extends Controller
{
    public function apply($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $applicantName = Auth::guard('applicant')->user()->name; // Assuming you have an applicant guard
        $job = JobListing::findOrFail($id);
        $applicantId = Auth::guard('applicant')->user()->id; // Get the applicant ID


        // Fetch requirements associated with the job listing
        $requirements = Requirement::where('job_listing_id', $job->id)->get();

        return view('applicant.apply', compact('job', 'applicantName', 'requirements', 'applicantId'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'job_listing_id' => 'required|exists:job_listings,id',
            'applicant_id' => 'required|exists:applicants,id',
        ]);

        JobApplication::create([
            'job_listing_id' => $validated['job_listing_id'],
            'applicant_id' => $validated['applicant_id'],
            'status' => 'Pending', // Default status
        ]);

        return redirect()->route('applicant.index')->with('success', 'Application submitted successfully!');
    }
    public function applicationList()
    {
        $applicantId = auth()->id();
    
        // Fetch job applications of the user
        $applications = JobApplication::where('applicant_id', $applicantId)
            ->with('jobListing')
            ->get();
    
        // Get IDs of jobs the user has already applied to
        $appliedJobIds = $applications->pluck('job_listing_id');
    
        // Fetch job listings the applicant hasn't applied to
        $jobListings = JobListing::whereNotIn('id', $appliedJobIds)->get();
    
        $applicantName = Auth::guard('applicant')->user()->name ?? 'Guest';
    
        // Pass both applications and job listings to the view
        return view('applicant.application_list', compact('applications', 'jobListings', 'applicantName'));
    }
    

    // Cancel the application if it's still pending
    public function cancel($id)
    {
        $application = JobApplication::where('id', $id)
            ->where('applicant_id', auth()->id())
            ->where('status', 'Pending')
            ->firstOrFail();

        $application->update(['status' => 'Cancelled']);

        return redirect()->route('applicant.application_list')
            ->with('success', 'Application cancelled successfully.');
    }
public function index()
    {
        $applications = JobApplication::with(['jobListing', 'applicant'])->get(); // Fetch all job applications with job listings and applicants

        return view('admin.job_applications', compact('applications'));
    }

    // Update the job application status and add a comment
    public function update(Request $request, $id)
    {
        // Validate the required fields
        $validated = $request->validate([
            'status' => 'required|in:Pending,Interview,Offered,Rejected',
            'comment' => 'nullable|string|max:255',
            // Optional inputs (not required for validation)
            'interview_date' => 'nullable|date',
            'interview_location' => 'nullable|string|max:255',
            'interviewer_name' => 'nullable|string|max:255',
            'rejection_reason' => 'nullable|string|max:255',
        ]);
    
        // Find the job application
        $application = JobApplication::findOrFail($id);
    
        // Update the job application details with optional inputs
        $application->update([
            'status' => $validated['status'],
            'comment' => $validated['comment'] ?? null,
            'interview_date' => $validated['interview_date'] ?? null,
            'interview_location' => $validated['interview_location'] ?? null,
            'interviewer_name' => $validated['interviewer_name'] ?? null,
            'rejection_reason' => $validated['rejection_reason'] ?? null,
        ]);
    
        // Create a notification for the applicant
        Notification::create([
            'user_id' => $application->applicant_id,
            'user_type' => 'applicant',
            'type' => 'job_applications',
            'item_id' => $application->id,
            'message' => "Your job application status has been updated to: {$validated['status']}.",
            'admin_message' => "Job Application ID: {$application->id} updated to {$validated['status']}.",
            'is_read' => 0,
            'is_read_admin' => 0,
        ]);
    
        // Redirect back with success message
        return redirect()->route('admin.job-applications')
            ->with('success', 'Application updated successfully!');
    }
    
    public function generateNarrowMarginPDF($id)
{
    // Fetch the applicant by ID
    $applicant = Applicant::findOrFail($id); // Ensure the applicant exists
    $applicantId = $applicant->id; // Get the applicant's ID

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
