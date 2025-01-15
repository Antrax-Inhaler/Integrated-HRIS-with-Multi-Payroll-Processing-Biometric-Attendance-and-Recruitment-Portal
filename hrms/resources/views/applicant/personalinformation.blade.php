@include('applicant.psdtopbar');

<h1>Personal Data Sheet (Revised 2016)</h1>
<p><strong>Print legibly. Tick appropriate boxes and use a separate sheet if necessary. Indicate N/A if not applicable. DO NOT ABBREVIATE.</strong></p>

<form action="{{ route('applicant.savePersonalInformation') }}" method="POST">
@csrf

<!-- Section I: Personal Information -->
<div class="section-title">I. Personal Information</div>

<div class="form-group">
    <label for="surname">Surname</label>
    <input type="text" id="surname" name="surname" value="{{ old('surname', $personalInformation->surname) }}" required>
</div>

<div class="form-group">
    <label for="first_name">First Name</label>
    <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $personalInformation->first_name) }}" required>
</div>

<div class="form-group">
    <label for="middle_name">Middle Name</label>
    <input type="text" id="middle_name" name="middle_name" value="{{ old('middle_name', $personalInformation->middle_name) }}">
</div>

<div class="form-group">
    <label for="name_extension">Name Extension (JR, SR, etc.)</label>
    <input type="text" id="name_extension" name="name_extension" value="{{ old('name_extension', $personalInformation->name_extension) }}">
</div>

<div class="form-group">
    <label for="date_of_birth">Date of Birth</label>
    <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $personalInformation->date_of_birth) }}" required>
</div>

<div class="form-group">
    <label for="place_of_birth">Place of Birth</label>
    <input type="text" id="place_of_birth" name="place_of_birth" value="{{ old('place_of_birth', $personalInformation->place_of_birth) }}">
</div>

<div class="form-group">
    <label for="sex">Sex</label>
    <select id="sex" name="sex" required>
        <option value="Male" {{ old('sex', $personalInformation->sex) == 'Male' ? 'selected' : '' }}>Male</option>
        <option value="Female" {{ old('sex', $personalInformation->sex) == 'Female' ? 'selected' : '' }}>Female</option>
    </select>
</div>

<div class="form-group">
    <label for="civil_status">Civil Status</label>
    <select id="civil_status" name="civil_status" required>
        <option value="Single" {{ old('civil_status', $personalInformation->civil_status) == 'Single' ? 'selected' : '' }}>Single</option>
        <option value="Married" {{ old('civil_status', $personalInformation->civil_status) == 'Married' ? 'selected' : '' }}>Married</option>
        <option value="Widowed" {{ old('civil_status', $personalInformation->civil_status) == 'Widowed' ? 'selected' : '' }}>Widowed</option>
        <option value="Separated" {{ old('civil_status', $personalInformation->civil_status) == 'Separated' ? 'selected' : '' }}>Separated</option>
        <option value="Other" {{ old('civil_status', $personalInformation->civil_status) == 'Other' ? 'selected' : '' }}>Other</option>
    </select>
</div>

<div class="form-group">
    <label for="citizenship">Citizenship</label>
    <input type="text" id="citizenship" name="citizenship" value="{{ old('citizenship', $personalInformation->citizenship) }}" required>
</div>

<div class="form-group">
    <label for="dual_citizenship_country">Country for Dual Citizenship</label>
    <input type="text" id="dual_citizenship_country" name="dual_citizenship_country" value="{{ old('dual_citizenship_country', $personalInformation->dual_citizenship_country) }}">
</div>

<div class="form-group">
    <label for="dual_citizenship_by">Dual Citizenship By</label>
    <select id="dual_citizenship_by" name="dual_citizenship_by">
        <option value="By birth" {{ old('dual_citizenship_by', $personalInformation->dual_citizenship_by) == 'By birth' ? 'selected' : '' }}>By birth</option>
        <option value="By naturalization" {{ old('dual_citizenship_by', $personalInformation->dual_citizenship_by) == 'By naturalization' ? 'selected' : '' }}>By naturalization</option>
    </select>
