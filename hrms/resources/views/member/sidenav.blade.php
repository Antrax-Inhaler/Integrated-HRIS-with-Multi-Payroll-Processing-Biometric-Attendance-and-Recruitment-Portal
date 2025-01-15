<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Portal</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/calendar.css">
    <link rel="icon" href="/img/dalogo.png" type="icon">
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    />   

    <!-- chart -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;700&display=swap"
        rel="stylesheet"
    />
</head>
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
.topbar-right i {
    font-size: 24px;
    margin-left: 20px;
    cursor: pointer;
    color: #333;
}
</style>
    <div class="sidebar close">
        <div class="logo-details">
            <img src="/img/dalogo.png" alt="">
            <span class="logo_name">HRMS</span>
        </div>
        <ul class="nav-links">
            <!-- Dashboard -->
            <li>
                <a href="/member/index">
                    <i class='bx bxs-home'></i>
                    <span class="link_name">Dashboard</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/user/index">Dashboard</a></li>
                </ul>
            </li>
            <!-- Attendance -->
            <li>
                <a href="/member/attendance">
                    <i class='bx bxs-check-circle'></i>
                    <span class="link_name">Attendance</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/member/attendance">Attendance</a></li>
                </ul>
            </li>
            <!-- Payslip -->
            <li>
                <a href="/member/payslip">
                    <i class='bx bx-money'></i>
                    <span class="link_name">Payslip</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/user/payslip">Payslip</a></li>
                </ul>
            </li>
            <!-- Travel -->
            <li>
                <a href="/member/travel">
                    <i class='bx bxs-plane'></i>
                    <span class="link_name">Travel</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/user/travel">Travel</a></li>
                </ul>
            </li>
            <!-- Leave -->
            <li>
              <a href="/member/leave">
                  <i class='bx bxs-calendar-check'></i>
                  <span class="link_name">Leave</span>
              </a>
              <ul class="sub-menu blank">
                  <li><a class="link_name" href="/member/leave">Leave</a></li>
              </ul>
          </li>
          <li>
              <a href="/member/bonuses">
                  <i class='bx bxs-gift'></i>
                  <span class="link_name">Adjustments</span>
              </a>
              <ul class="sub-menu blank">
                  <li><a class="link_name" href="/member/bonuses">Adjustments</a></li>
              </ul>
          </li>
          <li>
              <a href="/member/add-com">
                  <i class='bx bxs-dollar-circle'></i>
                  <span class="link_name">Add/Com</span>
              </a>
              <ul class="sub-menu blank">
                  <li><a class="link_name" href="/member/add-com">Add/Com</a></li>
              </ul>
          </li>
          <li>
              <a href="/member/pera-aca">
                  <i class='bx bxs-wallet'></i>
                  <span class="link_name">Pera/Aca</span>
              </a>
              <ul class="sub-menu blank">
                  <li><a class="link_name" href="/member/pera-aca">Pera/Aca</a></li>
              </ul>
          </li>
          <li>
              <a href="/member/deductions">
                  <i class='bx bxs-minus-circle'></i>
                  <span class="link_name">Deductions</span>
              </a>
              <ul class="sub-menu blank">
                  <li><a class="link_name" href="/member/deductions">Deductions</a></li>
              </ul>
          </li>
          
            <!-- Profile Info -->
            <li>
                <a href="/member/profile-info">
                    <i class='bx bxs-user'></i>
                    <span class="link_name">Profile Info</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/user/profile-info">Profile Info</a></li>
                </ul>
            </li>
            <!-- Logs -->
<li>
  <a href="/member/logs">
      <i class='bx bxs-book'></i>
      <span class="link_name">Logs</span>
  </a>
  <ul class="sub-menu blank">
      <li><a class="link_name" href="/member/logs">Logs</a></li>
  </ul>
