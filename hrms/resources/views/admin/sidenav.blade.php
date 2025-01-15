<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="icon" href="/img/dalogo.png" type="icon">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
     integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
     crossorigin="anonymous"
     referrerpolicy="no-referrer"
   />   
   <link id="google-font-link" rel="stylesheet" href="">

   <!-- chart -->
   <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;700&display=swap"
      rel="stylesheet"
    />
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
<body>
  @if (session('success'))
  <div class="alert success-alert">
      {{ session('success') }}
  </div>
@endif

@if ($errors->any())
  <div class="alert error-alert">
      @foreach ($errors->all() as $error)
          {{ $error }}
      @endforeach
  </div>
@endif
<style>
  .badge {
    position: absolute;
    top: -5px;
    right: -5px;
    background-color: red;
    color: white;
    border-radius: 50%;
    padding: 2px 6px;
    font-size: 12px;
}
.notification-container {
    position: relative;
}
.notification-dropdown {
    display: none;
    position: absolute;
    right: 0;
    top: 30px;
    background-color: white;
    border: 1px solid #ddd;
    border-radius: 4px;
    width: 300px;
    max-height: 400px;
    overflow-y: auto;
    overflow-x: hidden; /* Prevent horizontal scrolling */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    z-index: 1000;
}

.notification-list {
    list-style: none;
    padding: 0;
    margin: 0;
    width: 100%;
}

.notification-item {
    padding: 10px;
    border-bottom: 1px solid #f0f0f0;
    justify-content: space-between;
    align-items: center;
    cursor: pointer;
    width: 100%;
    height: 80px;
}
.notification-item.read {
    background-color: #f9f9f9;
    font-weight: normal;
    color: #aaa;
}
.notification-item.unread {
    font-weight: bold;
    color: #333;
}

</style>
<header class="topbar">
  <div class="topbar-content">
      <div class="topbar-left">
          <!-- Any other content you have in the left section -->
      </div>
      <div class="topbar-right">
          <i class='bx bx-search'></i>
          <div class="notification-container">
            <i class='bx bx-bell' id="notificationBell" onclick="toggleDropdown()"></i>
            <span id="notificationBadge" class="badge">0</span>
            
            <!-- Dropdown content for notifications -->
            <div class="notification-dropdown" id="notificationDropdown">
                <ul id="notificationList" class="notification-list">
                    <!-- Notifications will be populated here by JavaScript -->

                </ul>
            </div>
        </div>
    
          <!-- Display Profile Picture of the Logged-in User -->
          @php
              $profilePicture = auth()->user() && auth()->user()->profile_picture
                  ? asset('storage/' . auth()->user()->profile_picture)
                  : asset('storage/profile_pictures/3135715.png'); // Use a default profile picture if none exists
          @endphp

          <!-- Make the Profile Picture Clickable -->
          <a href="{{ route('admin.profile') }}">
              <img src="{{ $profilePicture }}" alt="Profile Picture" class="topbar-profile-picture" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
          </a>
      </div>
  </div>
</header>

  <style>
 body {
        background-color: var(--background-color);
    }
.sidebar{
  background-color: var(--sidebar-bg-color);
}
.link_name{
  color: var(--text-color) !;
}
</style>
  <style>
  /* General Styles for Topbar */
  .topbar {
top: 0;
left: 0;
width: 100%; /* Adjust width if needed */
height: 60px; /* Adjust height if needed */
background-color: var(--topbar-bg-color); /* White background */
box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Light shadow */
z-index: 100; /* Same z-index as the sidebar */
display: flex;
align-items: center;
padding: 0 20px;
transition: all 0.2s ease;
}
.topbar-profile-picture {
  width: 30px; /* Adjust width */
  height: 30px;
    border-radius: 50%;
    object-fit: cover;
    cursor: pointer;
    transition: opacity 0.3s;
}

.topbar-profile-picture:hover {
    opacity: 0.8;
}


/* Content within the Topbar */
.topbar-content {
  display: flex;
  justify-content: space-between;
  width: 100%;
}

/* Left Side of Topbar */
.topbar-left {
  display: flex;
  align-items: center;
}

.topbar-left .logo_name {
  font-size: 18px;
  font-weight: 700;
  color: #333; /* Dark text color */
  margin-left: 10px;
}

#menu-toggle {
  font-size: 24px;
  cursor: pointer;
}

/* Right Side of Topbar */
.topbar-right {
  display: flex;
  align-items: center;
}

.topbar-right i {
  font-size: 24px;
  margin-left: 20px;
  cursor: pointer;
  color: #333; /* Dark icon color */
}

