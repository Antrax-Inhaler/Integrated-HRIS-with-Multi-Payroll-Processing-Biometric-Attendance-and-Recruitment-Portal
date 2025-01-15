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
            font-size: 7pt;
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
            text-transform: uppercase;
        }
        .personal-info {
            position: absolute; /* Allows you to position elements anywhere on the page */
            z-index: 1; /* Ensures the content is above the background image */
            color: rgb(0, 0, 0); /* Text color */
        }
        /* Individual classes for each piece of information */
        td {
    font-size: calc(6px + 0.01vw) !important;
    padding: 0px !important;
    height: 27px;
    text-align: center !important; 
    align-items: center !important;
    border-color: none !important;
}
.name-of-school {
    width: 150px;
}

.degree-course {
    width: 168px;
}

.attendance-from {
    width: 30px;
}

.attendance-to {
    width: 30px;
}

.highest-level {
    width: 30px;
}

.year-graduated {
    width: 30px;
}

.honors-received {
    width: 16%;
}

        .surname {
    top: 163px;
    left: 179px;
}
.first-name {
    top: 188px;
    left: 178px;
}
.middle-name {
    top: 214px;
    left: 178px;
}
.name-extension {
    top: 190px;
    left: 714px;
}
.dob {
    top: 245px; /* 248 - 3 */
    left: 184px;
}
.place-of-birth {
    top: 280px; /* 283 - 3 */
    left: 176px;
}
.male {
    top: 312px; /* 311 - 3 */
    left: 183px;
}
.female {
    top: 312px; /* 311 - 3 */
    left: 252px;
}
.civil-status {
    top: 311px; /* 307 + 4 */
    left: 49px; /* 50 - 1 */
}

.filipino {
    top: 247px; /* 243 + 4 */
    left: 509px; /* 510 - 1 */
}

.dual-citizenship-country {
    top: 286px; /* 282 + 4 */
    left: 721px; /* 722 - 1 */
    font-size: 8pt;
}

.dual-citizenship-by {
    top: 247px; /* 243 + 4 */
    left: 607px; /* 608 - 1 */
}

.single {
    top: 337px; /* 333 + 4 */
    left: 183px; /* 184 - 1 */
}

.widowed {
    top: 352px; /* 348 + 4 */
    left: 183px; /* 184 - 1 */
}

.married {
    top: 337px; /* 333 + 4 */
    left: 252px; /* 253 - 1 */
}

.separated {
    top: 352px; /* 348 + 4 */
    left: 252px; /* 253 - 1 */
}

.other {
    top: 369px; /* 365 + 4 */
    left: 183px; /* 184 - 1 */
}

.other-reason {
    top: 371px; /* 367 + 4 */
    left: 231px; /* 232 - 1 */
    font-size: 8pt;
}

.dual-citizenship {
    top: 247px; /* 243 + 4 */
    left: 607px; /* 608 - 1 */
}

.dual-citizenship-by-birth {
    top: 265px; /* 261 + 4 */
    left: 625px; /* 626 - 1 */
}

.dual-citizenship-by-naturalization {
    top: 265px; /* 261 + 4 */
    left: 677px; /* 678 - 1 */
}


/* Residential Address */
.residential-house-no {
    top: 368px;
    left: 184px;
}

.residential-street {
    top: 390px;
    left: 184px;
}

.residential-subdivision {
    top: 412px;
    left: 184px;
}

.residential-barangay {
    top: 434px;
    left: 184px;
}

.residential-city-municipality {
    top: 456px;
    left: 184px;
}

.residential-province {
    top: 478px;
    left: 184px;
}

.residential-zip-code {
    top: 500px;
    left: 184px;
}

/* Permanent Address */
.permanent-house-no {
    top: 532px;
    left: 184px;
}

.permanent-street {
    top: 554px;
    left: 184px;
}

.permanent-subdivision {
    top: 576px;
    left: 184px;
}

.permanent-barangay {
    top: 598px;
    left: 184px;
}

.permanent-city-municipality {
    top: 620px;
    left: 184px;
}

.permanent-province {
    top: 642px;
    left: 184px;
}

.permanent-zip-code {
    top: 664px;
    left: 184px;
}
/* Residential Address */
.residential-house-no {
    top: 325px; /* 334 - 9 */
    left: 495px; /* 501 - 6 */
    font-size: 8pt;
}
.residential-street {
    top: 325px; /* 334 - 9 */
    left: 658px; /* 664 - 6 */
    font-size: 8pt;
}

.residential-subdivision {
    top: 353px; /* 362 - 9 */
    left: 495px; /* 501 - 6 */
    font-size: 8pt;
}

.residential-barangay {
    top: 353px; /* 362 - 9 */
    left: 658px; /* 664 - 6 */
    font-size: 8pt;
}

.residential-city-municipality {
    top: 381px; /* 390 - 9 */
    left: 495px; /* 501 - 6 */
    font-size: 8pt;
}

.residential-province {
    top: 381px; /* 390 - 9 */
    left: 658px; /* 664 - 6 */
    font-size: 8pt;
}

