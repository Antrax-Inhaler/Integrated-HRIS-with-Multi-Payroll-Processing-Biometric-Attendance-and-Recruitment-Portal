@include('applicant.psdtopbar')

<h1>References</h1>

<!-- Form to add or edit reference entries -->
<form action="{{ isset($editReference) ? route('applicant.references.update', $editReference->id) : route('applicant.references.store') }}" method="POST">
    @csrf
    @if(isset($editReference))
        @method('PUT')
    @endif

    <!-- Reference Name Input -->
    <div class="form-group">
        <label for="reference_name">Name:</label>
        <input type="text" name="reference_name" value="{{ $editReference->reference_name ?? '' }}" required>
    </div>

    <!-- Reference Address Input -->
    <div class="form-group">
        <label for="reference_address">Address:</label>
        <input type="text" name="reference_address" value="{{ $editReference->reference_address ?? '' }}" required>
    </div>

    <!-- Reference Telephone Input -->
    <div class="form-group">
        <label for="reference_telephone">Telephone:</label>
        <input type="text" name="reference_telephone" value="{{ $editReference->reference_telephone ?? '' }}" required>
    </div>

    <!-- Submit Button -->
    <div class="form-group">
        <button class="submit-button" type="submit">{{ isset($editReference) ? 'Update' : 'Add' }}</button>
    </div>
</form>

<!-- Table of existing reference entries -->
<table border="1">
    <thead>
        <tr>
            <th>Name</th>
            <th>Address</th>
            <th>Telephone</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pdsReferences as $reference)
            <tr>
                <td>{{ $reference->reference_name }}</td>
                <td>{{ $reference->reference_address }}</td>
                <td>{{ $reference->reference_telephone }}</td>
                <td>
                    <!-- Edit Button -->
                    <a href="{{ route('applicant.references', ['edit' => $reference->id]) }}" class="update-button"><i class="fas fa-edit"></i></a>

                    <!-- Delete Button -->
                    <form action="{{ route('applicant.references.delete', $reference->id) }}" method="POST" style="display:inline;">
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

<!-- Navigation Scripts -->
<script>
    function goBack() {
        // Navigate to the specified back URL
        window.location.href = '/applicant/referencespds'; // Replace with the actual URL
    }
    
    function goNext() {
        // Navigate to the specified next URL
        window.location.href = '/applicant/legal-questionnaire'; // Replace with the actual URL
    }
</script>
