<!-- resources/views/job_listings/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Listings</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f7f9fc;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .header {
            width: 100%;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header img {
            height: 40px;
        }

        .search-bar {
            flex: 1;
            margin: 0 20px;
            display: flex;
        }

        .search-bar input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .search-bar input:focus {
            outline: none;
            border-color: #4caf50;
            background-color: #fff;
        }

        .job-listings {
            width: 90%;
            max-width: 1200px;
            margin-top: 20px;
        }

        .job-card {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .job-title {
            font-size: 20px;
            font-weight: bold;
            color: #333;
        }

        .job-details {
            display: flex;
            flex-wrap: wrap;
            margin-top: 10px;
            color: #666;
        }

        .job-details span {
            flex: 1 1 33%;
            margin-bottom: 10px;
        }

        .apply-button {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }

        .apply-button:hover {
            background-color: #45a049;
        }

        @media (max-width: 768px) {
            .job-details span {
                flex: 1 1 100%;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .search-bar {
                margin: 10px 0;
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <div class="header">
        <img src="company-logo.png" alt="Company Logo">
        <div class="search-bar">
            <h1>Welcome, {{ $applicantName }}!</h1>
            <form action="{{ route('applicant.index') }}" method="GET">
                <input type="text" name="search" placeholder="Search jobs..." value="{{ request('search') }}">
                <button type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
    </div>
    

    <div class="job-listings">
        @foreach ($jobListings as $job)
            <div class="job-card">
                <div class="job-title">{{ $job->job_title }}</div>
                <div class="job-details">
                    <span>Department: {{ $job->department }}</span>
                    <span>Job Type: {{ $job->job_type }}</span>
                    <span>Salary Range: {{ $job->salary_range }}</span>
                    <span>Experience Level: {{ $job->experience_level }}</span>
                    <span>Education Requirement: {{ $job->education_requirement }}</span>
                    <span>Application Deadline: {{ $job->application_deadline->format('jS F Y') }}</span>
                    <span>Posted Date: {{ $job->posted_date->format('jS F Y') }}</span>
                </div>
                <div class="job-description">
                    <p>{{ \Illuminate\Support\Str::limit($job->job_description, 150) }}</p>
                </div>
                <button class="apply-button" data-job-id="{{ $job->id }}">Apply Now</button>
                        </div>
        @endforeach
    </div>
    <a href="">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
              <button type="submit" style="background: none; border: none; cursor: pointer; width: 100%;">
                <i class='bx bx-log-out'></i>
                <span class="link_name">Logout</span>
              </button>               
        </form>
      </a>
   <!-- Include the JavaScript file -->
   <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Set the authenticated status from server-side
        var isAuthenticated = @json(auth()->check());
        
        // Event delegation for apply buttons
        document.querySelectorAll('.apply-button').forEach(function (button) {
            button.addEventListener('click', function () {
                if (!isAuthenticated) {
                    // Redirect to login page if not authenticated
                    window.location.href = '/applicant/login';
                } else {
                    // If authenticated, handle the apply action here
                    var jobId = button.getAttribute('data-job-id');
                    window.location.href = '/apply/' + jobId; // Adjust the URL as needed
                }
            });
        });
    });
</script>
</body>
</html>