.residential-zip-code {
    top: 388px; /* 397 - 9 */
    left: 363px; /* 369 - 6 */
    font-size: 8pt;
}

/* Permanent Address */
.permanent-house-no {
    top: 428px; /* 437 - 9 */
    left: 495px; /* 501 - 6 */
    font-size: 8pt;
}

.permanent-street {
    top: 428px; /* 437 - 9 */
    left: 658px; /* 664 - 6 */
    font-size: 8pt;
}

.permanent-subdivision {
    top: 459px; /* 468 - 9 */
    left: 495px; /* 501 - 6 */
    font-size: 8pt;
}

.permanent-barangay {
    top: 459px; /* 468 - 9 */
    left: 658px; /* 664 - 6 */
    font-size: 8pt;
}

.permanent-city-municipality {
    top: 488px; /* 497 - 9 */
    left: 495px; /* 501 - 6 */
    font-size: 8pt;
}

.permanent-province {
    top: 488px; /* 497 - 9 */
    left: 658px; /* 664 - 6 */
    font-size: 8pt;
}

.permanent-zip-code {
    top: 499px; /* 508 - 9 */
    left: 363px; /* 369 - 6 */
    font-size: 8pt;
}

/* Contact Information */
.contact-telephone-no {
    top: 541px; /* 550 - 9 */
    left: 452px; /* 458 - 6 */
    font-size: 8pt;
}

.contact-mobile-no {
    top: 563px; /* 572 - 9 */
    left: 452px; /* 458 - 6 */
    font-size: 8pt;
}

.contact-email-address {
    top: 585px; /* 594 - 9 */
    left: 452px; /* 458 - 6 */
    font-size: 8pt;
    text-transform: lowercase;

}

/* Additional Information */
.additional-height {
    top: 385px; /* 394 - 9 */
    left: 178px; /* 184 - 6 */
    font-size: 8pt;
}

.additional-weight {
    top: 408px; /* 417 - 9 */
    left: 178px; /* 184 - 6 */
    font-size: 8pt;
}

.additional-blood-type {
    top: 428px; /* 437 - 9 */
    left: 178px; /* 184 - 6 */
    font-size: 8pt;
}

.additional-gsis-no {
    top: 463px; /* 472 - 9 */
    left: 178px; /* 184 - 6 */
    font-size: 8pt;
}

.additional-pagibig-no {
    top: 492px; /* 501 - 9 */
    left: 178px; /* 184 - 6 */
    font-size: 8pt;
}

.additional-philhealth-no {
    top: 518px; /* 527 - 9 */
    left: 178px; /* 184 - 6 */
    font-size: 8pt;
}

.additional-sss-no {
    top: 541px; /* 550 - 9 */
    left: 178px; /* 184 - 6 */
    font-size: 8pt;
}

.additional-tin-no {
    top: 564px; /* 573 - 9 */
    left: 178px; /* 184 - 6 */
    font-size: 8pt;
}

.additional-agency-employee-no {
    top: 586px; /* 595 - 9 */
    left: 178px; /* 184 - 6 */
    font-size: 8pt;
}

/* Spouse Information */
.personal-info.spouse-surname {
    top: 631px; /* 615 + 16 */
    left: 177px; /* 180 - 3 */
    font-size: 8pt;
}

.personal-info.spouse-first-name {
    top: 654px; /* 635 + 16 */
    left: 177px; /* 180 - 3 */
    font-size: 8pt;
}

.personal-info.spouse-middle-name {
    top: 679px; /* 655 + 16 */
    left: 177px; /* 180 - 3 */
    font-size: 8pt;
}
.personal-info.spouse-suffix {
    top: 654px;
    left: 328px;
    font-size: 8pt;
}
.personal-info.father-suffix {
    top: 822px;
    left: 328px;
    font-size: 8pt;
}
.personal-info.spouse-occupation {
    top: 703px; /* 675 + 16 */
    left: 177px; /* 180 - 3 */
    font-size: 8pt;
}

.personal-info.spouse-employer-name {
    top: 727px;
    left: 177px; /* 180 - 3 */
    font-size: 8pt;
}

.personal-info.spouse-business-address {
    top: 751px; /* 735 + 16 */
    left: 177px; /* 180 - 3 */
    font-size: 8pt;
}

.personal-info.spouse-telephone-no {
    top: 773px; /* 735 + 16 */
    left: 177px; /* 180 - 3 */
    font-size: 8pt;
}

/* Father Information */
.personal-info.father-surname {
    top: 798px; /* 755 + 16 */
    left: 177px; /* 180 - 3 */
    font-size: 8pt;
}

.personal-info.father-first-name {
    top: 822px; /* 775 + 16 */
    left: 177px; /* 180 - 3 */
    font-size: 8pt;
}

.personal-info.father-middle-name {
    top: 847px; /* 795 + 16 */
    left: 177px; /* 180 - 3 */
    font-size: 8pt;
}

