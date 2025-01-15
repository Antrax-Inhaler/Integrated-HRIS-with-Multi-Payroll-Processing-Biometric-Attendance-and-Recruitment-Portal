@include('applicant.topbar')
<style>
        input, select {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        box-sizing: border-box;
    }
    /* Focus style */
input:focus,
select:focus {
    outline: none;
    border-color: #4caf50; /* Green border on focus */
    background-color: #fff; /* White background on focus */
}

/* Hover style */
input:hover,
select:hover {
    border-color: #4caf50; /* Green border on hover */
    background-color: #e9f5e9; /* Light green background on hover */
}
input,
select {
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px; /* Rounded edges */
    background-color: #f9f9f9;
    transition: border-color 0.3s, background-color 0.3s; /* Smooth transition */
}
.search-filter-container {
    width: 500px;
    padding: 10px 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 60px;
    gap: 20px;
    background: #9cffa0;
    border-radius: 10px;
}
.search-form{
    display: flex;
    justify-content: flex-start;
    gap: 10px;
}
.search-button, .refresh-button {
    padding: 8px 12px;
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    max-width: 117px;
}


.search-button:hover, .refresh-button:hover {
    background-color: #218838;
}
.centerer{
    display: flex;
    justify-content: space-around;
    position: fixed;
    top: 60px;
    left: 0;
    z-index: 99;
    width: 100%
}

</style>

<div class="centerer">
    <div></div>
    <div class="search-filter-container">
        <!-- Search Form -->
        <form action="{{ route('applicant.index') }}" method="GET" class="search-form">
            <input 
                type="text" 
                name="search" 
                class="search-input" 
                placeholder="Search for jobs..." 
                value="{{ request('search') }}"
            >
            <button type="submit" class="search-button">
                <i class="bx bx-search"></i> 
            </button>
        </form>
    
        <!-- Filter Form -->
        <form action="{{ route('applicant.index') }}" method="GET" class="filter-form">
            <select name="job_type" class="filter-select" onchange="this.form.submit()">
                <option value="">Filter by Job Type</option>
                <option value="Full-time" {{ request('job_type') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                <option value="Part-time" {{ request('job_type') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                <option value="Contract" {{ request('job_type') == 'Contract' ? 'selected' : '' }}>Contract</option>
            </select>
        </form>
    
        <!-- Refresh Button -->
        <button class="refresh-button" onclick="window.location.href='{{ route('applicant.index') }}'">
            <i class="bx bx-refresh"></i> 
        </button>
    </div>
</div>

<div class="content">
    
    <div class="job-listings">
        @foreach ($jobListings as $job)
        <div class="job-card">
            <div class="job-card-header">
                <div class="title-container">
                    <div class="job-title">
                        <i class="bx bxs-briefcase"></i> {{ $job->job_title }}
                    </div>
                </div>
                <div class="job-type">
                    <span class="job-badge">{{ $job->job_type }}</span>
                </div>
            </div>

            <div class="job-details">
                <div class="detail-item">
                    <i class="bx bxs-building-house"></i>
                    <span>Department: </span>{{ $job->department }}
                </div>
                <div class="detail-item">
                    <i class="bx bxs-dollar-circle"></i>
                    <span>Salary Range: </span>{{ $job->salary_range }}
                </div>
                <div class="detail-item">
                    <i class="bx bxs-graduation"></i>
                    <span>Education Requirement: </span>{{ $job->education_requirement }}
                </div>
                <div class="detail-item">
                    <i class="bx bx-calendar-event"></i>
                    <span>Deadline: </span>{{ $job->application_deadline->format('jS F Y') }}
                </div>
                <div class="detail-item">
                    <i class="bx bx-calendar-check"></i>
                    <span>Posted: </span>{{ $job->posted_date->format('jS F Y') }}
                </div>
            </div>

            <div class="description-container">
                <p>{{ \Illuminate\Support\Str::limit($job->job_description, 150) }}</p>
            </div>

            <div class="apply-section">
                <button class="apply-button" data-job-id="{{ $job->id }}">
                    <i class="bx bxs-paper-plane"></i> Apply Now
                </button>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var isAuthenticated = @json(auth()->check());

        document.querySelectorAll('.apply-button').forEach(function (button) {
            button.addEventListener('click', function () {
                if (!isAuthenticated) {
                    window.location.href = '/applicant/login';
                } else {
                    var jobId = button.getAttribute('data-job-id');
                    window.location.href = '/apply/' + jobId;
                }
            });
        });
    });
</script>
