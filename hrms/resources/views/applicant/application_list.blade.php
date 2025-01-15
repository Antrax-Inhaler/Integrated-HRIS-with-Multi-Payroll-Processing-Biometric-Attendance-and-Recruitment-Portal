@include('applicant.topbar')

<div class="content">
    <div class="job-listings">
        <button class="pds-button" onclick="window.location.href='/applicant/'">
            <i class="fas fa-arrow-left"> Job List
        </button>
    <h2>Your Job Applications</h2>

    <style>
        .content {
            padding-top: 50px;
        }
    
        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    
        thead tr {
            background-color: #4caf50;
            color: white;
            text-align: left;
        }
    
        th, td {
            padding: 12px 15px;
        }
    
        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    
        tbody tr:nth-child(odd) {
            background-color: #e9f7ea;
        }
    
        tbody td {
            border-bottom: 1px solid #ddd;
        }
    
        td:last-child {
            text-align: center;
        }
    
        button {
            background-color: #f44336;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 4px;
        }
    
        button:hover {
            background-color: #d32f2f;
        }
    
        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
            color: white;
        }
    
        .status-pending {
            background-color: #ff9800;
        }
    
        .status-interview {
            background-color: #03a9f4;
        }
    
        .status-offered {
            background-color: #4caf50;
        }
    
        .status-rejected {
            background-color: #f44336;
        }
    
        h2 {
            color: #388e3c;
            margin-bottom: 10px;
        }
    
        /* Responsive design for card view on small screens */
        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
                width: 100%;
            }
    
            thead {
                display: none;
            }
    
            tbody tr {
                margin-bottom: 15px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                border-radius: 8px;
                padding: 15px;
                background-color: #fff;
            }
    
            td {
                display: flex;
                justify-content: space-between;
                padding: 10px 0;
                border-bottom: 1px solid #ddd;
            }
    
            td:before {
                content: attr(data-label);
                font-weight: bold;
                color: #333;
                width: 50%;
                text-align: left;
                flex: 1;
            }
    
            td:last-child {
                border-bottom: none;
            }
        }
    </style>


        <table>
            <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Status</th>
                    <th>Date Applied</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($applications as $application)
                    <tr>
                        <td>{{ $application->jobListing->job_title }}</td>
                        <td>
                            <span class="status status-{{ strtolower($application->status) }}">
                                {{ $application->status }}
                            </span>
                        </td>
                        <td>{{ $application->created_at->format('m/d/Y') }}</td>
                        <td>
                            @if ($application->status === 'Pending')
                                <form method="POST" action="{{ route('job-applications.cancel', $application->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit">Cancel</button>
                                </form>
                            @else
                                <!-- View Button -->
                                <button 
                                    type="button" 
                                    class="btn btn-info" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#applicationModal{{ $application->id }}">
                                    View
                                </button>
                            @endif
                        </td>
                    </tr>
                    
                    <!-- Modal for Viewing Application Details -->
                    <div class="modal fade" id="applicationModal{{ $application->id }}" tabindex="-1" aria-labelledby="applicationModalLabel{{ $application->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="applicationModalLabel{{ $application->id }}">Application Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Job Title:</strong> {{ $application->jobListing->job_title }}</p>
                                    <p><strong>Status:</strong> {{ $application->status }}</p>
                                    <p><strong>Date Applied:</strong> {{ $application->created_at->format('m/d/Y') }}</p>
                                    <p><strong>Comments:</strong></p>
                                    <p>{{ $application->comment ?? 'No comments available.' }}</p>
                                    
                                    @if ($application->status === 'Interview')
                                        <p><strong>Interview Date:</strong> {{ $application->interview_date ? $application->interview_date->format('m/d/Y H:i') : 'To be scheduled' }}</p>
                                        <p><strong>Interview Location:</strong> {{ $application->interview_location ?? 'Not provided' }}</p>
                                        <p><strong>Interviewer Name:</strong> {{ $application->interviewer_name ?? 'Not assigned yet' }}</p>
                                    @endif
                                    
                                    @if ($application->status === 'Rejected')
                                        <p><strong>Rejection Reason:</strong> {{ $application->rejection_reason ?? 'No reason provided.' }}</p>
                                    @endif
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="4">No job applications found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>


<!-- Include Bootstrap CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <br>
    <br>
    <hr>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <h2>Jobs You Might Be Interested In</h2>

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