/* Mother Information */
.personal-info.mother-maiden-name {
    top: 871px; /* 815 + 16 */
    left: 177px; /* 180 - 3 */
    font-size: 8pt;
}
.personal-info.mother-surname {
    top: 895px; /* 815 + 16 */
    left: 177px; /* 180 - 3 */
    font-size: 8pt;
}
.personal-info.mother-first-name {
    top: 918px; /* 815 + 16 */
    left: 177px; /* 180 - 3 */
    font-size: 8pt;
}
.personal-info.mother-middle-name {
    top: 942px; /* 815 + 16 */
    left: 177px; /* 180 - 3 */
    font-size: 8pt;
}
.children-table {
    top: 659px; /* 815 + 16 */
    left: 441.5px; /* 180 - 3 */
    font-size: 8pt;
    width: 345px;

}
.children-table tr {
   height: 27px;
}
.attendance-from {
    width: 72px;
}

.attendance-to {
    width: 52px;
}

.highest-level {
    width: 52px;
}

.year-graduated {
    width: 59px;
}

.honors-received {
    width: 16%;
    font-size: 4px;
}

/* Optional: Add some border and spacing for better visibility */
table{
    border: none !important;
}
td {
    padding: 5px;
    text-align: center;
    border: none !important;
}
.personal-info.education-table {
    top: 1037px;
    left: 169.5px;
    font-size: 8pt;
    height: 127px !important;
    width: 617px;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    max-height: 200px;
}
.education-table td{
    height: 24px !important;

}
.children-table td{
    height: 23px !important;

}
.workexperience-table{
    top: 237px;
    left: 69.5px;
}
.voluntarywork-table{
    top: 112px;
    left: 41.5px;
}
.learningdevelopment-table{
    top: 457px;
    left: 19.5px;
}
.otherinformation-table{
    top: 857px;
    left: 49.5px;
}
.related-to-authority-third-yes {
            top: 87px;
            left: 505px;
        }
        .related-to-authority-third-no {
    top: 87px; /* 88 - 1 */
    left: 589px; /* 587 + 2 */
}

.related-to-authority-fourth-yes {
    top: 108px; /* 109 - 1 */
    left: 505px; /* 503 + 2 */
}

.related-to-authority-fourth-no {
    top: 108px; /* 109 - 1 */
    left: 589px; /* 587 + 2 */
}

.found-guilty-yes {
    top: 170px; /* 171 - 1 */
    left: 503px; /* 501 + 2 */
}

.found-guilty-no {
    top: 170px; /* 171 - 1 */
    left: 590px; /* 588 + 2 */
}

.criminally-charged-yes {
    top: 236px; /* 237 - 1 */
    left: 503px; /* 501 + 2 */
}

.criminally-charged-no {
    top: 236px; /* 237 - 1 */
    left: 594px; /* 592 + 2 */
}

.convicted-of-crime-yes {
    top: 317px; /* 318 - 1 */
    left: 502px; /* 500 + 2 */
}

.convicted-of-crime-no {
    top: 318px; /* 319 - 1 */
    left: 598px; /* 596 + 2 */
}

.separated-from-service-yes {
    top: 381px; /* 382 - 1 */
    left: 501px; /* 499 + 2 */
}

.separated-from-service-no {
    top: 381px; /* 382 - 1 */
    left: 598px; /* 596 + 2 */
}

.election-candidate-yes {
    top: 436px; /* 437 - 1 */
    left: 503px; /* 501 + 2 */
}

.election-candidate-no {
    top: 436px; /* 437 - 1 */
    left: 606px; /* 604 + 2 */
}

.resigned-for-campaign-yes {
    top: 476px; /* 477 - 1 */
    left: 504px; /* 502 + 2 */
}

.resigned-for-campaign-no {
    top: 476px; /* 477 - 1 */
    left: 607px; /* 605 + 2 */
}

.immigrant-status-yes {
    top: 522px; /* 523 - 1 */
    left: 503px; /* 501 + 2 */
}

.immigrant-status-no {
    top: 522px; /* 523 - 1 */
    left: 606px; /* 604 + 2 */
}

.indigenous-group-member-yes {
    top: 618px; /* 619 - 1 */
    left: 503px; /* 501 + 2 */
}

.indigenous-group-member-no {
    top: 618px; /* 619 - 1 */
    left: 608px; /* 606 + 2 */
}

.person-with-disability-yes {
    top: 651px; /* 652 - 1 */
    left: 503px; /* 501 + 2 */
}

.person-with-disability-no {
    top: 651px; /* 652 - 1 */
    left: 608px; /* 606 + 2 */
}

.solo-parent-yes {
    top: 686px; /* 687 - 1 */
    left: 503px; /* 501 + 2 */
}

.solo-parent-no {
    top: 686px; /* 687 - 1 */
    left: 608px; /* 606 + 2 */
}

.relation-details {
    top: 135px;
    left: 510px;
}

.relation-details-fourth {
    top: 135px;
    left: 510px;
}

.offense-details {
    top: 197px;
    left: 510px;
}

.criminal-charge-details {
    top: 280px;
    left: 597px;
}

