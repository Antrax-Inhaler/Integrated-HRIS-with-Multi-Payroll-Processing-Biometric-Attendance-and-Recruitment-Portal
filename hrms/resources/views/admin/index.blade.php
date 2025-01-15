@include('admin.sidenav')

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<style>
    .home-section {
        width: calc(100% - 58px);
        padding: 20px;
        overflow: auto;
        box-sizing: border-box;
        color: var(--text-color);

    }

    h1, h2 {
        text-align: center;
        margin-bottom: 20px;
        color: var(--text-color);
    }

    /* Info Boxes Row */
    .info-box {
        display: flex;
        align-items: center;
        background-color: var(--sidebar-bg-color);
        padding: 15px;
        margin: 10px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        transition: transform 0.2s;
        border-left: 5px solid;
    }

    .info-box:hover {
        transform: scale(1.05);
    }

    /* Border colors based on content type */
    .pending-applications { border-left-color: #ff9800; }
    .attendees-today { border-left-color: #4caf50; }
    .on-leave-today { border-left-color: #2196f3; }
    .on-travel-today { border-left-color: #f44336; }
    .not-verified { border-left-color: #9c27b0; }
    .verified-employees { border-left-color: #673ab7; }

    .info-content h4, .info-content span {
        margin: 0;
        color: var(--text-color);
        }

    .cards-container {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        justify-content: space-between;
    }

    /* Employee Card */
    .employee-card {
        display: flex;
        align-items: center;
        background-color: var(--sidebar-bg-color);
        border-radius: 8px;
        padding: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        width: calc(50% - 10px);
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .employee-card:hover {
        background-color: #f0f0f0;
    }

    .employee-card img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-right: 15px;
    }

    .employee-info {
        font-size: 16px;
        color: #333;
    }

    /* Chart container */
    .chart-container {
        margin: 20px 0;
        background-color: #fff;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    /* Responsive Styling */
    @media (max-width: 768px) {
        .employee-card {
            width: 100%;
        }
    }
    .dashboard-container {
        display: flex;
        gap: 20px;
    }

    /* Left Column */
    .left-column,
    .middle-column,
    .right-column {
        flex: 1;
    }
    .left-column {
        flex-basis: 10%;
    }

    .middle-column {
        flex-basis: 80%;
    }

    .right-column {
        flex-basis: 30%;
    }
    .left-column .chart-container,
    .middle-column .chart-container,
    .right-column .chart-container {
        margin-bottom: 20px;
        background-color: #fff;
        padding: 15px;
        border-radius: 8px;
    }

    .left-column .chart-container {
        max-height: calc(50vh - 20px); /* Each chart takes half the column height */
    }

    .middle-column .chart-container {
        max-height: 100vh; /* Double the height of left-column charts */
    }
    .middle-column  {
        max-height: 100vh; /* Double the height of left-column charts */
        width: 700px;
    }


    .right-column {
        display: flex;
        flex-direction: column;
        height: 100vh;
    }

    /* Employee Card Section */
    .employee-card-container {
        display: flex;
        flex-direction: column;
        overflow-y: auto;
        max-height: calc(100vh - 60px); /* Adjust for title space */
        padding: 10px;
        border-radius: 8px;
        background-color: var(--sidebar-bg-color);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .employee-card {
        display: flex;
        align-items: center;
        background-color: white;
        border-radius: 8px;
        padding: 10px;
        margin-bottom: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .employee-card img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-right: 15px;
    }

    .employee-info {
        font-size: 16px;
        color: #333;
    }
    .chart-container {
    max-width: 1000px;
    background-color: var(--sidebar-bg-color) !important;
    color: var(--text-color) !important;


}
.chart-container h4{
    color: var(--text-color);

}
.canvas{
    background-color: var(--sidebar-bg-color);

}
#icon-container {
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
    justify-content: space-around;
    padding: 20px;
}

.icon-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    width: 100px;
}

</style>

<section class="home-section">
    <h1>Admin Dashboard</h1>
    <div id="icon-container">
        <div class="icon-item">
            <lord-icon src="https://cdn.lordicon.com/kbtmbyzy.json" trigger="hover" colors="primary:#121331,secondary:#08a88a" style="width:50px;height:50px"></lord-icon>
            <p>Applicants</p>
        </div>
        <div class="icon-item">
            <lord-icon src="https://cdn.lordicon.com/abmtfwas.json" trigger="hover" colors="primary:#121331,secondary:#08a88a" style="width:50px;height:50px"></lord-icon>
            <p>Attendance</p>
        </div>
        <div class="icon-item">
            <lord-icon src="https://cdn.lordicon.com/slkvcfos.json" trigger="hover" colors="primary:#121331,secondary:#08a88a" style="width:50px;height:50px"></lord-icon>
            <p>Bonuses</p>
        </div>
        <div class="icon-item">
            <lord-icon src="https://cdn.lordicon.com/nocovwne.json" trigger="hover" colors="primary:#121331,secondary:#08a88a" style="width:50px;height:50px"></lord-icon>
            <p>Deductions</p>
        </div>
        <div class="icon-item">
            <lord-icon src="https://cdn.lordicon.com/gqzfzudq.json" trigger="hover" colors="primary:#121331,secondary:#08a88a" style="width:50px;height:50px"></lord-icon>
            <p>Departments</p>
        </div>
        <div class="icon-item">
            <lord-icon src="https://cdn.lordicon.com/mvllimqc.json" trigger="hover" colors="primary:#121331,secondary:#08a88a" style="width:50px;height:50px"></lord-icon>
            <p>General Settings</p>
        </div>
        <div class="icon-item">
            <lord-icon src="https://cdn.lordicon.com/pnhskdva.json" trigger="hover" colors="primary:#121331,secondary:#08a88a" style="width:50px;height:50px"></lord-icon>
            <p>Holidays</p>
        </div>
        <div class="icon-item">
            <lord-icon src="https://cdn.lordicon.com/ogkwwxmv.json" trigger="hover" colors="primary:#121331,secondary:#08a88a" style="width:50px;height:50px"></lord-icon>
            <p>Job Applications</p>
        </div>
        <div class="icon-item">
            <lord-icon src="https://cdn.lordicon.com/xhdhjyqy.json" trigger="hover" colors="primary:#121331,secondary:#08a88a" style="width:50px;height:50px"></lord-icon>
            <p>Job Listings</p>
        </div>
        <div class="icon-item">
            <lord-icon src="https://cdn.lordicon.com/rhvddzym.json" trigger="hover" colors="primary:#121331,secondary:#08a88a" style="width:50px;height:50px"></lord-icon>
            <p>Late Deductions</p>
        </div>
        <div class="icon-item">
            <lord-icon src="https://cdn.lordicon.com/qhgmphtg.json" trigger="hover" colors="primary:#121331,secondary:#08a88a" style="width:50px;height:50px"></lord-icon>
            <p>Learning & Development</p>
        </div>
        <div class="icon-item">
            <lord-icon src="https://cdn.lordicon.com/mecwbjnp.json" trigger="hover" colors="primary:#121331,secondary:#08a88a" style="width:50px;height:50px"></lord-icon>
            <p>Leaves</p>
        </div>
        <div class="icon-item">
            <lord-icon src="https://cdn.lordicon.com/tvukztwl.json" trigger="hover" colors="primary:#121331,secondary:#08a88a" style="width:50px;height:50px"></lord-icon>
            <p>Legal Questionnaire</p>
        </div>
        <div class="icon-item">
            <lord-icon src="https://cdn.lordicon.com/uukerzzv.json" trigger="hover" colors="primary:#121331,secondary:#08a88a" style="width:50px;height:50px"></lord-icon>
            <p>Member</p>
        </div>
        <div class="icon-item">
            <lord-icon src="https://cdn.lordicon.com/txuqymsk.json" trigger="hover" colors="primary:#121331,secondary:#08a88a" style="width:50px;height:50px"></lord-icon>
            <p>Admin</p>
        </div>
        <div class="icon-item">
            <lord-icon src="https://cdn.lordicon.com/zpxybbhl.json" trigger="hover" colors="primary:#121331,secondary:#08a88a" style="width:50px;height:50px"></lord-icon>
            <p>Travel</p>
        </div>
    </div>
    
    <div class="cards-container">
        <div class="info-box pending-applications" onclick="window.location.href='/admin/job-applications'">
            <lord-icon src="https://cdn.lordicon.com/bwnhdkha.json" trigger="loop" colors="primary:#ff9800" style="width:50px;height:50px"></lord-icon>
            <div class="info-content">
                <h4>Pending Job Applications</h4>
                <span>{{ $pendingJobApplicationsCount }}</span>
            </div>
        </div>

        <div class="info-box attendees-today" onclick="window.location.href='/admin/attendance'">
            <lord-icon src="https://cdn.lordicon.com/rhvddzym.json" trigger="loop" colors="primary:#4caf50" style="width:50px;height:50px"></lord-icon>
            <div class="info-content">
                <h4>Number of Attendees Today</h4>
                <span>{{ $attendeesToday }}</span>
            </div>
        </div>

        <div class="info-box on-leave-today" onclick="window.location.href='/admin/leaves'">
            <lord-icon src="https://cdn.lordicon.com/wloilxuq.json" trigger="loop" colors="primary:#2196f3" style="width:50px;height:50px"></lord-icon>
            <div class="info-content">
                <h4>Employees on Leave Today</h4>
                <span>{{ $onLeaveToday }}</span>
            </div>
        </div>

        <div class="info-box on-travel-today" onclick="window.location.href='/admin/members'">
            <lord-icon src="https://cdn.lordicon.com/dnoiydox.json" trigger="loop" colors="primary:#f44336" style="width:50px;height:50px"></lord-icon>
            <div class="info-content">
                <h4>Employees on Travel Today</h4>
                <span>{{ $onTravelToday }}</span>
            </div>
        </div>
        

        <div class="info-box not-verified" onclick="window.location.href='/admin/verify-member'">
            <lord-icon src="https://cdn.lordicon.com/mecwbjnp.json" trigger="loop" colors="primary:#9c27b0" style="width:50px;height:50px"></lord-icon>
            <div class="info-content">
                <h4>Employees Requests (Not Verified)</h4>
                <span>{{ $notVerifiedCount }}</span>
            </div>
        </div>

        <div class="info-box verified-employees" onclick="window.location.href='/admin/members'">
            <lord-icon src="https://cdn.lordicon.com/gmzxduhd.json" trigger="loop" colors="primary:#673ab7" style="width:50px;height:50px"></lord-icon>
            <div class="info-content">
                <h4>Total Verified Employees</h4>
                <span>{{ $verifiedCount }}</span>
            </div>
        </div>
    </div>

    <div class="dashboard-container">
        <!-- Left Column -->
        <div class="left-column">
            <div class="chart-container">
                <h4>Job Application Status Breakdown</h4>
                <canvas id="jobApplicationChart"></canvas>
            </div>
            <div class="chart-container">
                <h4>Current Leave and Travel Status</h4>
                <canvas id="leaveTravelChart"></canvas>
            </div>
        </div>

        <!-- Middle Column -->
        <div class="middle-column">
            <div class="chart-container">
                <h4>Attendance Over the Last 7 Days</h4>
                <canvas id="attendanceChart"></canvas>
            </div>
        </div>

        <!-- Right Column -->
        <div class="right-column">
            <h4>Employees Currently Logged In</h4>
            <div class="employee-card-container">
                @if ($loggedInEmployees->isEmpty())
                    <p>No employees are currently logged in.</p>
                @else
                    @foreach ($loggedInEmployees as $employee)
                        <div class="employee-card">
                            <img src="{{ $employee->profile_image }}" alt="Employee Image">
                            <div class="employee-info">
                                {{ $employee->surname }}, {{ $employee->given_name }} {{ $employee->middle_name }}
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Attendance Chart Logic
    const dates = @json($dates);
    const attendanceCounts = @json($attendanceCounts);
    new Chart(document.getElementById('attendanceChart'), {
        type: 'line',
        data: {
            labels: dates,
            datasets: [{ 
                label: 'Attendees',
                data: attendanceCounts,
                borderColor: '#4CAF50',
                backgroundColor: 'rgba(76, 175, 80, 0.2)',
                fill: true
            }]
        }
    });

    // Job Application Donut Chart Logic
    new Chart(document.getElementById('jobApplicationChart'), {
        type: 'doughnut',
        data: {
            labels: {!! json_encode(array_keys($jobApplicationData)) !!},
            datasets: [{ 
                data: {!! json_encode(array_values($jobApplicationData)) !!},
                backgroundColor: ['#36A2EB', '#FFCE56', '#FF6384', '#4BC0C0']
            }]
        }
    });

    // Leave and Travel Chart Logic
    new Chart(document.getElementById('leaveTravelChart'), {
        type: 'bar',
        data: {
            labels: ['Status'],
            datasets: [
                { label: 'On Leave', data: [{{ $leaveTravelData['Leave'] }}], backgroundColor: '#36A2EB' },
                { label: 'On Travel', data: [{{ $leaveTravelData['Travel'] }}], backgroundColor: '#FF6384' }
            ]
        }
    });
</script>
<script src="https://cdn.lordicon.com/lordicon.js"></script>
