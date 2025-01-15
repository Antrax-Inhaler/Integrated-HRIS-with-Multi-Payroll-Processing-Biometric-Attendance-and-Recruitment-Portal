
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        @page {
            margin: 0; /* Set margins to zero */
            width: 8.5in; 
            height: 13in; 
        }
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 8pt;
        }
        .full-page-image {
            width: 8.5in; 
            height: 12in; 
            object-fit: cover; /* Ensures the image covers the entire area */
            position: absolute; /* Allows layering */
            top: 0; /* Align to the top */
            left: 0; /* Align to the left */
        }
        .page {
            position: relative; /* Required for absolute positioning of the image */
            width: 100%;
            height: 100%;
            page-break-after: always; /* Forces a page break after each section */
        }
        .personal-info {
            position: absolute; /* Allows you to position elements anywhere on the page */
            z-index: 1; /* Ensures the content is above the background image */
            color: rgb(0, 0, 0); /* Text color */
        }
                /* Personal Info Classes */
.personal-info.surname {
    top: 212px;
    left: 398px;
}

.personal-info.given-name {
    top: 212px;
    left: 529px;
}

.personal-info.middle-name {
    top: 212px;
    left: 645px;
}

.personal-info.position {
    top: 243px;
    left: 386px;
}

.personal-info.salary {
    top: 243px;
    left: 663px;
}

.personal-info.department {
    top: 243px;
    left: 178px;
}

/* Personal Info Classes */
.personal-info.vacation-leave {
    top: 328px;
    left: 67px;
}

.personal-info.mandatory-forced-leave {
    top: 351px;
    left: 67px;
}

.personal-info.sick-leave {
    top: 374px;
    left: 67px;
}

.personal-info.maternity-leave {
    top: 395px;
    left: 67px;
}

.personal-info.paternity-leave {
    top: 415px;
    left: 67px;
}

.personal-info.special-privilege-leave {
    top: 437px;
    left: 67px;
}

.personal-info.solo-parent-leave {
    top: 460px;
    left: 67px;
}

.personal-info.study-leave {
    top: 482px;
    left: 67px;
}

.personal-info.ten-day-vawc-leave {
    top: 503px;
    left: 67px;
}

.personal-info.rehabilitation-privilege {
    top: 525px;
    left: 67px;
}

.personal-info.special-leave-for-women {
    top: 547px;
    left: 67px;
}

.personal-info.special-emergency-calamity-leave {
    top: 569px;
    left: 67px;
}

.personal-info.adoption-leave {
    top: 591px;
    left: 67px;
}


.personal-info.others-type-of-leave {
    top: 658px;
    left: 67px;
}

.personal-info.within-philippines {
    top: 350px;
    left: 464px;
}

.personal-info.abroad {
    top: 372px;
    left: 463px;
}

.personal-info.abroad-specify {
    top: 372px;
    left: 572px;
}

.personal-info.in-hospital {
    top: 415px;
    left: 463px;
}

.personal-info.hospital-specify-illness {
    top: 415px;
    left: 627px;
}

.personal-info.outpatient {
    top: 437px;
    left: 463px;
}

.personal-info.outpatient-specify-illness {
    top: 437px;
    left: 633px;
}

.personal-info.special-leave-illness {
    top: 503px;
    left: 550px;
}

.personal-info.study-leave-completion-masters {
    top: 569px;
    left: 464px;
}

.personal-info.study-leave-bar-review {
    top: 591px;
    left: 464px;
}

.personal-info.monetization-of-leave-credits {
    top: 635px;
    left: 464px;
}

.personal-info.terminal-leave {
    top: 657px;
    left: 464px;
}

.personal-info.details-of-leave {
    top: 657px;
    left: 534px;
}

.personal-info.working-days-applied {
    top: 657px;
    left: 464px;
}

.personal-info.commutation-not-requested {
    top: 707px;
    left: 462px;
}
.personal-info.commutation-requested {
    top: 729px;
    left: 462px;
}

.personal-info.inclusive-dates {
    top: 749px;
    left: 78px;
}

.personal-info.total-earned-sick {
    top: 881px;
    left: 339px;
}

.personal-info.total-earned-vacation {
    top: 882px;
    left: 200px;
}

.personal-info.less-this-application-vacation {
    top: 899px;
    left: 200px;
}

.personal-info.less-this-application-sick {
    top: 899px;
    left: 339px;
}

.personal-info.balance-vacation {
    top: 913px;
    left: 200px;
}

.personal-info.balance-sick {
    top: 913px;
    left: 339px;
}

.personal-info.authorize-officer-credits {
    top: 950px;
    left: 126px;
}

.personal-info.approval-status {
    top: 843px;
    left: 463px;
}

.personal-info.for-disapproval {
    top: 866px;
    left: 463px;
}
.personal-info.disapproval-reason {
    top: 882px;
    left: 480px;
}
.personal-info.authorize-officer-recommendation {
    top: 949px;
    left: 509px;
}

.personal-info.approved-days-with-pay {
    top: 1015px;
    left: 85px;
}