.criminal-charge-date {
    top: 262px;
    left: 597px;
}

.criminal-charge-status {
    top: 280px;
    left: 597px;
}

.conviction-details {
    top: 345px;
    left: 510px;
}

.separation-details {
    top: 399px;
    left: 510px;
}

.election-details {
    top: 442px;
    left: 597px;
}

.resignation-details {
    top: 486px;
    left: 597px;
}

.immigrant-country {
    top: 544px;
    left: 512px;
}

.indigenous-group-details {
    top: 624px;
    left: 648px;
}

.disability-id-number {
    top: 658px;
    left: 648px;
}

.solo-parent-id-number {
    top: 691px;
    left: 648px;
}

.government-id-type {
    top: 989px;
    left: 129px;
}

.government-id-number {
    top: 989px;
    left: 217px;
}

.id-issuance-date {
    top: 1041px;
    left: 129px;
}

.id-issuance-place {
    top: 1041px;
    left: 129px;
}

.signature {
    top: 230px;
    left: 260px;
}

.date-accomplished {
    top: 1033px;
    left: 425px;
}

.right-thumbmark {
    top: 240px;
    left: 270px;
}

.date-sworn {
    top: 245px;
    left: 275px;
}

.person-administering-oath {
    top: 250px;
    left: 280px;
}

    .person-administering-oath {
        top: 1082px;
        left: 224px;
    }
    .pds-references-table{
        top: 773px;
    left: 27px;
    width: 554px;
    }


    .voluntarywork-table{
        top: 112px;
        left: 41.5px;
        max-width: 2000px;
}
.learningdevelopment-table{
    top: 457px;
    left: 19.5px;
}
.otherinformation-table{
    top: 946px;
    left: 40.5px;
    max-width: 1477px;
    border-collapse: collapse;
}
.otherinformation-table tr{
    height: 27px;
}
.organization-name {
    width: 236px;
    font-size: calc(8px + 0.1vw) !important;

}

.organization-address {
    width: 252px; /* 25% of table width */
}

.inclusive-dates-from {
    width: 80px;
}

.inclusive-dates-to {
    width: 80px;
}
.work-inclusive-dates-from {
    width: 61px;
    font-size: calc(8px + 0.1vw) !important;

}

.work-inclusive-dates-to {
    width: 62px;
    font-size: calc(8px + 0.1vw) !important;

}

.number-of-hours {
    width: 69px;
}

.position-nature-of-work {
    width: 273px; /* 15% of table width */
}
.special-skills {
    width: 237px; /* 33% of table width */
}

.non-academic-distinctions {
    width: 290px; /* 33% of table width */
}

.memberships {
    width: 196px; /* 33% of table width */
}
.learning-development-table {
    border-collapse: collapse;
    max-width: 918px;
    top: 403px;
    left: 40.5px;
}
.learning-development-table tr{
height: 27px;
}


.personal-info.learning-development-table th,
.personal-info.learning-development-table td {
    border: 1px solid #000;
    text-align: left;
}

.program-title-header, .program-title {
    width: 237px; /* Adjust width as necessary */
}

.type-of-ld-header {
    width: 76px; /* Adjust width as necessary */
}
.type-of-ld {
    width: 76px; /* Adjust width as necessary */
    font-size: 5pt;
}

.conducted-by-header, .conducted-by {
    width: 200px; /* Adjust width as necessary */
}
.hours{
    width: 67px; /* Adjust width as necessary */
}

.civil-service-table{
    top: 112px;
    left: 26.5px;
    border-collapse: collapse;
}
.civil-service-table td{
height: 25px !important;
}
.workexperience-table{
    top: 411px;
    left: 26.5px;
}
.workexperience-table td{
height: 25px !important;
}
.career-service {
        width: 240px; /* Width for career service */
    }

    .rating {
        width: 88px; /* Width for rating */
    }

    .date-of-examination {
        width: 88px; /* Width for rating */
    }

    .place-of-examination {
        width: 220px; /* Width for career service */
    }

    .license-number {
        width: 61px; /* Width for license number */
    }

    .license-validity {
        width: 56px; /* Width for license validity */
        font-size: 6pt;
    }

    .inclusive-dates-from {
        width: 74px; /* Width for inclusive dates from */
        font-size: 6pt;
    }

    .inclusive-dates-to {
        width: 70px; /* Width for inclusive dates to */
        font-size: 6pt;

    }

    .position-title {
        width: 206px; /* Width for position title */
    }

    .department {
        width: 207px; /* Width for department */
    }

    .monthly-salary {
        width: 40px; /* Width for monthly salary */
        font-size: 5pt;
    }

    .salary-grade-step {
        width: 55px; /* Width for salary grade step */
        font-size: 5pt;

    }

    .status-of-appointment {
        width: 70px; /* Width for status of appointment */
        font-size: 5pt;

    }

    .government-service {
        width: 55px; /* Width for government service */
        font-size: 5pt;

    }
    </style>
