@include('applicant.psdtopbar')

    <h1 class="page-title">Other Information</h1>

    <!-- Form to Add or Edit Other Information Entries -->
    <h3 class="section-title">{{ isset($editOtherInformation) ? 'Edit Other Information' : 'Add Other Information' }}</h3>
    <form action="{{ isset($editOtherInformation) ? route('applicant.other_information.update', $editOtherInformation->id) : route('applicant.other_information.store') }}" method="POST" class="form-container">
        @csrf
        @if(isset($editOtherInformation))
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="type">Type:</label>
            <select id="type" name="type" required>
                <option value="Special Skill or Hobby" {{ isset($editOtherInformation) && $editOtherInformation->type == 'Special Skill or Hobby' ? 'selected' : '' }}>Special Skill or Hobby</option>
                <option value="Non-Academic Distinction" {{ isset($editOtherInformation) && $editOtherInformation->type == 'Non-Academic Distinction' ? 'selected' : '' }}>Non-Academic Distinction</option>
                <option value="Membership" {{ isset($editOtherInformation) && $editOtherInformation->type == 'Membership' ? 'selected' : '' }}>Membership</option>
            </select>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <input type="text" id="description" name="description" value="{{ $editOtherInformation->description ?? '' }}" required>
        </div>

        <button type="submit" class="submit-button">{{ isset($editOtherInformation) ? 'Update' : 'Add' }}</button>
    </form>
    <br>
    <hr>

    <!-- Table of Existing Other Information Entries -->
    <h3 class="section-title">Existing Other Information</h3>
    <table class="other-information-table">
        <thead>
            <tr>
                <th>Type</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($otherInformations as $information)
                <tr>
                    <td>{{ $information->type }}</td>
                    <td>{{ $information->description }}</td>
                    <td>
                        <a href="{{ route('applicant.other_information', ['edit' => $information->id]) }}"  class="update-button"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('applicant.other_information.delete', $information->id) }}" method="POST" class="inline-form" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-button"><i class="fas fa-trash"></i></button>
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
        window.location.href = '/applicant/learning-development'; // Replace with the actual URL
    }
    
    function goNext() {
        // Navigate to the specified next URL
        window.location.href = '/applicant/legal-questionnaire'; // Replace with the actual URL
    }
</script>
