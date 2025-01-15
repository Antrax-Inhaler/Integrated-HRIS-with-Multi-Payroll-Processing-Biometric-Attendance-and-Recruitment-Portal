<!-- educationalbackground.blade.php -->
@include('applicant.psdtopbar');
<style>
    .circle-button {
    position: fixed;
    right: 20px;
    bottom: 20px;
    width: 60px;
    height: 60px;
    border: none;
    border-radius: 50%;
    background-color: #3498db;
    color: white;
    font-size: 24px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    cursor: pointer;
    transition: background-color 0.3s;
}

.circle-button:hover {
    background-color: #2980b9;
}

/* Hidden Navigation Menu */
.nav-menu {
    display: none; /* Hide menu by default */
    position: fixed;
    bottom: 90px; /* Adjust this value based on the circle button */
    right: 20px;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    border-radius: 15px;
    overflow: hidden;
    z-index: 1000;
}

.nav-menu button {
    background: none;
    border: none;
    padding: 15px 20px;
    margin: 0;
    font-size: 16px;
    cursor: pointer;
    border-bottom: 1px solid #ddd;
    transition: background-color 0.3s;
}

.nav-menu button:last-child {
    border-bottom: none; /* Remove border for the last button */
}

.nav-menu button:hover {
    background-color: #f0f0f0;
}

/* Make the Nav Menu Visible when Active */
.nav-menu.active {
    display: flex;
    flex-direction: column;
}

/* Styles for the Circle Button and Navigation Menu */
.nav-menu.rounded {
    border-radius: 30px; /* Make the nav menu round */
}
</style>
<h1>Educational Background</h1>

<button id="schoolButton" class="circle-button">
    <i class="fas fa-school"></i>
</button>

<!-- Horizontal Navigation Bar -->
<nav id="navMenu" class="nav-menu">
    <button onclick="scrollToSection('elementary')">Elementary</button>
    <button onclick="scrollToSection('secondary')">Secondary</button>
    <button onclick="scrollToSection('vocational')">Vocational</button>
    <button onclick="scrollToSection('college')">College</button>
    <button onclick="scrollToSection('graduate-studies')">Graduate Studies</button>
</nav>
<!-- Elementary Education Form -->
<section id="elementary" class="form-section">
    <h3 style="section-title">Elementary Education</h3>
    <form method="POST" action="/applicant/educational-background">
        @csrf
        <input type="hidden" name="level" value="Elementary">
        
        <div class="form-group">
            <label>School Name:</label>
            <input type="text" name="school_name" value="{{ $groupedBackgrounds['Elementary']->school_name ?? '' }}">
        </div>

        <div class="form-group">
            <label>Period of Attendance From:</label>
            <input type="text" name="period_of_attendance_from" value="{{ $groupedBackgrounds['Elementary']->period_of_attendance_from ?? '' }}">
        </div>

        <div class="form-group">
            <label>Period of Attendance To:</label>
            <input type="text" name="period_of_attendance_to" value="{{ $groupedBackgrounds['Elementary']->period_of_attendance_to ?? '' }}">
        </div>

        <div class="form-group">
            <label>Year Graduated:</label>
            <input type="text" name="year_graduated" value="{{ $groupedBackgrounds['Elementary']->year_graduated ?? '' }}">
        </div>

        <div class="form-group">
            <label>Honors Received:</label>
            <input type="text" name="honors_received" value="{{ $groupedBackgrounds['Elementary']->honors_received ?? '' }}">
        </div>

        <button type="submit" class="submit-button">Save</button>
    </form>
</section>

<!-- Secondary Education Form -->
<section id="secondary" class="form-section">
    <h3 style="section-title" >Secondary Education</h3>
    <form method="POST" action="/applicant/educational-background">
        @csrf
        <input type="hidden" name="level" value="Secondary">
        
        <div class="form-group">
            <label>School Name:</label>
            <input type="text" name="school_name" value="{{ $groupedBackgrounds['Secondary']->school_name ?? '' }}">
        </div>

        <div class="form-group">
            <label>Period of Attendance From:</label>
            <input type="text" name="period_of_attendance_from" value="{{ $groupedBackgrounds['Secondary']->period_of_attendance_from ?? '' }}">
        </div>

        <div class="form-group">
            <label>Period of Attendance To:</label>
            <input type="text" name="period_of_attendance_to" value="{{ $groupedBackgrounds['Secondary']->period_of_attendance_to ?? '' }}">
        </div>

        <div class="form-group">
            <label>Year Graduated:</label>
            <input type="text" name="year_graduated" value="{{ $groupedBackgrounds['Secondary']->year_graduated ?? '' }}">
        </div>

        <div class="form-group">
            <label>Honors Received:</label>
            <input type="text" name="honors_received" value="{{ $groupedBackgrounds['Secondary']->honors_received ?? '' }}">
        </div>

        <button type="submit" class="submit-button">Save</button>
    </form>
</section>