/* Adjust styles for responsiveness if needed */
@media (max-width: 768px) {
  .topbar {
    width: 100%;
  }
}

  </style>
     <style>
      /* Hidden card */
      .payroll-card {
          display: none;
          border-left: 8px solid var(--main-color);
          border-radius: 15px;
          box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
          padding: 20px;
          width: 400px;
          background-color: #fff;
          margin-top: 20px;
      }
  
      /* Button container */
      .payroll-button-container {
          position: relative;
      }
  
      /* Round button with Lordicon */
      .payroll-round-button {
          background-color: var(--text-color);
          border: none;
          border-radius: 50%;
          width: 60px;
          height: 60px;
          display: flex;
          justify-content: center;
          align-items: center;
          cursor: pointer;
          box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
          transition: background-color 0.3s ease;
      }
  
      .payroll-round-button:hover {
          background-color: #d7f5d9;
      }
  
      /* Text animation on hover */
      .payroll-hover-label {
          position: absolute;
          top: 50%;
          left: 100%;
          transform: translateY(-50%);
          white-space: nowrap;
          background-color: var(--main-color);
          color: var(--text-color);
          padding: 8px 15px;
          border-radius: 5px;
          font-family: Arial, sans-serif;
          font-size: 14px;
          opacity: 0;
          transition: opacity 0.3s, transform 0.3s;
      }
  
      .payroll-round-button:hover + .payroll-hover-label {
          opacity: 1;
          transform: translate(-100%, -50%);
      }
  
      /* Form styling */
      .payroll-header {
          text-align: center;
          font-family: Arial, sans-serif;
          color: #333;
          margin-bottom: 20px;
      }
  
      .payroll-label {
          display: block;
          margin-bottom: 5px;
          font-weight: bold;
          color: #555;
      }
  
      .payroll-input {
          width: 100%;
          padding: 10px;
          margin-bottom: 15px;
          border: 1px solid #ccc;
          border-radius: 5px;
      }
  
      .payroll-btn-compute {
          display: block;
          width: 100%;
          padding: 10px;
          background-color: var(--text-color);
          color: white;
          border: none;
          border-radius: 5px;
          font-size: 16px;
          cursor: pointer;
      }
  
      .payroll-btn-compute:hover {
          background-color: #45a049;
      }
  
      .payroll-form-group {
          margin-bottom: 15px;
      }
      .date-and-time{
        font-size: 10px;
      }
  </style>
<div class="sidebar close">
  <div class="logo-details">
      <img src="/img/dalogo.png" alt="Logo" id="sidebar-logo2"> <!-- The 'src' will be updated by JavaScript -->
      <span class="logo_name" id="sidebar-system-name"></span> <!-- The system name will be updated by JavaScript -->
  </div>
        <ul class="nav-links">
          <li>
            <a href="/admin">
              <i class='bx bxs-home'></i>
              <span class="link_name">Dashboard</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="/admin">Dashboard</a></li>
            </ul>
          </li>
          <li>
            <a href="/admin/members">
              <i class='bx bxs-user'></i>
              <span class="link_name">Manage Employees</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="/admin/members">Manage Employees</a></li>
            </ul>
          </li>
          <li>
            <a href="/admin/attendance">
              <i class='bx bxs-calendar-check'></i>
              <span class="link_name">Attendance</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="/admin/attendance">Attendance</a></li>
            </ul>
          </li>
          <li>
            <a href="/admin/fingerprint">
              <i class="fa-solid fa-fingerprint"></i>
                <span class="link_name">Fingerprint Attendance</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="/admin/fingerprint">Fingerprint Attendance</a></li>
            </ul>
        </li>
          {{-- <li>
            <a href="/admin/job-applications">
              <i class='bx bxs-briefcase'></i>
              <span class="link_name">Job Applications</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="/admin/job-applications">Job Applications</a></li>
            </ul>
          </li> --}}
          <li>
            <div class="iocn-link">
              <a href="#">
                
                <i class="fas fa-user-tie"></i>
                <span class="link_name">Job Applications</span>
              </a>
              <i class='bx bx-plus arrow'></i>
                        </div>
            <ul class="sub-menu">
              <li><a class="link_name" href="#">Job Applications</a></li>
              <li><a href="/admin/job-list"><i class='bx bxs-briefcase'></i>
                Job List</a></li>
              <li><a href="/admin/job-applications"><i class='bx bx-building'></i>Applications</a></li>
              <li><a href="/admin/requirements"><i class='bx bx-file'></i>Requirements</a></li>

            </ul>
          </li>
          <li>
            <a href="/admin/verify-member">
              <i class='bx bxs-user-plus'></i>
              <span class="link_name">Employees Registrations</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="/admin/verify-member">Employees Registrations</a></li>
            </ul>
          </li>
          <li>
            <div class="iocn-link">
              <a href="#">
                <i class='bx bx-money'></i>
                <span class="link_name">Payroll</span>
              </a>
              <i class='bx bx-plus arrow'></i>
            </div>
