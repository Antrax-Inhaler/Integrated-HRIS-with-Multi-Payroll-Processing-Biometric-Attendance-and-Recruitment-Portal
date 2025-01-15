<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/css/styles.css">
</head>
<style>
.alert {
    width: 100%; /* Full width */
    top: 0; /* Position at the top */
    color: white; /* White text color */
    padding: 15px; /* Add some padding */
    z-index: 2; /* Ensure it stays on top */
    position: fixed; /* Fixed positioning */
    left: 0; /* Align to the left */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); /* Optional shadow for better visibility */
    display: flex; /* Use flexbox for alignment */
    align-items: center; /* Center align items vertically */
}

.success-alert {
    background-color: #4caf50; /* Green background for success */
}

.error-alert {
    background-color: #f44336; /* Red background for error */
}

.alert i {
    margin-right: 10px; /* Space between icon and text */
    font-size: 20px; /* Icon size */
}
@keyframes slideDown {
    from {
        transform: translateY(-100%); /* Start off-screen at the top */
        opacity: 0; /* Start invisible */
    }
    to {
        transform: translateY(0); /* End at its original position */
        opacity: 1; /* Fade in */
    }
}

@keyframes slideUp {
    from {
        transform: translateY(0); /* Start at its original position */
        opacity: 1; /* Start fully visible */
    }
    to {
        transform: translateY(-100%); /* Move off-screen to the top */
        opacity: 0; /* Fade out */
    }
}

.alert {
    animation: slideDown 0.5s ease forwards; /* Entrance animation */
    transition: opacity 0.5s ease; /* Smooth transition for opacity */
}

/* Class for exit animation */
.alert.exit {
    animation: slideUp 0.5s ease forwards; /* Exit animation */
}

.container {
    max-width: 800px; /* Set a max width for the container */
    margin: 0 auto; /* Center the container */
    padding: 20px; /* Add some padding */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Optional: Add some shadow for depth */
    border-radius: 8px; /* Optional: Rounded corners */


}
@media (min-width: 850px) {
    .container {
        width: 800px; /* Fixed width for larger screens */
        margin: 20px auto; /* Center the container */
        
    }
}
@media (max-width: 849px) {
    .container {
        width: 100% !important; /* Fixed width for larger screens */
        margin: 20px auto; /* Center the container */
        
    }
}

body {
    display: flex;
    justify-content: center; /* Center horizontally */
    align-items: center; /* Center vertically */
    min-height: 100vh; /* Full height of the viewport */
    font-family: Arial, Helvetica, sans-serif;
    overflow: scroll;
    padding-top: 60px;

}

    h1, h2 {
        text-align: center;
    }
    .section-title {
        font-weight: bold;
        margin-top: 20px;
        text-transform: uppercase;
        background-color: #c5ffb6;
        padding: 10px;
        margin-bottom: 20px;

    }
    .form-group {
        margin-bottom: 15px;
    }
    .form-group label {
        display: block;
        font-weight: bold;
    }
    .form-group input, .form-group select {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        box-sizing: border-box;
    }
    .checkbox-group {
        margin-top: 10px;
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
    /* Base styles for input fields */
input,
select {
    padding: 12px 20px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px; /* Rounded edges */
    background-color: #f9f9f9;
    transition: border-color 0.3s, background-color 0.3s; /* Smooth transition */
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

/* Styles for date input */
input[type="date"] {
    padding: 12px 20px; /* Match other input styles */
}

/* Styles for radio buttons */
input[type="radio"],
input[type="checkbox"] {
    width: 20px; /* Set size */
    height: 20px; /* Set size */
    border-radius: 50%; /* Make radio buttons round */
    cursor: pointer; /* Pointer cursor for better UX */
}

/* Active state for radio and checkbox */
input[type="radio"]:checked,
input[type="checkbox"]:checked {
    background-color: #4caf50; /* Green when checked */
    border: 2px solid #4caf50; /* Green border */
}

/* Custom styles for radio and checkbox */
input[type="radio"] + label,
input[type="checkbox"] + label {
    margin-left: 10px; /* Space between the input and label */
    cursor: pointer; /* Pointer cursor for better UX */
}

.button-group {
    display: flex; /* Align buttons in a row */
    justify-content: flex-end; /* Align buttons to the right */
    margin-top: 10px; /* Space above the button group */
}

.update-button,
.delete-button {
    background-color: transparent; /* Transparent background */
    border: none; /* No border */
    cursor: pointer; /* Pointer cursor */
    font-size: 20px; /* Increase icon size */
    margin-left: 10px; /* Space between buttons */
    color: #4caf50; /* Color for update button */
}

.delete-button {
    color: #f44336; /* Color for delete button */
}

.update-button:hover,
.delete-button:hover {
    opacity: 0.7; /* Slightly transparent on hover */
}

/* Optional: Add padding and border radius for the buttons */
.update-button,
.delete-button {
    padding: 10px;
    border-radius: 5px;
}
.navigation-buttons {
    display: flex; /* Use flexbox for horizontal alignment */
    justify-content: flex-end; /* Space between buttons */
    margin-top: 20px; /* Add some top margin */
    gap: 20px;
}

.nav-button {
    padding: 12px 20px; /* Button padding */
    font-size: 16px; /* Font size */
    border: none; /* Remove border */
    border-radius: 5px; /* Rounded corners */
    cursor: pointer; /* Pointer cursor on hover */
    transition: background-color 0.3s; /* Smooth background change */
}

.nav-button:hover {
    background-color: #4caf50; /* Change color on hover */
    color: white; /* Text color on hover */
}
#back-button{
    background-color: #333;
    color: white;
}
#next-button{
    background-color: #4caf50;
}
a{
    text-decoration: none;
}

