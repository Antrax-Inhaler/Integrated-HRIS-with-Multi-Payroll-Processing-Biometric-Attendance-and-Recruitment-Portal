{{-- resources\views\applicant\login.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/ribbon.css">
    <link rel="icon" href="/img/dalogo.png" type="icon">

    <!-- ===== CSS ===== -->    
    <!-- ===== BOX ICONS ===== -->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

    <title>HRMS | Login / Signup</title>
    <link rel="icon" href="/img/dalogo.png" type="icon">

    <style>
        /* General body styles */
        body {
            background-color: #f7f9fc;
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
        }

        .header .button i {
            margin-right: 8px;
            font-size: 20px;
        }

        .header .button:hover {
            background-color: #45a049;
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
            border-color: #4caf50;
            background-color: #fff;
        }

        /* Icon inside input */
        .login__icon {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: #4caf50;
            font-size: 20px;
        }

        /* Forgot password link */
        .login__forgot {
            display: block;
            text-align: right;
            margin-bottom: 20px;
            color: #4caf50;
            text-decoration: none;
            font-size: 14px;
        }

        .login__forgot:hover {
            text-decoration: underline;
        }

        /* Button styles */
        .button {
            width: 100%;
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

        .button:hover {
            background-color: #45a049;
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

        .login__signin, .login__signup {
            color: #4caf50;
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
    </style>
</head>
<body>
    <div class="login">
        <div class="ribbon">
            <span class="ribbon4" style="display: flex;">
                <i class="bx bx-user"></i> <span> Applicant</span> 
            </span>
        </div>
        
                <div class="login__content">
            <div class="login__forms">
                <!-- Login Form -->
                <form action="{{ route('applicant.login') }}" method="POST" class="login__registre" id="loginForm">
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

                <!-- Registration Form -->
                <form action="{{ route('applicant.register') }}" method="POST" class="login__create none" id="registerForm">
                    @csrf
                    <h1 class="login__title">Create Account</h1>

                    <div class="login__box">
                        <i class='bx bx-user login__icon'></i>
                        <input type="text" name="name" required placeholder="Fullname" class="login__input">
                    </div>

                    <div class="login__box">
                        <i class='bx bx-at login__icon'></i>
                        <input type="email" name="email" required placeholder="Email" class="login__input">
                    </div>
                    <div class="login__box">
                        <i class='bx bx-phone login__icon'></i>
                        <input type="text" name="contact_number" placeholder="Contact" required class="login__input">
                    </div>

                    <div class="login__box">
                        <i class='bx bx-lock-alt login__icon'></i>
                        <input type="password" name="password" required placeholder="Password" class="login__input">
                    </div>

                    <div class="login__box">
                        <i class='bx bx-lock-alt login__icon'></i>
                        <input type="password" name="password_confirmation" required placeholder="Verify Password" class="login__input">
                    </div>

                    <button class="button" type="submit">
                        <span class="button-content">Register</span>
                    </button>

                    <div>
                        <span class="login__account">Already have an Account?</span>
                        <span class="login__signup" id="sign-in">Sign In</span>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--===== MAIN JS =====-->
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

        // Optional error handling for AJAX form submission
        const showError = (message) => {
            alert(message); // You can customize this to show error messages within the form
        };

        // Example usage of showError
        // showError('Invalid email or password');
        // showError('Passwords do not match');
    });
    </script>
</body>
</html>