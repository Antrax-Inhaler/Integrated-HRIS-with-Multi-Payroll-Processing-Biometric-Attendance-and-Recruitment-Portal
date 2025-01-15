<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/ribbon.css">
    <!-- ===== CSS ===== -->    
    <!-- ===== BOX ICONS ===== -->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

    <title>HRMS | Login / Signup</title>
    <link rel="icon" href="/img/dalogo.png" type="icon">

    <style>
        /* General body styles */
        body {
            background-color: var(--background-color);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        /* Apply Job button at top left */
        .header {
            position: fixed;
            top: 6px;
            right: 6px;
        }

        .header .button {
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
            background-color: var(--sidebar-bg-color);
        }

        .header .button i {
            margin-right: 8px;
            font-size: 20px;
        }


        /* Login container styles */
        .login {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            max-width: 300px;
            position: absolute;
        }

        .login__content {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
        }

        /* Title styles */
        .login__title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        /* Form input box styles */
        .login__box {
            position: relative;
            margin-bottom: 20px;
        }

        .login__input {
            padding: 12px 40px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .login__input:focus {
            outline: none;
            border-color: var(--sidebar-bg-color);
            background-color: #fff;
        }

        /* Icon inside input */
        .login__icon {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: var(--sidebar-bg-color);
            font-size: 20px;
        }

        /* Forgot password link */
        .login__forgot {
            display: block;
            text-align: right;
            margin-bottom: 20px;
            color: var(--sidebar-bg-color);;
            text-decoration: none;
            font-size: 14px;
        }

        .login__forgot:hover {
            text-decoration: underline;
        }

        /* Button styles */
        .button {
            width: 100%;
            border: none;
            border-radius: 5px;
            padding: 12px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .back{
            background-color: #333;
            margin-bottom: 4px;
        }

        .button-content {
            text-align: center;
            display: block;
        }

        /* Sign up link */
        .login__account {
            display: inline-block;
            margin-right: 5px;
            color: #666;
            font-size: 14px;
        }
        .alert {
  position: fixed;
  top: 20px;
  right: -300px; /* Start off-screen */
  width: 300px; /* Fixed width */
  z-index: 9999;
  padding: 15px 25px;
  border-radius: 4px;
  font-size: 16px;
  opacity: 0; /* Initially hidden */
  transition: opacity 0.5s ease-in-out, right 0.5s ease-in-out;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
  display: flex;
  align-items: center;
  gap: 10px;
}

.success-alert {
  background-color: rgba(76, 175, 80, 0.9); /* Green */
  color: white;
}

.error-alert {
  background-color: rgba(244, 67, 54, 0.9); /* Red */
  color: white;
}

.alert.show {
  opacity: 1; /* Show the alert */
  right: 20px; /* Slide into view */
}

.alert.hide {
  opacity: 0; /* Hide the alert */
  right: -300px; /* Slide out of view */
}
        .login__signin, .login__signup {
            color: var(--sidebar-bg-color);
            cursor: pointer;
            font-weight: bold;
            font-size: 14px;
        }

        .login__signin:hover, .login__signup:hover {
            text-decoration: underline;
        }

        /* Hide and show forms */
        .none {
            display: none;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .login__content {
                padding: 20px;
            }

            .login__title {
                font-size: 20px;
            }

            .login__input {
                padding: 10px 35px;
            }

            .button {
                padding: 10px;
                font-size: 15px;
            }
        }
        a{
            text-decoration: none;
        }
        .alert {
    background-color: red;
    color: white;
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 5px;
    text-align: center;
    width: 100%;
}
.ribbon2 img{
    width:70%
}
.alert {
  position: fixed;
  top: 20px;
  right: -300px; /* Start off-screen */
  width: 300px; /* Fixed width */
  z-index: 9999;
  padding: 15px 25px;
  border-radius: 4px;
  font-size: 16px;
  opacity: 0; /* Initially hidden */
  transition: opacity 0.5s ease-in-out, right 0.5s ease-in-out;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
  display: flex;
  align-items: center;
  gap: 10px;
}

.success-alert {
  background-color: rgba(76, 175, 80, 0.9); /* Green */
  color: white;
}

.error-alert {
  background-color: rgba(244, 67, 54, 0.9); /* Red */
  color: white;
}

.alert.show {
  opacity: 1; /* Show the alert */
  right: 20px; /* Slide into view */
}

.alert.hide {
  opacity: 0; /* Hide the alert */
  right: -300px; /* Slide out of view */
}

.icon {
  font-size: 20px; /* Icon size */
}
body {
  background-color: var(--background-color);
  font-family: var(--font-style) ;
}
a{
  text-decoration: none;
  color: var(--text-color);
}
.button {
          background-color: var(--main-color);
          border-color: var(--main-color);
          color: var(--text-color);
      }


      .btn-danger {
          background-color: #DC3545;
          border-color: #DC3545;
          color: white;
      }

      button:hover {
        background-color: var(--text-color);
        color: var(--sidebar-bg-color);
          transform: scale(1.05); /* Slight zoom effect */
      }
      .ribbon2 {
    background: var(--sidebar-bg-color);
}
.ribbon2:before {
    height: 0;
    width: 0;
    right: -5.5px;
    top: 0.1px;
    border-bottom: 6px solid var(--sidebar-bg-color);
    border-right: 6px solid transparent;
}
.ribbon2:after {
    height: 0;
    width: 0;
    bottom: -29.5px;
    left: 0;
    border-left: 30px solid var(--sidebar-bg-color);
    border-right: 30px solid var(--sidebar-bg-color);
    border-bottom: 30px solid transparent;
}
    </style>
</head>
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
<body>

    <div class="header">
        <a href="applicant/login">
            <button class="button"><i class="bx bx-briefcase"></i> Apply Job</button>

        </a>
    </div>
    <div class="login">
        <div class="login__content">
            <div class="login__forms">
                <span class="ribbon2"><img src="/img/dalogo.png" alt=""></span>

                <!-- Login Form -->
                <form action="{{ route('login') }}" method="POST" class="login__registre" id="loginForm">
                    @csrf
                    <h1 class="login__title">Login</h1>
                    @if ($errors->any())
                    <div class="alert">
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif
                

                    <div class="login__box">
                        <i class='bx bx-user login__icon'></i>
                        <input type="email" name="email" placeholder="Email" required class="login__input">
                    </div>

                    <div class="login__box">
                        <i class='bx bx-lock-alt login__icon'></i>
                        <input type="password" name="password" placeholder="Password" required class="login__input">
                    </div>

                    <a href="#" class="login__forgot">Forgot password?</a>
                    <button class="button" type="submit">
                        <span class="button-content">Login</span>
                    </button>

                    <div>
                        <span class="login__account">Don't have an Account?</span>
                        <span class="login__signin" id="sign-up">Sign Up</span>
                    </div>
                </form>

                <form action="{{ route('register') }}" method="POST" class="login__create none" id="registerForm" enctype="multipart/form-data">
                    @csrf
                    <h1 class="login__title">Register</h1>
                    @if ($errors->any())
                        <div class="alert">
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif
                
                    <!-- Step 1 -->
                    <div id="formStep1">
                        <div class="login__box">
                            <i class='bx bx-image login__icon'></i>
                            <input style="width: 70%" type="file" name="profile_picture" accept="image/*" id="profile_picture" class="login__input" required>
                        </div>
                        
                        <div class="login__box">
                            <img id="imagePreview" src="#" alt="Image Preview" style="display:none; width: 100%; height: auto; border-radius: 5px; margin-bottom: 10px; max-height: 220px;">
                            <div id="loading" style="display:none;">Uploading...</div>
                        </div>
                        <div class="login__box">
                            <i class='bx bx-user login__icon'></i>
                            <input type="text" name="surname" required placeholder="Surname" class="login__input">
                        </div>
                
                        <div class="login__box">
                            <i class='bx bx-user login__icon'></i>
                            <input type="text" name="given_name" required placeholder="Given Name" class="login__input">
                        </div>
                
                        <div class="login__box">
                            <i class='bx bx-user login__icon'></i>
                            <input type="text" name="middle_name" placeholder="Middle Name" class="login__input">
                        </div>
                
                        <button type="button" class="button" id="nextButton1">
                            <span class="button-content">Next</span>
                        </button>
                    </div>
                
                    <!-- Step 2 -->
                    <div id="formStep2" class="none">
                        <div class="login__box">
                            <i class='bx bx-at login__icon'></i>
                            <input type="email" name="email" required placeholder="Email" class="login__input">
                        </div>
                
                        <div class="login__box">
                            <i class='bx bx-phone login__icon'></i>
                            <input type="text" name="contact_number" required placeholder="Contact Number" class="login__input">
                        </div>
                
                        <div class="login__box">
                            <i class='bx bx-lock-alt login__icon'></i>
                            <input type="password" name="password" required placeholder="Password" class="login__input" id="password">
                        </div>
                
                        <div class="login__box">
                            <i class='bx bx-lock-alt login__icon'></i>
                            <input type="password" name="password_confirmation" required placeholder="Verify Password" class="login__input" id="password_confirmation">
                        </div>
                
                        <button type="button" class="button back" id="backButton1">
                            <span class="button-content">Back</span>
                        </button>
                        <br>
                        <button type="button" class="button" id="nextButton2">
                            <span class="button-content">Next</span>
                        </button>
                    </div>
                
                    <!-- Step 3 -->
                    <div id="formStep3" class="none">
                        <div class="login__box">
                            <i class='bx bx-image login__icon'></i>
                            <input style="width: 70%" type="file" name="valid_id" accept="image/*" id="valid_id" class="login__input" required>
                        </div>
                        
                        <div class="login__box">
                            <img id="idPreview" src="#" alt="ID Preview" style="display:none; width: 100%; height: auto; border-radius: 5px; margin-bottom: 10px; max-height: 220px;">
                            <div id="idLoading" style="display:none;">Uploading...</div>
                        </div>
                
                        <button type="button" class="button back" id="backButton2">
                            <span class="button-content">Back</span>
                        </button>
                        <br>
                        <button class="button" type="submit">
                            <span class="button-content">Register</span>
                        </button>
                    </div>
                
                    <div>
                        <span class="login__account">Already have an Account?</span>
                        <span class="login__signup" id="sign-in">Sign In</span>
                    </div>
                </form>
                
                
                <script>
document.addEventListener('DOMContentLoaded', function () {
    const formStep1 = document.getElementById('formStep1');
    const formStep2 = document.getElementById('formStep2');
    const formStep3 = document.getElementById('formStep3');
    const nextButton1 = document.getElementById('nextButton1');
    const nextButton2 = document.getElementById('nextButton2');
    const backButton1 = document.getElementById('backButton1');
    const backButton2 = document.getElementById('backButton2');

    nextButton1.addEventListener('click', function () {
        formStep1.classList.add('none');
        formStep2.classList.remove('none');
    });

    nextButton2.addEventListener('click', function () {
        formStep2.classList.add('none');
        formStep3.classList.remove('none');
    });

    backButton1.addEventListener('click', function () {
        formStep2.classList.add('none');
        formStep1.classList.remove('none');
    });

    backButton2.addEventListener('click', function () {
        formStep3.classList.add('none');
        formStep2.classList.remove('none');
    });

    // Profile Picture Preview and Loading
    const profilePictureInput = document.getElementById('profile_picture');
    const imagePreview = document.getElementById('imagePreview');
    const loading = document.getElementById('loading');

    profilePictureInput.addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();

            reader.onloadstart = function () {
                loading.style.display = 'block';
            };

            reader.onload = function (e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
                loading.style.display = 'none';
            };

            reader.readAsDataURL(file);
        }
    });

    // Valid ID Preview and Loading
    const validIdInput = document.getElementById('valid_id');
    const idPreview = document.getElementById('idPreview');
    const idLoading = document.getElementById('idLoading');

    validIdInput.addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();

            reader.onloadstart = function () {
                idLoading.style.display = 'block';
            };

            reader.onload = function (e) {
                idPreview.src = e.target.result;
                idPreview.style.display = 'block';
                idLoading.style.display = 'none';
            };

            reader.readAsDataURL(file);
        }
    });

    registerForm.addEventListener('submit', function () {
        loading.style.display = 'block';
        idLoading.style.display = 'block';
    });

    // Password match validation
    document.getElementById('registerForm').addEventListener('submit', function (event) {
        const password = document.getElementById('password').value;
        const passwordConfirmation = document.getElementById('password_confirmation').value;

        if (password !== passwordConfirmation) {
            alert('Passwords do not match!');
            event.preventDefault(); // Prevent form submission
        }
    });
});

                </script>
                
                
                <script src="assets/js/main.js"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const loginForm = document.getElementById('loginForm');
                        const registerForm = document.getElementById('registerForm');
                        const signUpBtn = document.getElementById('sign-up');
                        const signInBtn = document.getElementById('sign-in');
                
                        // Show registration form when 'Sign Up' is clicked
                        signUpBtn.addEventListener('click', function () {
                            loginForm.classList.add('none');
                            registerForm.classList.remove('none');
                        });
                
                        // Show login form when 'Sign In' is clicked
                        signInBtn.addEventListener('click', function () {
                            registerForm.classList.add('none');
                            loginForm.classList.remove('none');
                        });
                
                        // Password match validation
                        registerForm.addEventListener('submit', function (event) {
                            const password = document.getElementById('password').value;
                            const passwordConfirmation = document.getElementById('password_confirmation').value;
                
                            if (password !== passwordConfirmation) {
                                alert('Passwords do not match!');
                                event.preventDefault(); // Prevent form submission
                            }
                        });
                    });

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

                </script>
                