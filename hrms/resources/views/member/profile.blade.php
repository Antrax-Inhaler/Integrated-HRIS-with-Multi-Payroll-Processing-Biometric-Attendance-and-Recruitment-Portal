@include('member.sidenav')
<style>
    /* Overall styling */
#profileForm {
    width: 100%;
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
}

h4 {
    text-align: center;
    margin-bottom: 20px;
}

.label {
    font-weight: bold;
    display: block;
    margin-bottom: 10px;
}

.input-field {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 2px solid #ddd;
    border-radius: 8px;
    transition: border-color 0.3s ease;
}

.input-field:focus {
    outline: none;
}

.profile-picture-container {
    text-align: center;
    margin-bottom: 20px;
}

.profile-picture-container img {
    border-radius: 50%;
    width: 150px;
    height: 150px;
    object-fit: cover;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.profile-picture-container img:hover {
    transform: scale(1.05);
}

.profile-picture-container input[type="file"] {
    margin-top: 10px;
    cursor: pointer;
}

.password-section {
    margin-top: 30px;
    padding-top: 20px;
    border-top: 2px solid #ddd;
}

.password-hint {
    font-size: 12px;
    color: #888;
    margin-top: 5px;
}

.btn-submit {
    display: block;
    width: 100%;
    color: white;
    padding: 15px;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}



/* Input Validation Indicator */
.input-field:invalid {
    border-color: #ff6b6b;
}

input[type="password"]:invalid ~ .password-hint {
    color: #ff6b6b;
}
#valid_id_preview{
    border-radius: 0px;
    width: 200px
}
</style>

<section class="home-section" style="width: calc(100% - 58px);overflow:scroll">
    <form action="{{ route('member.profile.update') }}" method="POST" enctype="multipart/form-data" id="profileForm">
        @csrf
    
        <!-- Profile Picture -->
        <div class="form-group">
            <label for="profile_picture" class="label">Profile Picture</label>
            <div class="profile-picture-container">
                <img id="profile_preview" src="{{ $member->profile_picture ? asset('storage/' . $member->profile_picture) : 'https://via.placeholder.com/150' }}" alt="Profile Picture">
                <input type="file" name="profile_picture" id="profile_picture" accept="image/*" onchange="previewProfilePicture(event)" >
            </div>
        </div>
    
        <!-- Basic Information -->
        <div class="form-group">
            <label for="surname" class="label">Surname</label>
            <input type="text" name="surname" id="surname" value="{{ $member->surname }}" class="input-field" disabled>
        </div>
    
        <div class="form-group">
            <label for="given_name" class="label">Given Name</label>
            <input type="text" name="given_name" id="given_name" value="{{ $member->given_name }}" class="input-field" disabled>
        </div>
    
        <div class="form-group">
            <label for="middle_name" class="label">Middle Name</label>
            <input type="text" name="middle_name" id="middle_name" value="{{ $member->middle_name }}" class="input-field" disabled>
        </div>
    
        <!-- Fingerprint ID -->
        <div class="form-group">
            <label for="fingerprint_id" class="label">Fingerprint ID</label>
            <input type="text" name="fingerprint_id" id="fingerprint_id" value="{{ $member->fingerprint_id }}" class="input-field" disabled>
        </div>
    
        <!-- Valid ID Picture -->
        <div class="form-group">
            <label for="valid_id" class="label">Valid ID</label>
            <div class="profile-picture-container">
                <img id="valid_id_preview" src="{{ $member->valid_id ? asset('storage/' . $member->valid_id) : 'https://via.placeholder.com/150' }}" alt="Valid ID">
                <input type="file" name="valid_id" id="valid_id" accept="image/*" onchange="previewValidID(event)" >
            </div>
        </div>
    
        <!-- Salary -->
        <div class="form-group">
            <label for="salary" class="label">Salary</label>
            <input type="number" name="salary" id="salary" value="{{ $member->salary }}" class="input-field" disabled>
        </div>
    
        <!-- Department -->
        <div class="form-group">
            <label for="department" class="label">Department</label>
            <input type="text" name="department" id="department" value="{{ $member->department }}" class="input-field" disabled>
        </div>
    
        <!-- Position -->
        <div class="form-group">
            <label for="position" class="label">Position</label>
            <input type="text" name="position" id="position" value="{{ $member->position }}" class="input-field" disabled>
        </div>
    
        <!-- Password Change Section -->
        <div class="password-section">
            <h4 class="section-title">Change Password</h4>
            <div class="form-group">
                <label for="password" class="label">New Password</label>
                <input type="password" name="password" id="password" class="input-field">
                <div class="password-hint">Password must be at least 8 characters long, include at least one uppercase letter, one lowercase letter, one number, and one special character.</div>
            </div>
    
            <div class="form-group">
                <label for="password_confirmation" class="label">Confirm New Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="input-field">
            </div>
        </div>
    
        <button type="submit" class="btn-submit">Update Profile</button>
    </form>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const profilePreview = document.getElementById('profile_preview');
            const validIDPreview = document.getElementById('valid_id_preview');
            
            profilePreview.src = "{{ $member->profile_picture ? asset('storage/' . $member->profile_picture) : 'https://via.placeholder.com/150' }}";
            validIDPreview.src = "{{ $member->valid_id ? asset('storage/' . $member->valid_id) : 'https://via.placeholder.com/150' }}";
        });
    
        function previewProfilePicture(event) {
            const output = document.getElementById('profile_preview');
            output.src = URL.createObjectURL(event.target.files[0]);
        }
    
        function previewValidID(event) {
            const output = document.getElementById('valid_id_preview');
            output.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
    
</section>