/* Fixed Top Navigation Bar */
.top-nav {
            position: fixed;
            top: 0;
            width: 100%;
            background-color: #2c3e50;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            overflow-x: auto; /* Allow horizontal scrolling if content overflows */
        }

        /* Navigation List */
        .nav-list {
            display: flex;
            list-style: none;
            padding: 10px;
            margin: 0;
        }

        /* Navigation Item */
        .nav-item {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            margin: 0 5px;
            cursor: pointer;
            color: #ecf0f1;
            border-radius: 8px;
            transition: background-color 0.3s;
        }

        /* Active Navigation Item */
        .nav-item.active {
            background-color: #2980b9;
            color: #ffffff;
        }

        /* Hover Effect */
        .nav-item:hover {
            background-color: #34495e;
        }

        /* Navigation Icons */
        .nav-item i {
            margin-right: 8px;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .nav-item {
                padding: 8px 10px;
                font-size: 14px;
            }

            .nav-item i {
                margin-right: 5px;
            }
        }
        table{
            border: solid black 1px;
            width: 100%;
        }
        th, td {
            border: solid black 1px;
            text-align: center;
        }
        thead{
            background-color: rgb(238, 236, 236);
        }
</style>
<body>
    
<div class="top-nav">
    <ul class="nav-list">
        <li class="nav-item" data-url="/applicant/">
            <i class="fas fa-arrow-left"></i> Back
        </li>
        
        <li class="nav-item" data-url="/applicant/personal-information"><i class="fas fa-user"></i>Personal Information</li>
        <li class="nav-item" data-url="/applicant/referencespds"><i class="fas fa-address-book"></i>References PDS</li>
        <li class="nav-item" data-url="/applicant/educational-background"><i class="fas fa-school"></i>Educational Background</li>
        <li class="nav-item" data-url="/applicant/civilserviceeligibility"><i class="fas fa-certificate"></i>Civil Service Eligibility</li>
        <li class="nav-item" data-url="/applicant/work-experience"><i class="fas fa-briefcase"></i>Work Experience</li>
        <li class="nav-item" data-url="/applicant/voluntary-work"><i class="fas fa-hands-helping"></i>Voluntary Work</li>
        <li class="nav-item" data-url="/applicant/learning-development"><i class="fas fa-book-open"></i>Learning & Development</li>
        <li class="nav-item" data-url="/applicant/other-information"><i class="fas fa-info-circle"></i>Other Information</li>
        <li class="nav-item" data-url="/applicant/legal-questionnaire"><i class="fas fa-gavel"></i>Legal Questionnaire</li>
        <li class="nav-item" data-url="/applicant/references"><i class="fas fa-id-badge"></i>References</li>
    </ul>
</div>
    <div class="container">
@if (session('success'))
  <div class="alert success-alert" id="success-alert">
      <i class="fas fa-check-circle"></i> {{ session('success') }}
  </div>
@endif

@if ($errors->any())
  <div class="alert error-alert" id="error-alert">
      <i class="fas fa-exclamation-triangle"></i>
      @foreach ($errors->all() as $error)
          {{ $error }}<br>
      @endforeach
  </div>
@endif

<script>
function autoDismissAlert(alertId) {
    const alertElement = document.getElementById(alertId);
    setTimeout(() => {
        alertElement.classList.add('exit'); // Add exit animation class
        setTimeout(() => {
            alertElement.style.display = 'none'; // Hide the alert after the animation
        }, 500); // Match this duration to the exit animation duration
    }, 10000); // Time before it starts to exit (3 seconds)
}

// Automatically dismiss alerts if they exist
if (document.getElementById('success-alert')) {
    autoDismissAlert('success-alert');
}

if (document.getElementById('error-alert')) {
    autoDismissAlert('error-alert');
}
</script>



<!-- JavaScript for Navigation Functionality -->
<script>
    // Get all navigation items
    const navItems = document.querySelectorAll('.nav-item');

    // Function to set the active item based on the current URL
    function setActiveNavItem() {
        // Get the current URL path
        const currentPath = window.location.pathname;

        // Loop through each navigation item
        navItems.forEach(item => {
            // Remove active class from all items
            item.classList.remove('active');

            // Add active class to the item that matches the current URL
            if (item.getAttribute('data-url') === currentPath) {
                item.classList.add('active');
            }
        });
    }

    // Call setActiveNavItem on page load
    setActiveNavItem();

    // Add click event listener to navigation items
    navItems.forEach(item => {
        item.addEventListener('click', () => {
            // Navigate to the specified URL
            window.location.href = item.getAttribute('data-url');
        });
    });
</script>
<script>
    window.embeddedChatbotConfig = {
    chatbotId: "1v_mys87K8vKvMJJL3Rna",
    domain: "www.chatbase.co"
    }
    </script>
    <script
    src="https://www.chatbase.co/embed.min.js"
    chatbotId="1v_mys87K8vKvMJJL3Rna"
    domain="www.chatbase.co"
    defer>
    </script>