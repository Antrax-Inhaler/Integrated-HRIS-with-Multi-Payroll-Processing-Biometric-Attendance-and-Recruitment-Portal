@include('applicant.psdtopbar');

    <h1 class="page-title">Work Experience</h1>

    <!-- Add Work Experience Form -->
    <h3 class="section-title">Add Work Experience</h3>
    <form action="{{ route('applicant.work-experience.store') }}" method="POST" class="form-container">
        @csrf
        <input type="hidden" name="applicant_id" value="{{ Auth::id() }}">

        <div class="form-group">
            <label for="position_title">Position Title:</label>
            <input type="text" id="position_title" name="position_title" required>
        </div>

        <div class="form-group">
            <label for="department">Department:</label>
            <input type="text" id="department" name="department" required>
        </div>

        <div class="form-group">
            <label for="monthly_salary">Monthly Salary:</label>
            <input type="text" id="monthly_salary" name="monthly_salary" required>
        </div>

        <div class="form-group">
            <label for="salary_grade_step">Salary Grade Step:</label>
            <input type="text" id="salary_grade_step" name="salary_grade_step">
        </div>

        <div class="form-group">
            <label for="status_of_appointment">Status of Appointment:</label>
            <input type="text" id="status_of_appointment" name="status_of_appointment" required>
        </div>

        <div class="form-group">
            <label for="government_service">Government Service:</label>
            <select id="government_service" name="government_service" required>
                <option value="Y">Yes</option>
                <option value="N">No</option>
            </select>
        </div>

        <div class="form-group">
            <label for="inclusive_dates_from">Inclusive Dates (From):</label>
            <input type="date" id="inclusive_dates_from" name="inclusive_dates_from" required>
        </div>

        <div class="form-group">
            <label for="inclusive_dates_to">Inclusive Dates (To):</label>
            <input type="date" id="inclusive_dates_to" name="inclusive_dates_to" required>
        </div>

        <button type="submit" class="submit-button">Add Work Experience</button>
    </form>
    <br>
    <hr>

    <!-- Display List of Work Experiences -->
    @foreach($workExperiences as $workExperience)
        <div class="work-experience-item">
            <h3 class="section-title">{{ $workExperience->position_title }}</h3>
            <p>{{ $workExperience->department }}</p>
            <p>{{ $workExperience->monthly_salary }}</p>

            <!-- Edit Form -->
            <form action="{{ route('applicant.work-experience.update', $workExperience->id) }}" method="POST" class="form-container">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="edit_position_title_{{ $workExperience->id }}">Position Title:</label>
                    <input type="text" id="edit_position_title_{{ $workExperience->id }}" name="position_title" value="{{ $workExperience->position_title }}" required>
                </div>

                <div class="form-group">
                    <label for="edit_department_{{ $workExperience->id }}">Department:</label>
                    <input type="text" id="edit_department_{{ $workExperience->id }}" name="department" value="{{ $workExperience->department }}" required>
                </div>

                <div class="form-group">
                    <label for="edit_monthly_salary_{{ $workExperience->id }}">Monthly Salary:</label>
                    <input type="text" id="edit_monthly_salary_{{ $workExperience->id }}" name="monthly_salary" value="{{ $workExperience->monthly_salary }}" required>
                </div>

                <div class="form-group">
                    <label for="edit_salary_grade_step_{{ $workExperience->id }}">Salary Grade Step:</label>
                    <input type="text" id="edit_salary_grade_step_{{ $workExperience->id }}" name="salary_grade_step" value="{{ $workExperience->salary_grade_step }}">
                </div>

                <div class="form-group">
                    <label for="edit_status_of_appointment_{{ $workExperience->id }}">Status of Appointment:</label>
                    <input type="text" id="edit_status_of_appointment_{{ $workExperience->id }}" name="status_of_appointment" value="{{ $workExperience->status_of_appointment }}" required>
                </div>

                <div class="form-group">
                    <label for="edit_government_service_{{ $workExperience->id }}">Government Service:</label>
                    <select id="edit_government_service_{{ $workExperience->id }}" name="government_service" required>
                        <option value="Yes" {{ $workExperience->government_service == 'Yes' ? 'selected' : '' }}>Yes</option>
                        <option value="No" {{ $workExperience->government_service == 'No' ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="edit_inclusive_dates_from_{{ $workExperience->id }}">Inclusive Dates (From):</label>
                    <input type="date" id="edit_inclusive_dates_from_{{ $workExperience->id }}" name="inclusive_dates_from" value="{{ $workExperience->inclusive_dates_from }}" required>
                </div>

                <div class="form-group">
                    <label for="edit_inclusive_dates_to_{{ $workExperience->id }}">Inclusive Dates (To):</label>
                    <input type="date" id="edit_inclusive_dates_to_{{ $workExperience->id }}" name="inclusive_dates_to" value="{{ $workExperience->inclusive_dates_to }}" required>
                </div>

                <div class="button-group">
                    <button type="submit" class="update-button" >                    <i class="fas fa-edit"></i> 
                    </button>
                    <form action="{{ route('applicant.work-experience.destroy', $workExperience->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-button">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </form>



            <br>
            <hr>
        </div>
    @endforeach
    <div class="navigation-buttons">
        <button id="back-button" class="nav-button" onclick="goBack()">Back</button>
        <button id="next-button" class="nav-button" onclick="goNext()">Next</button>
    </div>
</div>
</div>
</body>
<script>
    function goBack() {
        window.location.href = '/applicant/civilserviceeligibility';
    }
    
    function goNext() {
        window.location.href = '/applicant/voluntary-work';
    }
</script>

</html>