@include('applicant.psdtopbar')

    <h1 class="page-title">Voluntary Work</h1>
    <table class="voluntary-work-table">
        <thead>
            <tr>
                <th>Organization Name</th>
                <th>Address</th>
                <th>Position/Nature of Work</th>
                <th>From Date</th>
                <th>To Date</th>
                <th>Hours Worked</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($voluntaryWorks as $work)
                <tr>
                    <td>{{ $work->organization_name }}</td>
                    <td>{{ $work->organization_address }}</td>
                    <td>{{ $work->position_nature_of_work }}</td>
                    <td>{{ $work->inclusive_dates_from }}</td>
                    <td>{{ $work->inclusive_dates_to }}</td>
                    <td>{{ $work->number_of_hours }}</td>
                    <td>
                        <a href="{{ route('applicant.voluntarywork', ['edit' => $work->id]) }}" class="update-button"><i class="fas fa-edit"></i> </a>
                        <form action="{{ route('applicant.voluntarywork.delete', $work->id) }}" method="POST" class="inline-form" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-button"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach




        </tbody>
    </table>
    <!-- Form to Add or Edit Voluntary Work Entries -->
    <h3 class="section-title">{{ isset($editWork) ? 'Edit Voluntary Work' : 'Add Voluntary Work' }}</h3>
    <form action="{{ isset($editWork) ? route('applicant.voluntarywork.update', $editWork->id) : route('applicant.voluntarywork.store') }}" method="POST" class="form-container">
        @csrf
        @if(isset($editWork))
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="organization_name">Organization Name:</label>
            <input type="text" id="organization_name" name="organization_name" value="{{ $editWork->organization_name ?? '' }}" required>
        </div>

        <div class="form-group">
            <label for="organization_address">Organization Address:</label>
            <input type="text" id="organization_address" name="organization_address" value="{{ $editWork->organization_address ?? '' }}" required>
        </div>

        <div class="form-group">
            <label for="position_nature_of_work">Position/Nature of Work:</label>
            <input type="text" id="position_nature_of_work" name="position_nature_of_work" value="{{ $editWork->position_nature_of_work ?? '' }}" required>
        </div>

        <div class="form-group">
            <label for="inclusive_dates_from">From Date:</label>
            <input type="date" id="inclusive_dates_from" name="inclusive_dates_from" value="{{ $editWork->inclusive_dates_from ?? '' }}" required>
        </div>

        <div class="form-group">
            <label for="inclusive_dates_to">To Date:</label>
            <input type="date" id="inclusive_dates_to" name="inclusive_dates_to" value="{{ $editWork->inclusive_dates_to ?? '' }}" required>
        </div>

        <div class="form-group">
            <label for="number_of_hours">Number of Hours:</label>
            <input type="number" id="number_of_hours" name="number_of_hours" value="{{ $editWork->number_of_hours ?? '' }}" required>
        </div>

        <button type="submit" class="submit-button">{{ isset($editWork) ? 'Update' : 'Add' }}</button>
    </form>
    <br>
    <hr>
    <div class="navigation-buttons">
        <button id="back-button" class="nav-button" onclick="goBack()">Back</button>
        <button id="next-button" class="nav-button" onclick="goNext()">Next</button>
    </div>
    

</div>
<script>
    function goBack() {
        // Navigate to the specified back URL
        window.location.href = '/applicant/work-experience'; // Replace with the actual URL
    }
    
    function goNext() {
        // Navigate to the specified next URL
        window.location.href = '/applicant/learning-development'; // Replace with the actual URL
    }
    </script>
    
</html>