<!-- Vocational Education Form -->
<section id="vocational" class="form-section">
    <h3 style="section-title">Vocational Education</h3>
    <form method="POST" action="/applicant/educational-background">
        @csrf
        <input type="hidden" name="level" value="Vocational">
        
        <div class="form-group">
            <label>School Name:</label>
            <input type="text" name="school_name" value="{{ $groupedBackgrounds['Vocational']->school_name ?? '' }}">
        </div>

        <div class="form-group">
            <label>Period of Attendance From:</label>
            <input type="text" name="period_of_attendance_from" value="{{ $groupedBackgrounds['Vocational']->period_of_attendance_from ?? '' }}">
        </div>

        <div class="form-group">
            <label>Period of Attendance To:</label>
            <input type="text" name="period_of_attendance_to" value="{{ $groupedBackgrounds['Vocational']->period_of_attendance_to ?? '' }}">
        </div>

        <div class="form-group">
            <label>Course Name:</label>
            <input type="text" name="course_name" value="{{ $groupedBackgrounds['Vocational']->course_name ?? '' }}">
        </div>

        <div class="form-group">
            <label>Year Graduated:</label>
            <input type="text" name="year_graduated" value="{{ $groupedBackgrounds['Vocational']->year_graduated ?? '' }}">
        </div>

        <div class="form-group">
            <label>Highest Level/Units Earned:</label>
            <input type="text" name="highest_level_units_earned" value="{{ $groupedBackgrounds['Vocational']->highest_level_units_earned ?? '' }}">
        </div>

        <div class="form-group">
            <label>Honors Received:</label>
            <input type="text" name="honors_received" value="{{ $groupedBackgrounds['Vocational']->honors_received ?? '' }}">
        </div>

        <button type="submit" class="submit-button">Save</button>

    </form>
</section>

<!-- College Education Form -->
<section id="college" class="form-section">
    <h3 style="section-title">College Education</h3>
    <form method="POST" action="/applicant/educational-background">
        @csrf
        <input type="hidden" name="level" value="College">
        
        <div class="form-group">
            <label>School Name:</label>
            <input type="text" name="school_name" value="{{ $groupedBackgrounds['College']->school_name ?? '' }}">
        </div>

        <div class="form-group">
            <label>Period of Attendance From:</label>
            <input type="text" name="period_of_attendance_from" value="{{ $groupedBackgrounds['College']->period_of_attendance_from ?? '' }}">
        </div>

        <div class="form-group">
            <label>Period of Attendance To:</label>
            <input type="text" name="period_of_attendance_to" value="{{ $groupedBackgrounds['College']->period_of_attendance_to ?? '' }}">
        </div>

        <div class="form-group">
            <label>Course Name:</label>
            <input type="text" name="course_name" value="{{ $groupedBackgrounds['College']->course_name ?? '' }}">
        </div>

        <div class="form-group">
            <label>Year Graduated:</label>
            <input type="text" name="year_graduated" value="{{ $groupedBackgrounds['College']->year_graduated ?? '' }}">
        </div>

        <div class="form-group">
            <label>Highest Level/Units Earned:</label>
            <input type="text" name="highest_level_units_earned" value="{{ $groupedBackgrounds['College']->highest_level_units_earned ?? '' }}">
        </div>

        <div class="form-group">
            <label>Honors Received:</label>
            <input type="text" name="honors_received" value="{{ $groupedBackgrounds['College']->honors_received ?? '' }}">
        </div>

        <button type="submit" class="submit-button">Save</button>
    </form>
</section>

<!-- Graduate Studies Education Form -->
<section id="graduate-studies" class="form-section">
    <h3 style="section-title">Graduate Studies Education</h3>
    <form method="POST" action="/applicant/educational-background">
        @csrf
        <input type="hidden" name="level" value="Graduate Studies">
        
        <div class="form-group">
            <label>School Name:</label>
            <input type="text" name="school_name" value="{{ $groupedBackgrounds['Graduate Studies']->school_name ?? '' }}">
        </div>

        <div class="form-group">
            <label>Period of Attendance From:</label>
            <input type="text" name="period_of_attendance_from" value="{{ $groupedBackgrounds['Graduate Studies']->period_of_attendance_from ?? '' }}">
        </div>

        <div class="form-group">
            <label>Period of Attendance To:</label>
            <input type="text" name="period_of_attendance_to" value="{{ $groupedBackgrounds['Graduate Studies']->period_of_attendance_to ?? '' }}">
        </div>

        <div class="form-group">
            <label>Course Name:</label>
            <input type="text" name="course_name" value="{{ $groupedBackgrounds['Graduate Studies']->course_name ?? '' }}">
        </div>

        <div class="form-group">
            <label>Year Graduated:</label>
            <input type="text" name="year_graduated" value="{{ $groupedBackgrounds['Graduate Studies']->year_graduated ?? '' }}">
        </div>

        <div class="form-group">
            <label>Highest Level/Units Earned:</label>
            <input type="text" name="highest_level_units_earned" value="{{ $groupedBackgrounds['Graduate Studies']->highest_level_units_earned ?? '' }}">
        </div>

        <div class="form-group">
            <label>Honors Received:</label>
            <input type="text" name="honors_received" value="{{ $groupedBackgrounds['Graduate Studies']->honors_received ?? '' }}">
        </div>

        <button type="submit" class="submit-button">Save</button>
    </form>
</section>

<script>
function scrollToSection(sectionId) {
    document.getElementById(sectionId).scrollIntoView({ behavior: 'smooth' });
}
</script>

<style>
.form-section {
    margin-bottom: 50px;
}
nav button {
    margin-right: 10px;
    cursor: pointer;
}
</style>
<div class="navigation-buttons">
    <button id="back-button" class="nav-button" onclick="goBack()">Back</button>
    <button id="next-button" class="nav-button" onclick="goNext()">Next</button>
</div>

</div>
</body>
<script>
    function goBack() {
        // Navigate to the specified back URL
        window.location.href = '/applicant/reference2'; // Replace with the actual URL
    }
    
    function goNext() {
        // Navigate to the specified next URL
        window.location.href = '/applicant/civilserviceeligibility'; // Replace with the actual URL
    }

    // Get the button and navigation menu elements
const schoolButton = document.getElementById('schoolButton');
const navMenu = document.getElementById('navMenu');

// Toggle navigation menu visibility on button click
schoolButton.addEventListener('click', function() {
    navMenu.classList.toggle('active');
    navMenu.classList.toggle('rounded'); // Toggle rounded borders
});

// Scroll to section function (for demonstration purposes)

    </script>
    
</html>