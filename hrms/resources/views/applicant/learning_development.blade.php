@include('applicant.psdtopbar')

<div class="container">
    <h1 class="page-title">Learning & Development Programs</h1>

    <!-- Form to Add or Edit Learning Development Entries -->
    <h3 class="section-title">{{ isset($editLearningDevelopment) ? 'Edit Learning & Development Program' : 'Add Learning & Development Program' }}</h3>
    <form action="{{ isset($editLearningDevelopment) ? route('applicant.learning_development.update', $editLearningDevelopment->id) : route('applicant.learning_development.store') }}" method="POST" class="form-container">
        @csrf
        @if(isset($editLearningDevelopment))
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="title_of_program">Title of Program:</label>
            <input type="text" id="title_of_program" name="title_of_program" value="{{ $editLearningDevelopment->title_of_program ?? '' }}" required>
        </div>

        <div class="form-group">
            <label for="type_of_ld">Type of Learning Development:</label>
            <select id="type_of_ld" name="type_of_ld" required>
                <option value="Managerial" {{ isset($editLearningDevelopment) && $editLearningDevelopment->type_of_ld == 'Managerial' ? 'selected' : '' }}>Managerial</option>
                <option value="Supervisory" {{ isset($editLearningDevelopment) && $editLearningDevelopment->type_of_ld == 'Supervisory' ? 'selected' : '' }}>Supervisory</option>
                <option value="Technical" {{ isset($editLearningDevelopment) && $editLearningDevelopment->type_of_ld == 'Technical' ? 'selected' : '' }}>Technical</option>
                <option value="Other" {{ isset($editLearningDevelopment) && $editLearningDevelopment->type_of_ld == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>

        <div class="form-group">
            <label for="conducted_by">Conducted/Sponsored By:</label>
            <input type="text" id="conducted_by" name="conducted_by" value="{{ $editLearningDevelopment->conducted_by ?? '' }}" required>
        </div>

        <div class="form-group">
            <label for="inclusive_dates_from">From Date:</label>
            <input type="date" id="inclusive_dates_from" name="inclusive_dates_from" value="{{ $editLearningDevelopment->inclusive_dates_from ?? '' }}" required>
        </div>

        <div class="form-group">
            <label for="inclusive_dates_to">To Date:</label>
            <input type="date" id="inclusive_dates_to" name="inclusive_dates_to" value="{{ $editLearningDevelopment->inclusive_dates_to ?? '' }}" required>
        </div>

        <div class="form-group">
            <label for="number_of_hours">Number of Hours:</label>
            <input type="number" id="number_of_hours" name="number_of_hours" value="{{ $editLearningDevelopment->number_of_hours ?? '' }}" required>
        </div>

        <button type="submit" class="submit-button">{{ isset($editLearningDevelopment) ? 'Update' : 'Add' }}</button>
    </form>
    <br>
    <hr>

    <!-- Table of Existing Learning Development Entries -->
    <h3 class="section-title">Existing Learning & Development Programs</h3>
    <table class="learning-development-table">
        <thead>
            <tr>
                <th>Title of Program</th>
                <th>Type of Learning Development</th>
                <th>Conducted By</th>
                <th>From Date</th>
                <th>To Date</th>
                <th>Number of Hours</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($learningDevelopments as $development)
                <tr>
                    <td>{{ $development->title_of_program }}</td>
                    <td>{{ $development->type_of_ld }}</td>
                    <td>{{ $development->conducted_by }}</td>
                    <td>{{ $development->inclusive_dates_from }}</td>
                    <td>{{ $development->inclusive_dates_to }}</td>
                    <td>{{ $development->number_of_hours }}</td>
                    <td>
                        <a href="{{ route('applicant.learning_development', ['edit' => $development->id]) }}" class="edit-link">Edit</a>
                        <form action="{{ route('applicant.learning_development.delete', $development->id) }}" method="POST" class="inline-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-button">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Navigation Buttons -->
    <div class="navigation-buttons">
        <button id="back-button" class="nav-button" onclick="goBack()">Back</button>
        <button id="next-button" class="nav-button" onclick="goNext()">Next</button>
    </div>
</div>

<!-- Navigation Scripts -->
<script>
    function goBack() {
        // Navigate to the specified back URL
        window.location.href = '/applicant/voluntary-work'; // Replace with the actual URL
    }
    
    function goNext() {
        // Navigate to the specified next URL
        window.location.href = '/applicant/other-information'; // Replace with the actual URL
    }
</script>