</li>
            <!-- Logout -->
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

        <!-- Chatbot iframe -->
        <iframe
            src="https://www.chatbase.co/chatbot-iframe/XJrq5XGGemsfY5X_30vHq"
            width="100%"
            style="height: 100%; min-height: 700px"
            frameborder="0"
        ></iframe>
    </div>
    <header class="topbar">
        <div class="topbar-content">
          <div class="topbar-left">

          </div>
          
          <div class="topbar-right">
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
      
            <!-- User Icon with Animated Greeting and Dropdown -->
            <div class="greeting-container">
              <div class="greeting-message">
                <span>Welcome! {{ Auth::user()->given_name }}</span>
                <i class='bx bx-user user-icon'></i>
              </div>
              <div class="dropdown-menu">
                {{-- <a href="{{ route('profile') }}">My Profile</a> --}}
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                    <button type="submit" style="background: none; border: none; cursor: pointer; width: 100%;">
                      <i class='bx bx-log-out'></i>
                      <span class="link_name">Logout</span>
                    </button>               
              </form>
              
              </div>
            </div>
          </div>
        </div>
      </header>
      
      <style>
      /* General Styles for Topbar */
      .topbar {
        top: 0;
        left: 0;
        width: 100%;
        height: 60px;
          background-color: var(--topbar-bg-color);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        z-index: 100;
        display: flex;
        align-items: center;
        padding: 0 20px;
        transition: all 0.2s ease;
      }
      
      .topbar-content {
        display: flex;
        justify-content: space-between;
        width: 100%;
      }
      
      .topbar-right {
        display: flex;
        align-items: center;
      }
      
      .notification-bell {
        position: relative;
      }
      
      .notification-bell i {
        font-size: 24px;
        cursor: pointer;
        color: #333;
      }
      
      .badge {
        position: absolute;
        top: -8px;
        right: -8px;
        background-color: red;
        color: white;
        border-radius: 50%;
        padding: 4px 7px;
        font-size: 12px;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      
      /* Greeting Animation */
      .greeting-container {
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
      }
      
      .user-icon {
        font-size: 20px;
        color: white;
        padding: 10px;
        transition: all 0.3s ease;
      }
      
      .greeting-message {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        color: white;
        background: linear-gradient(to bottom right, #9CDC78, #74DCB0);
        border-radius: 50px;
        margin-left: 10px;
        white-space: nowrap;
        opacity: 0;
        width: 0;
        padding-left: 10px;
        transform: scaleX(0);
        transform-origin: right;
        transition: all 1.5s ease; /* Slowed down animation */
      }
      
      .greeting-container:hover .greeting-message {
        opacity: 1;
        width: auto;
        transform: scaleX(1);
      }
      
      /* Entrance animation for the greeting oblong */
      @keyframes expandGreeting {
        0% {
          width: 0;
          opacity: 0;
          transform: scaleX(0);
        }
        100% {
          width: auto;
          opacity: 1;
          transform: scaleX(1);
        }
      }
      
      .greeting-container .greeting-message {
        animation: expandGreeting 1.5s forwards ease; /* Slowed down to 1.5s */
      }
      
      /* Dropdown Menu */
      .dropdown-menu {
        display: none;
        position: absolute;
        top: 100%;
        right: 0;
        background-color: white;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        min-width: 160px;
        z-index: 200;
      }
      
      .dropdown-menu a, .dropdown-menu button {
        display: block;
        padding: 10px 15px;
        color: #333;
        text-decoration: none;
        border: none;
        background: none;
        text-align: left;
        width: 100%;
      }
      
      .dropdown-menu a:hover, .dropdown-menu button:hover {
        background-color: #f1f1f1;
      }
      
      /* Show dropdown menu on click */
      .greeting-container:hover .dropdown-menu {
        display: block;
      }
      
      /* Responsive styles */
      @media (max-width: 768px) {
        .topbar {
          width: 100%;
        }
      }
      </style>
      <script>
document.querySelector('.greeting-container').addEventListener('click', function(event) {
  const dropdownMenu = this.querySelector('.dropdown-menu');
  dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
});
</script>

      </script>
            <script>
        function updateColorsFromSettings() {
    fetch("{{ route('settings.viewer') }}") // Fetch settings JSON data
        .then(response => response.json())
        .then(data => {
            if (data.settings) {
                // Update CSS variables
                document.documentElement.style.setProperty('--main-color', data.settings.main_color);
                document.documentElement.style.setProperty('--background-color', data.settings.background_color);
                document.documentElement.style.setProperty('--text-color', data.settings.text_color);
                document.documentElement.style.setProperty('--sidebar-bg-color', data.settings.sidebar_bg_color);
                document.documentElement.style.setProperty('--topbar-bg-color', data.settings.topbar_bg_color);
                
                // Update the font style (if applied directly)
                document.documentElement.style.setProperty('--font-style', data.settings.font_style);

                // Update the system name and logo in the sidebar
                const systemNameElement = document.getElementById('sidebar-system-name');
                const logoElement = document.getElementById('sidebar-logo');

                if (systemNameElement && data.settings.system_name) {
                    systemNameElement.textContent = data.settings.system_name;
                }

                // Update the logo image
                if (logoElement && data.settings.logo) {
                    logoElement.src = data.settings.logo;
                }
            }
        })
        .catch(error => console.error('Error fetching settings:', error));
}

// Call the function initially to set up styles
updateColorsFromSettings();

// Optional: Update every 30 seconds to reflect any backend changes in real-time
setInterval(updateColorsFromSettings, 30000);




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
            }, 17000); // Adjust the timeout duration if needed
        }, 100); // Delay to ensure CSS transition
    });
});



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
    leaves: '/member/leave',
    legal_questionnaire: '/admin/legal-questionnaire',
    member: '/admin/member',
    admin: '/member/index',
    travel: '/admin/travel'
};

// Fetch notifications and populate dropdown list
async function fetchMemberNotifications() {
    try {
        const response = await fetch('/member/notifications');
        const notifications = await response.json();

        const notificationBadge = document.getElementById('notificationBadge');
        const notificationList = document.getElementById('notificationList');

        notificationList.innerHTML = ''; // Clear previous notifications
        let unreadCount = 0;

        notifications.forEach(notification => {
            // Track unread notifications for the badge count
            if (!notification.is_read) unreadCount++;

            // Create notification item
            const listItem = document.createElement('li');
            listItem.classList.add('notification-item');
            listItem.classList.add(notification.is_read ? 'read' : 'unread');
            listItem.innerHTML = `
                <div>${notification.message}</div>
                <div class="date-and-time" >${new Date(notification.created_at).toLocaleString()}</div>
            `;
            // Redirect to page based on notification type when clicked
            listItem.onclick = () => {
              markMemberNotificationAsRead(notification.id, listItem, notification.type);
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
async function markMemberNotificationAsRead(id, listItem, type) {
    try {
        const response = await fetch(`/member/notifications/${id}/read`, {
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
fetchMemberNotifications();
setInterval(fetchMemberNotifications, 30000);


          </script>
          