</head>
<body>

    <div class="page"> 
        <img src="{{ $image1 }}" class="full-page-image" alt="Background Image 1">
    
        <div class="personal-info surname">{{ $personalInformation->surname }}</div>
        <div class="personal-info first-name">{{ $personalInformation->first_name }}</div>
        <div class="personal-info middle-name">{{ $personalInformation->middle_name }}</div>
        <div class="personal-info name-extension">{{ $personalInformation->name_extension }}</div>
        <div class="personal-info dob">{{ \Carbon\Carbon::parse($personalInformation->date_of_birth)->format('m/d/Y') }}</div>
        <div class="personal-info place-of-birth">{{ $personalInformation->place_of_birth }}</div>
    
        @if($personalInformation->sex == 'Male')
        <div class="personal-info male"><span style="font-family:zapfdingbats;">3</span></div>
        @else
        <div class="personal-info female"><span style="font-family:zapfdingbats;">3</span></div>
        @endif
    
        @if($personalInformation->civil_status == 'Single')
        <div class="personal-info single"><span style="font-family:zapfdingbats;">3</span></div>
        @elseif($personalInformation->civil_status == 'Widowed')
        <div class="personal-info widowed"><span style="font-family:zapfdingbats;">3</span></div>
        @elseif($personalInformation->civil_status == 'Married')
        <div class="personal-info married"><span style="font-family:zapfdingbats;">3</span></div>
        @elseif($personalInformation->civil_status == 'Separated')
        <div class="personal-info separated"><span style="font-family:zapfdingbats;">3</span></div>
        @elseif($personalInformation->civil_status == 'Other')
        <div class="personal-info other"><span style="font-family:zapfdingbats;">3</span></div>
        @endif
    
        <div class="personal-info other-reason">{{ $personalInformation->other_reason }}</div>
    
        @if($personalInformation->citizenship == 'Filipino')
        <div class="personal-info filipino"><span style="font-family:zapfdingbats;">3</span></div>
        @else
        <div class="personal-info dual-citizenship"><span style="font-family:zapfdingbats;">3</span></div>
        <div class="personal-info dual-citizenship-country">{{ $personalInformation->dual_citizenship_country }}</div>
    
        @if($personalInformation->dual_citizenship_by == 'By birth')
        <div class="personal-info dual-citizenship-by-birth"><span style="font-family:zapfdingbats;">3</span></div>
        @elseif($personalInformation->dual_citizenship_by == 'By naturalization')
        <div class="personal-info dual-citizenship-by-naturalization"><span style="font-family:zapfdingbats;">3</span></div>
        @endif
        @endif
    
        <p class="personal-info residential-house-no">{{ $personalInformation->residential_house_no }}</p>
<p class="personal-info residential-street">{{ $personalInformation->residential_street }}</p>
<p class="personal-info residential-subdivision">{{ $personalInformation->residential_subdivision }}</p>
<p class="personal-info residential-barangay">{{ $personalInformation->residential_barangay }}</p>
<p class="personal-info residential-city-municipality">{{ $personalInformation->residential_city_municipality }}</p>
<p class="personal-info residential-province">{{ $personalInformation->residential_province }}</p>
<p class="personal-info residential-zip-code">{{ $personalInformation->residential_zip_code }}</p>

<p class="personal-info permanent-house-no">{{ $personalInformation->permanent_house_no }}</p>
<p class="personal-info permanent-street">{{ $personalInformation->permanent_street }}</p>
<p class="personal-info permanent-subdivision">{{ $personalInformation->permanent_subdivision }}</p>
<p class="personal-info permanent-barangay">{{ $personalInformation->permanent_barangay }}</p>
<p class="personal-info permanent-city-municipality">{{ $personalInformation->permanent_city_municipality }}</p>
<p class="personal-info permanent-province">{{ $personalInformation->permanent_province }}</p>
<p class="personal-info permanent-zip-code">{{ $personalInformation->permanent_zip_code }}</p>

<p class="personal-info contact-telephone-no">{{ $personalInformation->telephone_no }}</p>
<p class="personal-info contact-mobile-no">{{ $personalInformation->mobile_no }}</p>
<p class="personal-info contact-email-address">{{ $personalInformation->email_address }}</p>

<p class="personal-info additional-height">{{ $personalInformation->height }} m</p>
<p class="personal-info additional-weight">{{ $personalInformation->weight }} kg</p>
<p class="personal-info additional-blood-type">{{ $personalInformation->blood_type }}</p>
<p class="personal-info additional-gsis-no">{{ $personalInformation->gsis_no }}</p>
<p class="personal-info additional-pagibig-no">{{ $personalInformation->pagibig_no }}</p>
<p class="personal-info additional-philhealth-no">{{ $personalInformation->philhealth_no }}</p>
<p class="personal-info additional-sss-no">{{ $personalInformation->sss_no }}</p>
<p class="personal-info additional-tin-no">{{ $personalInformation->tin_no }}</p>
<p class="personal-info additional-agency-employee-no">{{ $personalInformation->agency_employee_no }}</p>
@if($familyBackground)
<p class="personal-info spouse-surname">{{ $familyBackground->spouse_surname }}</p>
<p class="personal-info spouse-first-name">{{ $familyBackground->spouse_first_name }}</p>
<p class="personal-info spouse-middle-name">{{ $familyBackground->spouse_middle_name }}</p>
<p class="personal-info spouse-suffix">{{ $familyBackground->spouse_suffix }}</p>
<p class="personal-info spouse-occupation">{{ $familyBackground->spouse_occupation }}</p>
<p class="personal-info spouse-employer-name">{{ $familyBackground->spouse_employer_name }}</p>
<p class="personal-info spouse-business-address">{{ $familyBackground->spouse_business_address }}</p>
<p class="personal-info spouse-telephone-no">{{ $familyBackground->spouse_telephone_no }}</p>