.personal-info.approved-days-without-pay {
    top: 1030px;
    left: 85px;
}

.personal-info.approved-others {
    top: 1045px;
    left: 85px;
}

.personal-info.disapproved-due-to {
    top: 1015px;
    left: 481px;
}

.personal-info.authorized-official {
    top: 1120px;
    left: 342px;
}
    </style>
</head>
<body>

    <div class="page"> 
        <img src="{{ $image1 }}" class="full-page-image" alt="Background Image 1">
        <div class="personal-info surname">{{ $personalInformation->surname }} </div>
<div class="personal-info given-name">{{ $personalInformation->given_name }}</div>
<div class="personal-info middle-name">{{ $personalInformation->middle_name }}</div>
<div class="personal-info position">{{ $personalInformation->position }}</div>
<div class="personal-info salary">{{ $personalInformation->salary }}</div>
<div class="personal-info department">{{ $personalInformation->department }}</div>
<div class="personal-info vacation-leave">
    @if($leave->vacation_leave)
        <span style="font-family:zapfdingbats;">3</span>
    @else
        <span>&mdash;</span>
    @endif
</div>

<div class="personal-info mandatory-forced-leave">
    @if($leave->mandatory_forced_leave)
        <span style="font-family:zapfdingbats;">3</span>
    @else
    @endif
</div>

<div class="personal-info sick-leave">
    @if($leave->sick_leave)
        <span style="font-family:zapfdingbats;">3</span>
    @else
    @endif
</div>

<div class="personal-info maternity-leave">
    @if($leave->maternity_leave)
        <span style="font-family:zapfdingbats;">3</span>
    @else
    @endif
</div>

<div class="personal-info paternity-leave">
    @if($leave->paternity_leave)
        <span style="font-family:zapfdingbats;">3</span>
    @else
    @endif
</div>

<div class="personal-info special-privilege-leave">
    @if($leave->special_privilege_leave)
        <span style="font-family:zapfdingbats;">3</span>
    @else
    @endif
</div>

<div class="personal-info solo-parent-leave">
    @if($leave->solo_parent_leave)
        <span style="font-family:zapfdingbats;">3</span>
    @else
    @endif
</div>

<div class="personal-info study-leave">
    @if($leave->study_leave)
        <span style="font-family:zapfdingbats;">3</span>
    @else
    @endif
</div>

<div class="personal-info ten-day-vawc-leave">
    @if($leave->ten_day_vawc_leave)
        <span style="font-family:zapfdingbats;">3</span>
    @else
    @endif
</div>

<div class="personal-info rehabilitation-privilege">
    @if($leave->rehabilitation_privilege)
        <span style="font-family:zapfdingbats;">3</span>
    @else
    @endif
</div>

<div class="personal-info special-leave-for-women">
    @if($leave->special_leave_for_women)
        <span style="font-family:zapfdingbats;">3</span>
    @else
    @endif
</div>

<div class="personal-info special-emergency-calamity-leave">
    @if($leave->special_emergency_calamity_leave)
        <span style="font-family:zapfdingbats;">3</span>
    @else
    @endif
</div>

<div class="personal-info adoption-leave">
    @if($leave->adoption_leave)
        <span style="font-family:zapfdingbats;">3</span>
    @else
    @endif
</div>


<div class="personal-info others-type-of-leave">Others Type of Leave: {{ $leave->others_type_of_leave }}</div>
<div class="personal-info within-philippines">
    @if($leave->within_philippines)
        <span style="font-family:zapfdingbats;">3</span>
    @else
    @endif
</div>
<div class="personal-info abroad">
    @if($leave->abroad)
        <span style="font-family:zapfdingbats;">3</span>
    @else
    @endif
</div>
<div class="personal-info abroad-specify"> {{ $leave->abroad_specify }}</div>
<div class="personal-info in-hospital">
    @if($leave->in_hospital)
        <span style="font-family:zapfdingbats;">3</span>
    @else
    @endif
</div><div class="personal-info hospital-specify-illness">Specify Illness in Hospital: {{ $leave->hospital_specify_illness }}</div>
<div class="personal-info outpatient">
    @if($leave->outpatient)
        <span style="font-family:zapfdingbats;">3</span>
    @else
    @endif
</div><div class="personal-info outpatient-specify-illness">Specify Illness Outpatient: {{ $leave->outpatient_specify_illness }}</div>
<div class="personal-info special-leave-illness">Special Leave for Illness: {{ $leave->special_leave_illness }}</div>
<div class="personal-info study-leave-completion-masters">
    @if($leave->study_leave_completion_masters)
        <span style="font-family:zapfdingbats;">3</span>
    @else
    @endif
</div><div class="personal-info study-leave-bar-review">
    @if($leave->study_leave_bar_review)
        <span style="font-family:zapfdingbats;">3</span>
    @else
    @endif
</div>
<div class="personal-info monetization-of-leave-credits">
    @if($leave->monetization_of_leave_credits)
        <span style="font-family:zapfdingbats;">3</span>
    @else
    @endif