<ul class="sub-menu">
  <li><a class="link_name" href="#">Payroll</a></li>
  <li><a href="/admin/payroll/"><i class='bx bx-file'></i> Permanent</a></li>
  <li><a href="/admin/payrollCM/"><i class='bx bx-briefcase'></i> Contractual</a></li> <!-- New Item -->
  <li><a href="/admin/payrollCS/"><i class='bx bx-briefcase'></i> Contractual Semi-Month</a></li> <!-- New Item -->

  <li><a href="/admin/payrollJO/"><i class='bx bx-task'></i> Job Order</a></li> <!-- New Item -->
  <li><a href="/admin/member-deductions"><i class='bx bx-minus-circle'></i> Deductions</a></li>
  <li><a href="/admin/adjustment"><i class='bx bx-gift'></i> Issue Adjustment</a></li> <!-- Added Item -->
  <li><a href="/admin/pera_aca"><i class='bx bx-gift'></i> Pera/Aca</a></li> 
  <li><a href="/admin/add_com"><i class='bx bx-gift'></i> Add/Com</a></li> 
</ul>

          
          <li>
            <a href="/admin/leaves">
              <i class='bx bx-time-five'></i>
              <span class="link_name">Leave Applications</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="/admin/leaves">Leave Applications</a></li>
            </ul>
          </li>
          <li>
            <a href="/admin/travel">
              <i class='bx bx-car'></i>
              <span class="link_name">Travel Applications</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="/admin/travel">Travel Applications</a></li>
            </ul>
          </li>
          <li>
            <div class="iocn-link">
              <a href="#">
                <i class='bx bx-cog'></i>
                <span class="link_name">Settings</span>
              </a>
              <i class='bx bx-plus arrow'></i>
                        </div>
            <ul class="sub-menu">
              <li><a class="link_name" href="#">Settings</a></li>
              <li><a href="/admin/settings"><i class='bx bx-pen'></i> General Settings</a></li>
              <li><a href="/admin/departments"><i class='bx bx-building'></i> Department List</a></li>
              <li><a href="/admin/positions"><i class='bx bx-briefcase'></i> Position List</a></li>
              <li><a href="/admin/holidays"><i class='bx bx-wallet'></i>Holidays</a></li>
              <li><a href="/admin/bonuses"><i class='bx bx-gift'></i> Adjustments</a></li>
              <li><a href="/admin/deductions"><i class='bx bx-gift'></i> Deductions</a></li>
            </ul>
          </li>
          
          <li>
            <a href="">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                  <button type="submit" style="background: none; border: none; cursor: pointer; width: 100%;">
                    <i class='bx bx-log-out'></i>
                    <span class="link_name">Logout</span>
                  </button>               
            </form>
          </a>
        </li>
        </ul>
      </div>
      <script>
        function updateColorsFromSettings() {
            fetch("{{ route('settings') }}") // Assuming this route returns the settings as JSON
                .then(response => response.json())
                .then(data => {
                    if (data.settings) {
                        // Update CSS variables based on general settings
                        document.documentElement.style.setProperty('--main-color', data.settings.main_color);
                        document.documentElement.style.setProperty('--background-color', data.settings.background_color);
                        document.documentElement.style.setProperty('--text-color', data.settings.text_color);
                        document.documentElement.style.setProperty('--sidebar-bg-color', data.settings.sidebar_bg_color);
                        document.documentElement.style.setProperty('--topbar-bg-color', data.settings.topbar_bg_color);

                        // Update the font style
                        if (data.settings.font_style) {
                            document.documentElement.style.setProperty('--font-style', data.settings.font_style);
                            updateFontLink(data.settings.font_style);
                        }

                        // Update the system name and logo in the sidebar
                        const systemNameElement = document.getElementById('sidebar-system-name');
                        const logoElement = document.getElementById('sidebar-logo');

                        // Set the system name
                        if (systemNameElement && data.settings.system_name) {
                            systemNameElement.textContent = data.settings.system_name;
                        }

                        // Set the logo image source
                        if (logoElement && data.settings.logo) {
                            const logoPath = `{{ asset('storage/') }}/${data.settings.logo}`;
                            logoElement.src = logoPath;
                        }
                    }
                })
                .catch(error => console.error('Error fetching settings:', error));
        }

        // Function to update Google Fonts
        function updateFontLink(fontName) {
            const fontLink = document.getElementById('google-font-link');
            const fontNameFormatted = fontName.replace(/ /g, '+');
            fontLink.href = `https://fonts.googleapis.com/css?family=${fontNameFormatted}&display=swap`;
        }

        // Initial call to update settings
        updateColorsFromSettings();

        // Optional: Update every 30 seconds if needed
        setInterval(updateColorsFromSettings, 30000);
    </script>

    
    
    
