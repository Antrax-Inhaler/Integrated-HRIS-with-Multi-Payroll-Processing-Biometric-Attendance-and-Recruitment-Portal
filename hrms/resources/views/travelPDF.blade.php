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
            height: 13in; 
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
            text-transform: uppercase;

        }
        .personal-info.surname {
    top: 340px;
    left: 250px;
}.personal-info.salary {
    top: 340px;
    left: 625px;
}

.personal-info.middle-name {
    top: 212px;
    left: 645px;
}


.department {
    top: 370px;
    left: 625px;
}

.departure-date {
    top: 387px;
    left: 250px;
}

.return-date {
    top: 387px;
    left: 625px;
}
.position{
    top: 372px;
    left: 250px;
}
.destination {
    top: 404px;
    left: 250px;
}

.specific-purpose {
    top: 436px;
    left: 250px;
}

.objectives {
    top: 497px;
    left: 250px;

}

.per-diem-expenses {
    top: 544px;
    left: 250px;
}

.assistant-or-laborers-allowed {
    top: 560px;
    left: 311px;
}

.appropriation-to-which-travel {
    top: 574px;
    left: 301px;
}

.should-be-charged {
    top: 596px;
    left: 451px;
}
.remarks-or-special-instructions {
    top: 614px;
    left: 308px;
}

.recommending-approval {
    top: 725px;
    left: 106px;
}

.approved-by {
    top: 725px;
    left: 516px;
}

.inclusive-dates {
    top: 610px;
    left: 20px;
}

.certifying-officers {
    top: 690px;
    left: 20px;
}

.immediate-supervisor {
    top: 822px;
    left: 202px;
}

.supervisor-designation {
    top: 791px;
    left: 158px;
}

.document-number {
    top: 1182px;
    left: 113px;
}

.revision-number {
    top: 1198px;
    left: 113px;
}

.issued-date {
    top: 1214px;
    left: 126px;
}
.travel-number{
    top: 273px;
    left: 625px;
}
.additional-date{
    top: 290px;
    left: 625px;
}
    </style>
</head>
<body>

    <div class="page"> 
        <img src="{{ $image1 }}" class="full-page-image" alt="Background Image 1">
        <div class="personal-info surname"> {{ $personalInformation->surname }}, {{ $personalInformation->given_name }} {{ $personalInformation->middle_name }}</div>

        <div class="personal-info position">{{ $personalInformation->position }}</div>
        <div class="personal-info salary">{{ $personalInformation->salary }}</div>
        <div class="personal-info department">{{ $personalInformation->department }}</div>

        <div class="personal-info additional-date">{{ $travel->additional_date }}</div>
        <div class="personal-info travel-number">{{ $travel->travel_number }}</div>
        <div class="personal-info departure-date">{{ $travel->departure_date }}</div>
        <div class="personal-info return-date">{{ $travel->return_date }}</div>
        <div class="personal-info destination">{{ $travel->destination }}</div>
        <div class="personal-info specific-purpose">{{ $travel->specific_purpose }}</div>
        <div class="personal-info objectives">{{ $travel->objectives }}</div>
        <div class="personal-info per-diem-expenses">{{ $travel->per_diem_expenses }}</div>
        <div class="personal-info assistant-or-laborers-allowed">{{ $travel->assistant_or_laborers_allowed }}</div>
        <div class="personal-info appropriation-to-which-travel">
          {{ $travel->appropriation_to_which_travel }}
        </div>
        <div class="personal-info should-be-charged">{{ $travel->should_be_charged }}</div>
        <div class="personal-info remarks-or-special-instructions">
          {{ $travel->remarks_or_special_instructions }}
        </div>
        <div class="personal-info recommending-approval">{{ $travel->recommending_approval }}</div>
        <div class="personal-info approved-by">{{ $travel->approved_by }}</div>
        <div class="personal-info certifying-officers">{{ $travel->certifying_officers }}</div>
        <div class="personal-info immediate-supervisor">{{ $travel->immediate_supervisor }}</div>
        <div class="personal-info supervisor-designation">{{ $travel->supervisor_designation }}</div>
        <div class="personal-info document-number">{{ $travel->document_number }}</div>
        <div class="personal-info revision-number">{{ $travel->revision_number }}</div>
        <div class="personal-info issued-date">{{ $travel->issued_date }}</div>
        

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
