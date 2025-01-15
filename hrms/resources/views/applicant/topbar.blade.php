<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Listings</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.1/css/boxicons.min.css">
    <link rel="stylesheet" href="/css/styles.css">

    <style>
        body {
            background-color: #f7f9fc;
            margin: 0;
            font-family: Arial, sans-serif;
            height: 100vh;
            overflow: hidden;
        }

        .topheader {
            width: 100%;
            background-color: #116401;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 10px 20px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            height: 40px;
        }

        .header {
            width: 100%;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            height: 60px;
        }

        .header img {
            height: 40px;
            margin-left: 20px;
        }

        .search-bar {
            margin: 0 20px;
            display: flex;
            flex-direction: row;
            justify-content: space-around;
        }

        .content {
            width: 100%;
            height: calc(100vh - 100px); /* Adjust based on the height of headers */
            margin-top: 100px; /* Account for the fixed headers */
            overflow-y: auto;
            padding: 20px 0;
            display: flex;
            justify-content: center;
        }

        .job-listings {
            width: 90%;
            max-width: 1200px;
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
                align-items: flex-start;
            }

            .search-bar {
                margin: 10px 0;
                width: 100%;
            }
        }

        .icon-container {
            display: flex;
            align-items: center;
        }

        .notification-bell {
            position: relative;
            margin-right: 20px;
            cursor: pointer;
        }

        .notification-bell .badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 3px 7px;
            font-size: 12px;
        }

        .profile-dropdown {
            position: relative;
            display: inline-block;
        }

        .profile-icon {
            cursor: pointer;
        }

        .profile-menu {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background-color: white;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            padding: 10px;
            width: 150px;
            z-index: 200;
        }

        .profile-menu a {
            display: block;
            padding: 8px 12px;
            color: #333;
            text-decoration: none;
        }

        .profile-menu a:hover {
            background-color: #f1f1f1;
        }

        .profile-dropdown:hover .profile-menu {
            display: block;
        }
      .pds-button {
    display: flex;
    align-items: center;
    background-color: #4caf50;
    border: none;
    border-radius: 5px;
    padding: 12px;
    color: white;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}
.job-card {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    position: relative;
    border-left: 4px solid #4caf50;
}

.job-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #eee;
    padding-bottom: 10px;
    margin-bottom: 15px;
}

.job-title, .job-description p {
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
@media screen and (max-width: 400px){

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


.descriptio-container{
    overflow: hidden;
    max-width: 100%;
}

@media (max-width: 600px) {
    .greetings{
        display: none;
}
}
.notification-bell i, .profile-dropdown i{
    font-size: 26px;
}
.left-header{
    display: flex;
    gap: 20px;
    align-items: center;
}
    </style>
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
      .notification-container i {
          font-size: 24px;
          margin-left: 20px;
          cursor: pointer;
          color: #333;
      }
      .navigate-button {
            position: fixed;
            bottom: 0; /* Distance from the bottom of the screen */
            left: 0;   /* Distance from the left of the screen */
            background-color: #4caf50; /* Green background color */
            color: white; /* White text color */
            padding: 10px 30px; /* Padding for top/bottom and left/right */
            border: none; /* No border */
            border-top-right-radius: 20px; /* Curved right top corner */
            text-decoration: none; /* No underline for the link */
            font-size: 16px; /* Font size */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Subtle shadow */
            transition: background-color 0.3s; /* Smooth transition for background color */
            z-index: 1;
        }

        .navigate-button:hover {
            background-color: #388e3c; /* Darker green on hover */
        }
      </style>
</head>
<body>
    <a href="/applicant/applications" class="navigate-button">Job Applications</a>
    <div class="topheader-hide">
        {{-- <p>Welcome, {{ $applicantName }}!</p> --}}
    </div>

    <div class="header">
        <div class="left-header">
            <img src="/img/dalogo.png" alt="Company Logo">
            <p class="greetings" >Welcome, {{ $applicantName }}!</p>
        </div>
        
        <div class="icon-container">
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
            <!-- Profile Icon with Dropdown -->
            <button class="pds-button">
                <div>Generate PDS</div> <i class="bx bxs-file-export"></i>
          </button>
          <div></div>
            <div class="profile-dropdown">
                <i class="bx bx-user-circle bx-2x profile-icon"></i>
                <div class="profile-menu">
                    
                    <a href="/applicant/profile">My Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" style="background: none; border: none; cursor: pointer; width: 100%; text-align: left; padding: 8px 12px;">
                            Logout
                        </button>
                    </form>
                </div>
            </div>

            
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var isAuthenticated = @json(auth()->check());
    
            document.querySelector('.pds-button').addEventListener('click', function () {
                if (!isAuthenticated) {
                    // Redirect to login if the user is not authenticated
                    window.location.href = '/applicant/login';
                } else {
                    // Redirect to the personal information form if authenticated
                    window.location.href = '/applicant/personal-information';
                }
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
    leaves: '/member/leave',
    legal_questionnaire: '/admin/legal-questionnaire',
    member: '/admin/member',
    admin: '/member/index',
    travel: '/admin/travel'
};

// Fetch notifications and populate dropdown list
async function fetchApplicantNotifications() {
    try {
        const response = await fetch('/applicant/notifications');
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
              markApplicantNotificationAsRead(notification.id, listItem, notification.type);
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
async function markApplicantNotificationAsRead(id, listItem, type) {
    try {
        const response = await fetch(`/applicant/notifications/${id}/read`, {
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
fetchApplicantNotifications();
setInterval(fetchApplicantNotifications, 30000);

    </script>
    