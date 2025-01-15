@include('applicant.topbar')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.1/css/boxicons.min.css">

{{-- <style>
    /* Existing styles for the job card */

    .job-listings {
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .job-card {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        position: relative;
        border-left: 4px solid #4caf50;
        max-width: 800px;
    }

    .job-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #eee;
        padding-bottom: 10px;
        margin-bottom: 15px;
    }

    .job-title,
    .job-description p {
        font-size: 22px;
        font-weight: bold;
        color: #333;
        white-space: nowrap;
        animation: slide 10s linear infinite;
    }

    .job-description p {
        font-size: 14px;
        color: #444;
        border-top: 1px solid #eee;
        padding-top: 15px;
        white-space: nowrap;
        animation: slide 15s linear infinite;
    }

    .title-container {
        overflow: hidden;
        max-width: 100%;
    }

    @media screen and (max-width: 400px) {
        @keyframes slide {
            0% {
                transform: translateX(100%);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        .title-container {
            max-width: 70%;
        }
    }

    .job-type {
        text-align: right;
    }

    .job-badge {
        background-color: #4caf50;
        color: white;
        padding: 5px 10px;
        border-radius: 50px;
        font-size: 12px;
    }

    .job-details {
        display: flex;
        flex-wrap: wrap;
        padding: 15px 0;
    }

    .detail-item {
        width: 50%;
        margin-bottom: 10px;
        font-size: 14px;
        color: #666;
    }

    .detail-item i {
        color: #4caf50;
        margin-right: 8px;
    }

    .apply-section {
        display: flex;
        justify-content: flex-end;
        margin-top: 20px;
    }

    .apply-button {
        background-color: #4caf50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .apply-button:hover {
        background-color: #45a049;
    }

    .apply-button i {
        margin-right: 5px;
    }

    .description-container {
        overflow: hidden;
        max-width: 100%;
    }

    /* New styles for the job application form */

    .application-form {
        margin-top: 20px;
        padding: 20px;
        border-top: 1px solid #eee;
    }

    .application-form input,
    .application-form textarea,
    .application-form select {
        width: 100%;
        padding: 10px;
        margin-top: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 14px;
    }

    .application-form label {
        font-weight: bold;
        color: #333;
    }

    .submit-button {
        background-color: #4caf50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .submit-button:hover {
        background-color: #45a049;
    }
    .job-application-form {
    margin-top: 20px;
}

.job-application-form h3 {
    font-size: 18px;
    color: #4caf50;
    margin-bottom: 10px;
}

.job-application-form .form-group {
    margin-bottom: 15px;
}

.job-application-form label {
    display: block;
    font-size: 14px;
    color: #333;
    margin-bottom: 5px;
}

.job-application-form input[type="text"],
.job-application-form input[type="email"],
.job-application-form input[type="file"] {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    font-size: 14px;
}

.job-application-form input[type="file"] {
    padding: 4px;
}

.job-application-form .apply-button {
    background-color: #4caf50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.job-application-form .apply-button:hover {
    background-color: #45a049;
}

</style> --}}
<style>
    .pds-button-view{
        text-decoration: underline;
        color: #333;
        background: none;
        border: none;
        padding: none;
    }
</style>
<div class="content">

    <div class="job-listings">
        <button class="pds-button" onclick="window.location.href='/applicant/'">
            <i class="fas fa-arrow-left"> Job List
        </button>
         <br>
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
            <div class="descriptio-container">
            <div class="job-description">
                <p>{{ \Illuminate\Support\Str::limit($job->job_description, 150) }}</p>
            </div>
        </div>
        <div class="requirements-container" style="margin-top: 20px;">
            <h3>Other Requirements</h3>
            <!-- Add this button in the applicant.apply view, after the job description -->
            <br>
            <li>
                Complete your Personal Data Sheet
                <div class="job-application-form" style="padding-top: 10px;">
                    <form method="GET" action="{{ route('apply.pdf') }}">
                        @csrf
                        <input type="hidden" name="applicant_id" value="{{ $applicantId }}">
                        <!-- PDF Button -->
                        <div class="form-group">
                            <button type="submit" class="pds-button-view">Your PDS</button>
                        </div>
                    </form>
                </div>
            </li>

            @if ($job->requirements && $job->requirements->isNotEmpty())
                <ul>
                    @foreach ($job->requirements as $requirement)
                        <li>
                            <strong>{{ $requirement->requirement_name }}</strong>
                            @if ($requirement->file_path)
                                <br>
                                <a href="{{ asset($requirement->file_path) }}" target="_blank">View File</a>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No other requirements available in this job.</p>
            @endif
        </div>
        <li>
            <strong>
                
            </strong>
        </li>


        
        <div class="job-application-form" style="border-top: 1px solid #eee; padding-top: 20px;">
            <form method="POST" action="{{ route('job-applications.store') }}">
                @csrf
                <input type="hidden" name="job_listing_id" value="{{ $job->id }}">
                <input type="hidden" name="applicant_id" value="{{ $applicantId }}">
        
                <div class="form-group">
                    <label for="requirements">Job Requirements</label>
                    <ul>
                        @foreach ($requirements as $requirement)
                            <li>{{ $requirement->description }}</li>
                        @endforeach
                    </ul>
                </div>
        
                <div class="form-group" style="text-align: right;">
                    <button type="submit" class="apply-button">Submit Application</button>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>