<p class="personal-info father-surname">{{ $familyBackground->father_surname }}</p>
<p class="personal-info father-first-name">{{ $familyBackground->father_first_name }}</p>
<p class="personal-info father-middle-name">{{ $familyBackground->father_middle_name }}</p>
<p class="personal-info father-suffix">{{ $familyBackground->father_suffix }}</p>

<p class="personal-info mother-maiden-name">{{ $familyBackground->mother_maiden_name }}</p>
<p class="personal-info mother-surname">{{ $familyBackground->mother_surname }}</p>
<p class="personal-info mother-first-name">{{ $familyBackground->mother_first_name }}</p>
<p class="personal-info mother-middle-name">{{ $familyBackground->mother_middle_name }}</p>

<style>
    .child-row {
    height: 40px; /* Adjust height as needed */
}

.child-row td {
    padding: 5px; /* Adjust padding as needed */
}

</style>
@endif
<table class="personal-info children-table" border="1" style="border-collapse: collapse;">
    <tbody>
        @foreach ($children as $child)
        <tr>
            <td style="width: 67%;">{{ $child->child_name }}</td>
            <td style="width: 33%;">{{ \Carbon\Carbon::parse($child->date_of_birth)->format('m/d/Y') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>


<table class="personal-info education-table" style="border-collapse: collapse;">
    <tbody>
        @foreach (['Elementary', 'Secondary', 'Vocational', 'College', 'Graduate Studies'] as $level)
            <tr class="{{ strtolower(str_replace(' ', '-', $level)) }}">
                @php
                    $educationData = $educationalBackground[$level] ?? [];
                @endphp
                @if (count($educationData) > 0)
                    @foreach ($educationData as $education)
                        <td class="name-of-school">{{ $education->school_name }}</td>
                        <td class="degree-course">{{ $education->course_name }}</td>
                        <td class="attendance-from">{{ $education->period_of_attendance_from }}</td>
                        <td class="attendance-to">{{ $education->period_of_attendance_to }}</td>
                        <td class="highest-level">{{ $education->highest_level_units_earned }}</td>
                        <td class="year-graduated">{{ $education->year_graduated }}</td>
                        <td class="honors-received">{{ $education->honors_received }}</td>
                    @endforeach
                @else
                    <td colspan="7" class="no-data"></td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
    </div>
    <div class="page">
        <img src="{{ $image2 }}" class="full-page-image" alt="Background Image 2">
        @if($civilServiceEligibility->isNotEmpty())
        <table class="personal-info civil-service-table" style="border-collapse: collapse;" border="1">
            <tbody>
                @foreach($civilServiceEligibility as $eligibility)
                <tr>
                    <td class="career-service">{{ $eligibility->career_service }}</td>
                    <td class="rating">{{ $eligibility->rating }}</td>
                    <td class="date-of-examination">{{ \Carbon\Carbon::parse($eligibility->date_of_examination)->format('m/d/Y') }}</td>
                    <td class="place-of-examination">{{ $eligibility->place_of_examination }}</td>
                    <td class="license-number">{{ $eligibility->license_number }}</td>
                    <td class="license-validity">{{ \Carbon\Carbon::parse($eligibility->license_validity)->format('m/d/Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
        @if($workExperience->isNotEmpty())
<table class="personal-info workexperience-table" style="border-collapse: collapse;" border="1">
    <tbody>
        @foreach($workExperience as $experience)
        <tr>
            <td class="work-inclusive-dates-from">{{ \Carbon\Carbon::parse($experience->inclusive_dates_from)->format('m/d/Y') }}</td>
            <td class="work-inclusive-dates-to">{{ \Carbon\Carbon::parse($experience->inclusive_dates_to)->format('m/d/Y') }}</td>
            <td class="position-title">{{ $experience->position_title }}</td>
            <td class="department">{{ $experience->department }}</td>
            <td class="monthly-salary">{{ $experience->monthly_salary }}</td>
            <td class="salary-grade-step">{{ $experience->salary_grade_step }}</td>
            <td class="status-of-appointment">{{ $experience->status_of_appointment }}</td>
            <td class="government-service">{{ $experience->government_service ? 'Yes' : 'No' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif

    </div>

    <div class="page">
        <img src="{{ $image3 }}" class="full-page-image" alt="Background Image 3">
        @if($voluntaryWork->isNotEmpty())
        <table class="personal-info voluntarywork-table" style="border-collapse: collapse;" border="1">
            <tbody>
                @foreach($voluntaryWork as $work)
                <tr>
                    <td  class="organization-name">{{ $work->organization_name }}-{{ $work->organization_address }}</td>
                    <td class="inclusive-dates-from">{{ \Carbon\Carbon::parse($work->inclusive_dates_from)->format('m/d/Y') }}</td>
                    <td class="inclusive-dates-to">{{ \Carbon\Carbon::parse($work->inclusive_dates_to)->format('m/d/Y') }}</td>
                    <td class="number-of-hours">{{ $work->number_of_hours }}</td>
                    <td class="position-nature-of-work">{{ $work->position_nature_of_work }}</td>

                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
        <table class="personal-info learning-development-table" border="1"
        <tbody>
            @foreach($learningDevelopment as $learning)
            <tr>
                    <td class="program-title">{{ $learning->title_of_program }}</td>
                    <td class="inclusive-dates-from">{{ \Carbon\Carbon::parse($learning->inclusive_dates_from)->format('m/d/Y') }}</td>
                    <td class="inclusive-dates-to">{{ \Carbon\Carbon::parse($learning->inclusive_dates_to)->format('m/d/Y') }}</td>
                    <td class="hours">{{ $learning->number_of_hours }}</td>
                    <td class="type-of-ld">{{ $learning->type_of_ld }}</td>
                    <td class="conducted-by">{{ $learning->conducted_by }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
@if($otherInformation->isNotEmpty())
<table class="personal-info otherinformation-table" style="border-collapse: collapse;" border="1">
    <tbody>
        @php
            // Ensure the array for each type exists even if there are no records
            $specialSkills = $otherInformation['Special Skill or Hobby'] ?? [];
            $nonAcademicDistinctions = $otherInformation['Non-Academic Distinction'] ?? [];
            $memberships = $otherInformation['Membership'] ?? [];
            
            // Find the maximum number of rows we need to display
            $maxRows = max(count($specialSkills), count($nonAcademicDistinctions), count($memberships));
        @endphp

        @for($i = 0; $i < $maxRows; $i++)
        <tr class="otherinformation-tr">
            <td class="special-skills">{{ $specialSkills[$i]->description ?? '' }}</td>
            <td class="non-academic-distinctions">{{ $nonAcademicDistinctions[$i]->description ?? '' }}</td>
            <td class="memberships">{{ $memberships[$i]->description ?? '' }}</td>
        </tr>
        @endfor
    </tbody>
</table>
@endif

    </div>

    <div class="page">
        <img src="{{ $image4 }}" class="full-page-image" alt="Background Image 4">
        @if($legalQuestionnaire)
        {{-- Related to authority within third degree --}}
        @if($legalQuestionnaire->related_to_authority_within_third_degree)
            <div class="personal-info related-to-authority-third-yes">
                <span style="font-family:zapfdingbats;">3</span>
            </div>
        @else
            <div class="personal-info related-to-authority-third-no">
                <i class="fa-solid fa-xmark"></i>
            </div>
        @endif
    
        {{-- Related to authority within fourth degree --}}
        @if($legalQuestionnaire->related_to_authority_within_fourth_degree)
            <div class="personal-info related-to-authority-fourth-yes">
                <span style="font-family:zapfdingbats;">3</span>
            </div>
        @else
            <div class="personal-info related-to-authority-fourth-no">
                <i class="fa-solid fa-xmark"></i>
            </div>
        @endif
    
        {{-- Found guilty of offense --}}
        @if($legalQuestionnaire->found_guilty_of_offense)
            <div class="personal-info found-guilty-yes">
                <span style="font-family:zapfdingbats;">3</span>
            </div>
        @else
            <div class="personal-info found-guilty-no">
                <i class="fa-solid fa-xmark"></i>
            </div>
        @endif
    
        {{-- Criminally charged --}}
        @if($legalQuestionnaire->criminally_charged)
            <div class="personal-info criminally-charged-yes">
                <span style="font-family:zapfdingbats;">3</span>
            </div>
        @else
            <div class="personal-info criminally-charged-no">
                <i class="fa-solid fa-xmark"></i>
            </div>
        @endif
    
        {{-- Convicted of crime --}}
        @if($legalQuestionnaire->convicted_of_crime)
            <div class="personal-info convicted-of-crime-yes">
                <span style="font-family:zapfdingbats;">3</span>
            </div>
        @else
            <div class="personal-info convicted-of-crime-no">
                <i class="fa-solid fa-xmark"></i>
            </div>
        @endif
    
        {{-- Separated from service --}}
        @if($legalQuestionnaire->separated_from_service)
            <div class="personal-info separated-from-service-yes">
                <span style="font-family:zapfdingbats;">3</span>
            </div>
        @else
            <div class="personal-info separated-from-service-no">
                <i class="fa-solid fa-xmark"></i>
            </div>
        @endif
    
        {{-- Election candidate --}}
        @if($legalQuestionnaire->election_candidate)
            <div class="personal-info election-candidate-yes">
                <span style="font-family:zapfdingbats;">3</span>
            </div>
        @else
            <div class="personal-info election-candidate-no">
                <i class="fa-solid fa-xmark"></i>
            </div>
        @endif
    
        {{-- Resigned for campaign --}}
        @if($legalQuestionnaire->resigned_for_campaign)
            <div class="personal-info resigned-for-campaign-yes">
                <span style="font-family:zapfdingbats;">3</span>
            </div>
        @else
            <div class="personal-info resigned-for-campaign-no">
                <i class="fa-solid fa-xmark"></i>
            </div>
        @endif
    
        {{-- Immigrant status --}}
        @if($legalQuestionnaire->immigrant_status)
            <div class="personal-info immigrant-status-yes">
                <span style="font-family:zapfdingbats;">3</span>
            </div>
        @else
            <div class="personal-info immigrant-status-no">
                <i class="fa-solid fa-xmark"></i>
            </div>
        @endif
    
        {{-- Indigenous group member --}}
        @if($legalQuestionnaire->indigenous_group_member)
            <div class="personal-info indigenous-group-member-yes">
                <span style="font-family:zapfdingbats;">3</span>
            </div>
        @else
            <div class="personal-info indigenous-group-member-no">
                <i class="fa-solid fa-xmark"></i>
            </div>
        @endif
    
        {{-- Person with disability --}}
        @if($legalQuestionnaire->person_with_disability)
            <div class="personal-info person-with-disability-yes">
                <span style="font-family:zapfdingbats;">3</span>
            </div>
        @else
            <div class="personal-info person-with-disability-no">
                <i class="fa-solid fa-xmark"></i>
            </div>
        @endif
    
        {{-- Solo parent --}}
        @if($legalQuestionnaire->solo_parent)
            <div class="personal-info solo-parent-yes">
                <span style="font-family:zapfdingbats;">3</span>
            </div>
        @else
            <div class="personal-info solo-parent-no">
                <i class="fa-solid fa-xmark"></i>
            </div>
        @endif
    

<!-- Non-boolean fields displayed as paragraphs -->
<p class="personal-info relation-details">{{ $legalQuestionnaire->relation_details }}</p>
<p class="personal-info relation-details-fourth">{{ $legalQuestionnaire->relation_details_fourth }}</p>
<p class="personal-info offense-details">{{ $legalQuestionnaire->offense_details }}</p>
<p class="personal-info criminal-charge-details">{{ $legalQuestionnaire->criminal_charge_details }}</p>
<p class="personal-info criminal-charge-date">{{ $legalQuestionnaire->criminal_charge_date }}</p>
<p class="personal-info criminal-charge-status">{{ $legalQuestionnaire->criminal_charge_status }}</p>
<p class="personal-info conviction-details">{{ $legalQuestionnaire->conviction_details }}</p>
<p class="personal-info separation-details">{{ $legalQuestionnaire->separation_details }}</p>
<p class="personal-info election-details">{{ $legalQuestionnaire->election_details }}</p>
<p class="personal-info resignation-details">{{ $legalQuestionnaire->resignation_details }}</p>
<p class="personal-info immigrant-country">{{ $legalQuestionnaire->immigrant_country }}</p>
<p class="personal-info indigenous-group-details">{{ $legalQuestionnaire->indigenous_group_details }}</p>
<p class="personal-info disability-id-number">{{ $legalQuestionnaire->disability_id_number }}</p>
<p class="personal-info solo-parent-id-number">{{ $legalQuestionnaire->solo_parent_id_number }}</p>
<p class="personal-info government-id-type">{{ $legalQuestionnaire->government_id_type }}</p>
<p class="personal-info government-id-number">{{ $legalQuestionnaire->government_id_number }}</p>
<p class="personal-info id-issuance-date">{{ $legalQuestionnaire->id_issuance_date }}</p>
<p class="personal-info id-issuance-place">{{ $legalQuestionnaire->id_issuance_place }}</p>
{{-- <p class="personal-info signature">{{ $legalQuestionnaire->signature }}</p> --}}
<p class="personal-info date-accomplished">{{ $legalQuestionnaire->date_accomplished }}</p>
{{-- <p class="personal-info right-thumbmark">{{ $legalQuestionnaire->right_thumbmark }}</p> --}}
{{-- <p class="personal-info date-sworn">{{ $legalQuestionnaire->date_sworn }}</p> --}}
<p class="personal-info person-administering-oath">{{ $legalQuestionnaire->person_administering_oath }}</p>


    @endif
    
    @if($pdsReferences->isNotEmpty())
    <h2>PDS References</h2>
    <table class="personal-info pds-references-table" style="border-collapse: collapse;" border="1">
        <tbody>
            @foreach($pdsReferences as $reference)
                <tr>
                    <td style="width: 55%;">{{ $reference->reference_name }}</td>
                    <td style="width: 29%;">{{ $reference->reference_address }}</td>
                    <td style="width: 19%;">{{ $reference->reference_telephone }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

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
