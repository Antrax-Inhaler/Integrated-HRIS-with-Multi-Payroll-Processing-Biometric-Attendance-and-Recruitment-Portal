@include('member.sidenav')
<style>
  .home-section {
      width: calc(100% - 58px);
      padding: 20px;
      overflow: auto;
      box-sizing: border-box;
  }

  h1, h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
  }

  /* Info Boxes Row */
  .info-box {
      display: flex;
      align-items: center;
      background-color: #ffffff;
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
      background-color: white;
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
      width: 100%;
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
      flex-basis: 60%;
  }

  .middle-column {
      flex-basis: 40%;
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
      max-width: 100%; /* Each chart takes half the column height */

  }

  .middle-column .chart-container {
      max-height: 100vh; /* Double the height of left-column charts */
  }
  .middle-column  {
      max-height: 100vh; /* Double the height of left-column charts */
      max-width: 700px;
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
      background-color: #fff;
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
  #hoursWorkedChart{
    width: 100% !important;

  }
  
  canvas {
      width: 100% !important;
      height: 100% !important;
  }
</style>
<section class="home-section">
    <h1>Member Dashboard</h1>
    <div class="cards-container">
      <!-- Vacation Leave -->
      <div class="info-box pending-applications">
          <lord-icon src="https://cdn.lordicon.com/wloilxuq.json" trigger="loop" colors="primary:#ff9800" style="width:50px;height:50px"></lord-icon>
          <div class="info-content">
              <h4>Vacation Leave Balance</h4>
              <span>12 days</span>
          </div>
      </div>
  
      <!-- Sick Leave -->
      <div class="info-box attendees-today">
          <lord-icon src="https://cdn.lordicon.com/rhvddzym.json" trigger="loop" colors="primary:#4caf50" style="width:50px;height:50px"></lord-icon>
          <div class="info-content">
              <h4>Sick Leave Balance</h4>
              <span>8 days</span>
          </div>
      </div>
  
      <!-- Total Hours Worked -->
      <div class="info-box on-leave-today">
          <lord-icon src="https://cdn.lordicon.com/dnoiydox.json" trigger="loop" colors="primary:#2196f3" style="width:50px;height:50px"></lord-icon>
          <div class="info-content">
              <h4>Total Hours Worked</h4>
              <span>180 hours</span>
          </div>
      </div>
  
      <!-- Overtime Hours -->
      <div class="info-box overtime-hours">
          <lord-icon src="https://cdn.lordicon.com/nocovwne.json" trigger="loop" colors="primary:#ff5722" style="width:50px;height:50px"></lord-icon>
          <div class="info-content">
              <h4>Overtime Hours</h4>
              <span>20 hours</span>
          </div>
      </div>
  
      <!-- Pending Requests -->
      <div class="info-box pending-requests">
          <lord-icon src="https://cdn.lordicon.com/hjbsbdhw.json" trigger="loop" colors="primary:#795548" style="width:50px;height:50px"></lord-icon>
          <div class="info-content">
              <h4>Pending Requests</h4>
              <span>5 requests</span>
          </div>
      </div>
  
      <!-- Approvals This Month -->
      <div class="info-box approvals-this-month">
          <lord-icon src="https://cdn.lordicon.com/qhgmphtg.json" trigger="loop" colors="primary:#3f51b5" style="width:50px;height:50px"></lord-icon>
          <div class="info-content">
              <h4>Approvals This Month</h4>
              <span>15 approvals</span>
          </div>
      </div>
  
      <!-- Upcoming Trainings -->
      <div class="info-box upcoming-trainings">
          <lord-icon src="https://cdn.lordicon.com/uutnmngi.json" trigger="loop" colors="primary:#00bcd4" style="width:50px;height:50px"></lord-icon>
          <div class="info-content">
              <h4>Upcoming Trainings</h4>
              <span>3 sessions</span>
          </div>
      </div>
  
      <!-- Projects Completed -->
      <div class="info-box projects-completed">
          <lord-icon src="https://cdn.lordicon.com/nocovwne.json" trigger="loop" colors="primary:#ff9800" style="width:50px;height:50px"></lord-icon>
          <div class="info-content">
              <h4>Projects Completed</h4>
              <span>10 projects</span>
          </div>
      </div>
  </div>
  

    <div class="dashboard-container">
        <!-- Left Column -->
        <div class="left-column">
          <div class="chart-container">
            <h4>Hours Worked Over Time</h4>
            <canvas id="hoursWorkedChart"></canvas>
        </div>
        </div>

        <!-- Middle Column -->
        <div class="middle-column">

            <div class="chart-container">
              <h4>Leave Usage Breakdown</h4>
              <canvas id="leaveUsageChart"></canvas>
          </div>
          <div class="chart-container">
              <h4>Monthly Sick Leave Usage</h4>
              <canvas id="sickLeaveChart"></canvas>
          </div>
        </div>
    </div>
</section>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Leave Usage Breakdown - Static Data
    new Chart(document.getElementById('leaveUsageChart'), {
        type: 'doughnut',
        data: {
            labels: ['Vacation Leave', 'Sick Leave'],
            datasets: [{
                data: [12, 8],
                backgroundColor: ['#36A2EB', '#FF6384']
            }]
        }
    });

    // Monthly Sick Leave Usage - Static Data
    new Chart(document.getElementById('sickLeaveChart'), {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [{
                label: 'Sick Leave Days',
                data: [1, 2, 0, 1, 3, 0, 2, 1, 2, 0, 1, 0],
                borderColor: '#FF6384',
                fill: true
            }]
        }
    });

    // Hours Worked Over Time - Static Data
    new Chart(document.getElementById('hoursWorkedChart'), {
        type: 'bar',
        data: {
            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5'],
            datasets: [{
                label: 'Hours Worked',
                data: [40, 35, 42, 38, 25],
                backgroundColor: '#4CAF50'
            }]
        }
    });
</script>
<script src="https://cdn.lordicon.com/lordicon.js"></script>
{{-- <section class="home-section" style="width: calc(100% - 58px);">
    <div class="home-content">
      <h3>Welcome, {{ $member->given_name }} {{ $member->surname }}</h3>

      <p><strong>Vacation Leave:</strong> {{ $member->balance_vacation }} days</p>
      <p><strong>Sick Leave:</strong> {{ $member->balance_sick }} days</p>
      <p><strong>Total Hours Worked:</strong> {{ $totalHours }} hours</p>
</body> --}}