<script>
  let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".logo-details");
console.log(sidebarBtn);
sidebarBtn.addEventListener("click", ()=>{
  sidebar.classList.toggle("close");
});
let arrow = document.querySelectorAll(".arrow");

for (var i = 0; i < arrow.length; i++) {
  arrow[i].addEventListener("click", (e) => {
    let arrowParent = e.target.parentElement.parentElement; 
    arrowParent.classList.toggle("showMenu");

    if (arrowParent.classList.contains("showMenu")) {
      e.target.classList.remove("bx-plus");
      e.target.classList.add("bx-minus");
    } else {
      e.target.classList.remove("bx-minus");
      e.target.classList.add("bx-plus");
    }
  });
}


document.addEventListener("DOMContentLoaded", function() {
    // Get all alert elements
    var alerts = document.querySelectorAll('.alert');

    // Display the alerts with animation
    alerts.forEach(function(alert) {
        setTimeout(function() {
            alert.classList.add('show'); // Add 'show' class to trigger animation

            // Hide the alert after 5 seconds
            setTimeout(function() {
                alert.classList.remove('show');
                alert.classList.add('hide');
            }, 5000); // Adjust the timeout duration if needed
        }, 100); // Delay to ensure CSS transition
    });
});


// URL mappings for each notification type
const notificationTypeUrls = {
    applicants: '/admin/applicants',
    attendance: '/admin/attendance',
    bonuses: '/admin/bonuses',
    deductions: '/admin/deductions',
    departments: '/admin/departments',
    general_settings: '/admin/general-settings',
    holidays: '/admin/holidays',
    job_applications: '/admin/job-applications',
    job_listings: '/admin/job-listings',
    late_deductions: '/admin/deductions',
    learning_development: '/admin/learning-development',
    leaves: '/admin/leaves',
    legal_questionnaire: '/admin/legal-questionnaire',
    member: '/admin/member',
    admin: '/admin',
    travel: '/admin/travel'
};

// Fetch notifications and populate dropdown list
async function fetchAdminNotifications() {
    try {
        const response = await fetch('/admin/notifications');
        const notifications = await response.json();

        const notificationBadge = document.getElementById('notificationBadge');
        const notificationList = document.getElementById('notificationList');

        notificationList.innerHTML = ''; // Clear previous notifications
        let unreadCount = 0;

        notifications.forEach(notification => {
            // Track unread notifications for the badge count
            if (!notification.is_read_admin) unreadCount++;

            // Create notification item
            const listItem = document.createElement('li');
            listItem.classList.add('notification-item');
            listItem.classList.add(notification.is_read_admin ? 'read' : 'unread');
            listItem.innerHTML = `
                <div>${notification.message}</div>
                <div class="date-and-time" >${new Date(notification.created_at).toLocaleString()}</div>
            `;
            // Redirect to page based on notification type when clicked
            listItem.onclick = () => {
                markAsRead(notification.id, listItem, notification.type);
            };

            notificationList.appendChild(listItem);
        });

        // Update badge count
        notificationBadge.textContent = unreadCount;
        notificationBadge.style.display = unreadCount > 0 ? 'inline' : 'none';
    } catch (error) {
        console.error('Error fetching notifications:', error);
    }
}

// Mark notification as read and redirect based on type
async function markAsRead(id, listItem, type) {
    try {
        const response = await fetch(`/admin/notifications/${id}/read`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
        const result = await response.json();

        if (result.success) {
            // Update the notification item styling
            listItem.classList.remove('unread');
            listItem.classList.add('read');
            listItem.style.fontWeight = 'normal';
            listItem.style.color = '#aaa';

            // Redirect to the URL based on notification type
            if (notificationTypeUrls[type]) {
                window.location.href = notificationTypeUrls[type];
            }
        }
    } catch (error) {
        console.error('Error marking notification as read:', error);
    }
}

// Toggle dropdown visibility
function toggleDropdown() {
    const dropdown = document.getElementById('notificationDropdown');
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
}

// Fetch notifications regularly
fetchAdminNotifications();
setInterval(fetchAdminNotifications, 30000);


</script>