</div>

<!-- Residential Address -->
<div class="section-title">Residential Address</div><style>
    .card-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .card {
        width: 250px;
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        background-color: white;
        transition: transform 0.3s;
    }

    .card:hover {
        transform: scale(1.05);
    }

    .card-header {
        background-color: #007bff;
        padding: 15px;
        color: white;
        font-size: 18px;
        text-align: center;
        position: relative;
    }

    .card-header i {
        position: absolute;
        top: 15px;
        left: 15px;
    }

    .card-body {
        padding: 15px;
    }

    .card-body p {
        margin: 5px 0;
        font-size: 14px;
    }

    .card-body i {
        margin-right: 8px;
        color: #007bff;
    }

    .card-footer {
        padding: 15px;
        text-align: center;
        background-color: #f8f9fa;
    }

    .card-footer .btn {
        margin-right: 5px;
        margin-left: 5px;
        padding: 5px 10px;
    }
    .save-container{
        display: flex;
        justify-content: flex-end;
    }
</style>
<div class="form-group">
    <label for="residential_house_no">House/Block/Lot No.</label>
    <input type="text" id="residential_house_no" name="residential_house_no" value="{{ old('residential_house_no', $personalInformation->residential_house_no) }}">
</div>
<div class="form-group">
    <label for="residential_street">Street</label>
    <input type="text" id="residential_street" name="residential_street" value="{{ old('residential_street', $personalInformation->residential_street) }}">
</div>
<div class="form-group">
    <label for="residential_subdivision">Subdivision/Village</label>
    <input type="text" id="residential_subdivision" name="residential_subdivision" value="{{ old('residential_subdivision', $personalInformation->residential_subdivision) }}">
</div>
<div class="form-group">
    <label for="residential_barangay">Barangay</label>
    <input type="text" id="residential_barangay" name="residential_barangay" value="{{ old('residential_barangay', $personalInformation->residential_barangay) }}">
</div>
<div class="form-group">
    <label for="residential_city_municipality">City/Municipality</label>
    <input type="text" id="residential_city_municipality" name="residential_city_municipality" value="{{ old('residential_city_municipality', $personalInformation->residential_city_municipality) }}">
</div>
<div class="form-group">
    <label for="residential_province">Province</label>
    <input type="text" id="residential_province" name="residential_province" value="{{ old('residential_province', $personalInformation->residential_province) }}">
</div>
<div class="form-group">
    <label for="residential_zip_code">Zip Code</label>
    <input type="text" id="residential_zip_code" name="residential_zip_code" value="{{ old('residential_zip_code', $personalInformation->residential_zip_code) }}">
</div>

<!-- Permanent Address -->
<div class="section-title">Permanent Address</div>
<div class="form-group">
    <label for="permanent_house_no">House/Block/Lot No.</label>
    <input type="text" id="permanent_house_no" name="permanent_house_no" value="{{ old('permanent_house_no', $personalInformation->permanent_house_no) }}">
</div>
<div class="form-group">
    <label for="permanent_street">Street</label>
    <input type="text" id="permanent_street" name="permanent_street" value="{{ old('permanent_street', $personalInformation->permanent_street) }}">
</div>
<div class="form-group">
    <label for="permanent_subdivision">Subdivision/Village</label>
    <input type="text" id="permanent_subdivision" name="permanent_subdivision" value="{{ old('permanent_subdivision', $personalInformation->permanent_subdivision) }}">
</div>
<div class="form-group">
    <label for="permanent_barangay">Barangay</label>
    <input type="text" id="permanent_barangay" name="permanent_barangay" value="{{ old('permanent_barangay', $personalInformation->permanent_barangay) }}">
</div>
<div class="form-group">
    <label for="permanent_city_municipality">City/Municipality</label>
    <input type="text" id="permanent_city_municipality" name="permanent_city_municipality" value="{{ old('permanent_city_municipality', $personalInformation->permanent_city_municipality) }}">
