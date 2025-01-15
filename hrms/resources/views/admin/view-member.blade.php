@include('admin.sidenav')

<section class="home-section" style="width: calc(100% - 58px); overflow: auto;">
    <div class="container mt-5">
        
        <div class="resume-style">
            <div class="mt-4 text-center">
                <a href="{{ route('admin.verify-member.index') }}" class="btn btn-primary">Back to List</a>
            </div>
            <br>
            <!-- Profile Header Section -->
            <div class="profile-header text-center">
                <img src="{{ $member->profile_picture ? asset('storage/' . $member->profile_picture) : asset('storage/profile_pictures/3135715.png') }}" 
                class="profile-picture rounded-circle" 
                alt="Profile Picture">
                           <h2>{{ $member->given_name }} {{ $member->surname }}</h2>
                <p class="text-muted">Application Date: {{ $member->created_at->format('F j, Y') }}</p>
            </div>

            <!-- Profile Body Section -->
            <div class="profile-body mt-4">
                <!-- Personal Information Section -->
                <div class="resume-section">
                    <h4>Personal Information</h4>
                    <hr>
                    <p><strong>Date of Birth:</strong> {{ $member->date_of_birth }}</p>
                    <p><strong>Address:</strong> {{ $member->address }}</p>
                </div>

                <!-- Contact Details Section -->
                <div class="resume-section mt-4">
                    <h4>Contact Details</h4>
                    <hr>
                    <p><strong>Email:</strong> {{ $member->email }}</p>
                    <p><strong>Contact Number:</strong> {{ $member->contact_number }}</p>
                </div>

                <!-- Valid ID Section -->
                <div class="resume-section mt-4">
                    <h4>Valid ID</h4>
                    <hr>
                    <div class="text-center">
                        <img src="{{ asset('storage/' . $member->valid_id) }}" class="valid-id" alt="Valid ID">
                    </div>
                </div>

                <!-- Back Button -->

            </div>
        </div>
    </div>
</section>

<!-- Include jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<style>
    /* Resume Style Profile */
    .resume-style {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        max-width: 800px;
        margin: auto;
    }

    .profile-header {
        margin-bottom: 20px;
    }

    .profile-picture {
        width: 120px;
        height: 120px;
        object-fit: cover;
    }

    .profile-header h2 {
        margin-top: 15px;
        font-size: 24px;
        font-weight: bold;
    }

    .resume-section h4 {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .resume-section hr {
        margin: 10px 0;
    }

    .valid-id {
        max-width: 100%;
        height: auto;
        border: 1px solid #ddd;
        padding: 5px;
    }

    @media (max-width: 768px) {
        .resume-style {
            padding: 15px;
        }

        .profile-header h2 {
            font-size: 20px;
        }

        .resume-section h4 {
            font-size: 18px;
        }
    }
</style>