</div>
<div class="personal-info terminal-leave">
    @if($leave->terminal_leave)
        <span style="font-family:zapfdingbats;">3</span>
    @else
    @endif
</div>
<div class="personal-info details-of-leave">Details of Leave: {{ $leave->details_of_leave }}</div>
<div class="personal-info working-days-applied"> {{ $leave->working_days_applied }}</div>
@if($leave->commutation == 1)
    <div class="personal-info commutation-requested">
        <span style="font-family:zapfdingbats;">3</span>
    </div>
@else
    <div class="personal-info commutation-not-requested">
        <span style="font-family:zapfdingbats;">3</span>
    </div>
@endif

<div class="personal-info inclusive-dates">{{ $leave->inclusive_dates }}</div>
<div class="personal-info total-earned-sick"> {{ $leave->total_earned_sick }}</div>
<div class="personal-info total-earned-vacation"> {{ $leave->total_earned_vacation }}</div>
<div class="personal-info less-this-application-vacation"> {{ $leave->less_this_application_vacation }}</div>
<div class="personal-info less-this-application-sick">{{ $leave->less_this_application_sick }}</div>
<div class="personal-info balance-vacation">{{ $leave->balance_vacation }}</div>
<div class="personal-info balance-sick">{{ $leave->balance_sick }}</div>
<div class="personal-info authorize-officer-credits"> {{ $leave->authorize_officer_credits }}</div>
@if($leave->approval_status == 'For approval')
    <div class="personal-info approval-status">
        <span style="font-family:zapfdingbats;">3</span>
    </div>
@elseif($leave->approval_status == 'For disapproval')
    <div class="personal-info for-disapproval">
        <span style="font-family:zapfdingbats;">3</span>
    </div>
@endif


<div class="personal-info disapproval-reason">{{ $leave->disapproval_reason }}</div>
<div class="personal-info authorize-officer-recommendation">{{ $leave->authorize_officer_recommendation }}</div>
<div class="personal-info approved-days-with-pay">{{ $leave->approved_days_with_pay }}</div>
<div class="personal-info approved-days-without-pay"> {{ $leave->approved_days_without_pay }}</div>
<div class="personal-info approved-others">{{ $leave->approved_others }}</div>
<div class="personal-info disapproved-due-to"> {{ $leave->disapproved_due_to }}</div>
<div class="personal-info authorized-official">{{ $leave->authorized_official }}</div>

    </div>
   
</body>
</html>
    {{-- <h2>Residential Address</h2>
            <p><strong>House No:</strong> {{ $personalInformation->residential_house_no }}</p>
            <p><strong>Street:</strong> {{ $personalInformation->residential_street }}</p>
            <p><strong>Subdivision:</strong> {{ $personalInformation->residential_subdivision }}</p>
            <p><strong>Barangay:</strong> {{ $personalInformation->residential_barangay }}</p>
            <p><strong>City/Municipality:</strong> {{ $personalInformation->residential_city_municipality }}</p>
            <p><strong>Province:</strong> {{ $personalInformation->residential_province }}</p>
            <p><strong>Zip Code:</strong> {{ $personalInformation->residential_zip_code }}</p>
    
            <h2>Permanent Address</h2>
            <p><strong>House No:</strong> {{ $personalInformation->permanent_house_no }}</p>
            <p><strong>Street:</strong> {{ $personalInformation->permanent_street }}</p>
            <p><strong>Subdivision:</strong> {{ $personalInformation->permanent_subdivision }}</p>
            <p><strong>Barangay:</strong> {{ $personalInformation->permanent_barangay }}</p>
            <p><strong>City/Municipality:</strong> {{ $personalInformation->permanent_city_municipality }}</p>
            <p><strong>Province:</strong> {{ $personalInformation->permanent_province }}</p>
            <p><strong>Zip Code:</strong> {{ $personalInformation->permanent_zip_code }}</p>
    
            <h2>Contact Information</h2>
            <p><strong>Telephone No:</strong> {{ $personalInformation->telephone_no }}</p>
            <p><strong>Mobile No:</strong> {{ $personalInformation->mobile_no }}</p>
            <p><strong>Email Address:</strong> {{ $personalInformation->email_address }}</p>
    
            <h2>Additional Information</h2>
            <p><strong>Height:</strong> {{ $personalInformation->height }}</p>
            <p><strong>Weight:</strong> {{ $personalInformation->weight }}</p>
            <p><strong>Blood Type:</strong> {{ $personalInformation->blood_type }}</p>
            <p><strong>GSIS No:</strong> {{ $personalInformation->gsis_no }}</p>
            <p><strong>PAGIBIG No:</strong> {{ $personalInformation->pagibig_no }}</p>
            <p><strong>PhilHealth No:</strong> {{ $personalInformation->philhealth_no }}</p>
            <p><strong>SSS No:</strong> {{ $personalInformation->sss_no }}</p>
            <p><strong>TIN No:</strong> {{ $personalInformation->tin_no }}</p>
            <p><strong>Agency Employee No:</strong> {{ $personalInformation->agency_employee_no }}</p>
        </div>
    </div>
    



</body>
</html> --}}
