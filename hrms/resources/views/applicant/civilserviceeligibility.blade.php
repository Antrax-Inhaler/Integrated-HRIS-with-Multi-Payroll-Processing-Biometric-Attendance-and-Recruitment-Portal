@include('applicant.psdtopbar');
<style>
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
</style>

<h2>Civil Service Eligibility</h2>
<!-- Form for creating or editing civil service eligibility -->

<!-- List of civil service eligibilities -->
<h3>Your Civil Service Eligibilities</h3>
@if($civilServices->isNotEmpty())
    <div class="card-container">
        @foreach($civilServices as $civilServiceItem)
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-briefcase"></i>
                    <strong>{{ $civilServiceItem->career_service }}</strong>
                </div>
                <div class="card-body">
                    <p><i class="fas fa-star"></i> Rating: {{ $civilServiceItem->rating ?? 'N/A' }}</p>
                    <p><i class="fas fa-calendar-alt"></i> Date of Examination: {{ $civilServiceItem->date_of_examination }}</p>
                    <p><i class="fas fa-map-marker-alt"></i> Place of Examination: {{ $civilServiceItem->place_of_examination }}</p>
                    <p><i class="fas fa-id-card"></i> License Number: {{ $civilServiceItem->license_number ?? 'N/A' }}</p>
                    <p><i class="fas fa-calendar-check"></i> License Validity: {{ $civilServiceItem->license_validity ?? 'N/A' }}</p>
                </div>
                <div class="card-footer">
                    <div class="">

                    <a href="{{ route('civilserviceeligibility.index', ['id' => $civilServiceItem->id]) }}" class="update-button">
                        <i class="fas fa-edit"></i> 
                    </a>
                    <form action="{{ route('civilserviceeligibility.destroy', $civilServiceItem->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-button" title="Delete Child">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
            </div>
        @endforeach
    </div>
@else
    <p>No civil service eligibilities found.</p>
@endif
<h3>{{ isset($civilService) ? 'Edit' : 'Add New' }} Civil Service Eligibility</h3>
<form action="{{ route('civilserviceeligibility.save') }}" method="POST">
    @csrf
    @if(isset($civilService))
        <input type="hidden" name="id" value="{{ $civilService->id }}">
    @endif

    <div class="form-group">
        <label>Career Service:</label>
        <input type="text" name="career_service" value="{{ $civilService->career_service ?? '' }}" required>
    </div>

    <div class="form-group">
        <label>Rating:</label>
        <input type="text" name="rating" value="{{ $civilService->rating ?? '' }}">
    </div>

    <div class="form-group">
        <label>Date of Examination:</label>
        <input type="date" name="date_of_examination" value="{{ $civilService->date_of_examination ?? '' }}" required>
    </div>

    <div class="form-group">
        <label>Place of Examination:</label>
        <input type="text" name="place_of_examination" value="{{ $civilService->place_of_examination ?? '' }}" required>
    </div>

    <div class="form-group">
        <label>License Number:</label>
        <input type="text" name="license_number" value="{{ $civilService->license_number ?? '' }}">
    </div>

    <div class="form-group">
        <label>License Validity:</label>
        <input type="date" name="license_validity" value="{{ $civilService->license_validity ?? '' }}">
    </div>

    <button class="submit-button" type="submit">{{ isset($civilService) ? 'Update' : 'Save' }}</button>
</form>

<div class="navigation-buttons">
    <button id="back-button" class="nav-button" onclick="goBack()">Back</button>
    <button id="next-button" class="nav-button" onclick="goNext()">Next</button>
</div>
</div>
</body>
<script>
    function goBack() {
        window.location.href = '/applicant/educational-background';
    }
    
    function goNext() {
        window.location.href = '/applicant/work-experience';
    }
</script>
