@include('admin.sidenav');
<section class="home-section" style="width: calc(100% - 58px); overflow:scroll">

<div class="container mt-5">
    <h2>Admin Profile</h2>

    <!-- Display success message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Profile Form -->
    <form action="{{ route('admin.profile.update') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="profile_picture">Profile Picture</label>
            <div>
                <img id="profilePicturePreview" 
                     src="{{ $admin->profile_picture ? asset('storage/' . $admin->profile_picture) : asset('default-profile.png') }}" 
                     alt="Profile Picture" 
                     style="max-width: 150px; max-height: 150px; border-radius: 50%;">
            </div>
            <input type="file" class="form-control-file mt-2" id="profile_picture" name="profile_picture" accept="image/*" onchange="previewProfilePicture(event)">
        </div>

        <!-- Name -->
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $admin->name }}" required>
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $admin->email }}" required>
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password">New Password (Leave blank to keep current password)</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
            <label for="password_confirmation">Confirm New Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
<script>
    // Preview Profile Picture
    function previewProfilePicture(event) {
        const output = document.getElementById('profilePicturePreview');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    }
</script>
</section>