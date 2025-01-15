@include('applicant.psdtopbar');
<h1 class="page-title">References</h1>
<!-- Family Background Form -->
<h3 class="section-title">Family Background</h3>
<form method="POST" action="{{ url('applicant/referencespds/family-background') }}" class="">
    @csrf
    <div class="form-group">
        <label>Spouse Surname:</label>
        <input type="text" name="spouse_surname" value="{{ $familyBackground->spouse_surname ?? '' }}" required>
    </div>

    <div class="form-group">
        <label>Spouse First Name:</label>
        <input type="text" name="spouse_first_name" value="{{ $familyBackground->spouse_first_name ?? '' }}" required>
    </div>

    <div class="form-group">
        <label>Spouse Middle Name:</label>
        <input type="text" name="spouse_middle_name" value="{{ $familyBackground->spouse_middle_name ?? '' }}" required>
    </div>

    <div class="form-group">
        <label>Spouse Occupation:</label>
        <input type="text" name="spouse_occupation" value="{{ $familyBackground->spouse_occupation ?? '' }}">
    </div>

    <div class="form-group">
        <label>Spouse Employer Name:</label>
        <input type="text" name="spouse_employer_name" value="{{ $familyBackground->spouse_employer_name ?? '' }}">
    </div>

    <div class="form-group">
        <label>Spouse Business Address:</label>
        <input type="text" name="spouse_business_address" value="{{ $familyBackground->spouse_business_address ?? '' }}">
    </div>

    <div class="form-group">
        <label>Spouse Telephone No:</label>
        <input type="text" name="spouse_telephone_no" value="{{ $familyBackground->spouse_telephone_no ?? '' }}">
    </div>

    <div class="form-group">
        <label>Father Surname:</label>
        <input type="text" name="father_surname" value="{{ $familyBackground->father_surname ?? '' }}" required>
    </div>

    <div class="form-group">
        <label>Father First Name:</label>
        <input type="text" name="father_first_name" value="{{ $familyBackground->father_first_name ?? '' }}" required>
    </div>

    <div class="form-group">
        <label>Father Middle Name:</label>
        <input type="text" name="father_middle_name" value="{{ $familyBackground->father_middle_name ?? '' }}">
    </div>

    <div class="form-group">
        <label>Mother Maiden Name:</label>
        <input type="text" name="mother_maiden_name" value="{{ $familyBackground->mother_maiden_name ?? '' }}">
    </div>

    <button type="submit" class="submit-button">Save Family Background</button>
</form>
<hr>

<!-- Children Section -->
<h3 class="section-title">Children</h3>

<!-- List of Children -->
@foreach($children as $child)
    <form method="POST" action="{{ url('applicant/referencespds/child/' . $child->id) }}" class="form-container">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Child Name:</label>
            <input type="text" name="child_name" value="{{ $child->child_name }}" required>
        </div>

        <div class="form-group">
            <label>Date of Birth:</label>
            <input type="date" name="date_of_birth" value="{{ $child->date_of_birth }}" required>
        </div>

        <div class="button-group">
            <button type="submit" class="update-button" title="Update Child">
                <i class="fas fa-edit"></i> <!-- Font Awesome edit icon -->
            </button>
            <form method="POST" action="{{ url('applicant/referencespds/child/' . $child->id) }}" class="delete-form">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-button" title="Delete Child">
                    <i class="fas fa-trash"></i> <!-- Font Awesome trash icon -->
                </button>
            </form>
        </div>
    </form>
@endforeach
<form method="POST" action="{{ url('applicant/referencespds/child') }}">
    @csrf
    <div class="form-group">
        <label>Add Child Name:</label>
        <input type="text" name="child_name" required>
    </div>

    <div class="form-group">
        <label>Date of Birth:</label>
        <input type="date" name="date_of_birth" required>
    </div>

    <button type="submit" class="submit-button">Add Child</button>
</form>
<br>
<hr>
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
        window.location.href = '/applicant/educational-background'; // Replace with the actual URL
    }
    </script>
    
</html>