</div>
<div class="form-group">
    <label for="permanent_province">Province</label>
    <input type="text" id="permanent_province" name="permanent_province" value="{{ old('permanent_province', $personalInformation->permanent_province) }}">
</div>
<div class="form-group">
    <label for="permanent_zip_code">Zip Code</label>
    <input type="text" id="permanent_zip_code" name="permanent_zip_code" value="{{ old('permanent_zip_code', $personalInformation->permanent_zip_code) }}">
</div>

<!-- Contact Information -->
<div class="section-title">Contact Information</div>
<div class="form-group">
    <label for="telephone_no">Telephone No.</label>
    <input type="text" id="telephone_no" name="telephone_no" value="{{ old('telephone_no', $personalInformation->telephone_no) }}">
</div>
<div class="form-group">
    <label for="mobile_no">Mobile No.</label>
    <input type="text" id="mobile_no" name="mobile_no" value="{{ old('mobile_no', $personalInformation->mobile_no) }}" required>
</div>
<div class="form-group">
    <label for="email_address">Email Address</label>
    <input type="email" id="email_address" name="email_address" value="{{ old('email_address', $personalInformation->email_address) }}" required>
</div>
<!-- Additional Fields -->
<div class="section-title">Additional Fields</div>

<div class="form-group">
    <label for="height">Height (meter)</label>
    <input type="text" id="height" name="height" value="{{ old('height', $personalInformation->height) }}">
</div>
<div class="form-group">
    <label for="weight">Weight (kg)</label>
    <input type="text" id="weight" name="weight" value="{{ old('weight', $personalInformation->weight) }}">
</div>
<div class="form-group">
    <label for="blood_type">Blood Type</label>
    <input type="text" id="blood_type" name="blood_type" value="{{ old('blood_type', $personalInformation->blood_type) }}">
</div>
<div class="form-group">
    <label for="gsis_no">GSIS No.</label>
    <input type="text" id="gsis_no" name="gsis_no" value="{{ old('gsis_no', $personalInformation->gsis_no) }}">
</div>
<div class="form-group">
    <label for="pagibig_no">PAG-IBIG No.</label>
    <input type="text" id="pagibig_no" name="pagibig_no" value="{{ old('pagibig_no', $personalInformation->pagibig_no) }}">
</div>
<div class="form-group">
    <label for="philhealth_no">PhilHealth No.</label>
    <input type="text" id="philhealth_no" name="philhealth_no" value="{{ old('philhealth_no', $personalInformation->philhealth_no) }}">
</div>
<div class="form-group">
    <label for="sss_no">SSS No.</label>
    <input type="text" id="sss_no" name="sss_no" value="{{ old('sss_no', $personalInformation->sss_no) }}">
</div>
<div class="form-group">
    <label for="tin_no">TIN No.</label>
    <input type="text" id="tin_no" name="tin_no" value="{{ old('tin_no', $personalInformation->tin_no) }}">
</div>
<div class="form-group">
    <label for="agency_employee_no">Agency Employee No.</label>
    <input type="text" id="agency_employee_no" name="agency_employee_no" value="{{ old('agency_employee_no', $personalInformation->agency_employee_no) }}">
</div>

<div class="save-container">
    <button type="submit" class="submit-button">Save</button>
</div>
</form>
<div class="navigation-buttons">
    <button id="back-button" class="nav-button" onclick="goBack()">Back</button>
    <button id="next-button" class="nav-button" onclick="goNext()">Next</button>
</div>

</div>
</body>
<script>
    function goBack() {
        // Navigate to the specified back URL
        window.location.href = '/applicant/personal-information'; // Replace with the actual URL
    }
    
    function goNext() {
        // Navigate to the specified next URL
        window.location.href = '/applicant/referencespds'; // Replace with the actual URL
    }
    </script>
    
</html>