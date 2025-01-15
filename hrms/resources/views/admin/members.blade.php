{{-- views\admin\members.blade.php --}}
@include('admin.sidenav');
<section class="home-section" style="width: calc(100% - 58px);overflow:scroll">

<style>

#loading_spinner {
    text-align: center;
    margin-top: 10px;
}

#image_preview {
    border-radius: 50%;
    margin-top: 10px;
    width: 100px;
    height: 100px;
}

</style>
<div class="container mt-5">


    <h2>Employee Management</h2>
    <form action="{{ route('admin.index') }}" method="GET">
        <div class="row mb-3">
            <!-- Search Field -->
            <div class="col-md-3">
                <input type="text" name="search" class="form-control" placeholder="Search by name" value="{{ request('search') }}">
            </div>
    
            <!-- Position Filter Dropdown -->
            <div class="col-md-3">
                <select name="position" class="form-control">
                    <option value="">All Positions</option>
                    @foreach($positions as $position)
                        <option value="{{ $position }}" {{ request('position') == $position ? 'selected' : '' }}>{{ $position }}</option>
                    @endforeach
                </select>
            </div>
    
            <!-- Department Filter Dropdown -->
            <div class="col-md-3">
                <select name="department" class="form-control">
                    <option value="">All Departments</option>
                    @foreach($departments as $department)
                        <option value="{{ $department }}" {{ request('department') == $department ? 'selected' : '' }}>{{ $department }}</option>
                    @endforeach
                </select>
            </div>
    
            <!-- Filter Button -->
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>
    
    
    <!-- Button to trigger add member modal -->
    <button class="btn btn-success mb-3" data-toggle="modal" data-target="#addMemberModal">Add Employee</button>
    <br>
    <br>
    
    <!-- Members Table -->
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Profile Picture</th>
            <th>Surname</th>
            <th>Given Name</th>
            <th>Middle Name</th>
            <th>Email</th>
            <th>Contact Number</th>
            <th>Position</th>
            <th>Department</th>
            <th>Is Verified</th>
            <th>Valid ID</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Fingerprint ID</th>
            <th>Employment Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($members as $member)
            <tr>
                <td>{{ $member->id }}</td>
                <td>
                    <img src="{{ $member->profile_picture ? asset('storage/' . $member->profile_picture) : asset('storage/profile_pictures/3135715.png') }}" 
                         alt="Profile Picture" 
                         style="width: 50px; height: 50px; border-radius: 50%;" />
                </td>
                <td>{{ $member->surname }}</td>
                <td>{{ $member->given_name }}</td>
                <td>{{ $member->middle_name }}</td>
                <td>{{ $member->email }}</td>
                <td>{{ $member->contact_number }}</td>
                <td>{{ $member->position ? $member->position->position_name : 'N/A' }}</td>
                <td>{{ $member->department ? $member->department->department_name : 'N/A' }}</td>
                
                
                
                <td>{{ $member->is_verified ? 'Yes' : 'No' }}</td>
                <td>
                    @if($member->valid_id)
                        <a href="{{ asset('storage/' . $member->valid_id) }}" target="_blank">View ID</a>
                    @else
                        N/A
                    @endif
                </td>
                <td>{{ $member->created_at ? $member->created_at->format('Y-m-d H:i:s') : 'N/A' }}</td>
                <td>{{ $member->updated_at ? $member->updated_at->format('Y-m-d H:i:s') : 'N/A' }}</td>
                <td>{{ $member->fingerprint_id ?? 'N/A' }}</td>
                <td>{{ ucfirst($member->employment_status) }}</td>
                <td>
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editMemberModal{{ $member->id }}">Edit</button>
                    <form action="{{ url('/admin/members/delete', $member->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>

            <!-- Edit Member Modal -->
            <div class="modal fade" id="editMemberModal{{ $member->id }}" tabindex="-1" role="dialog" aria-labelledby="editMemberModalLabel{{ $member->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editMemberModalLabel{{ $member->id }}">Edit Member</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ url('/admin/members/update', $member->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="form-group">
                                    <label for="editProfilePicture{{ $member->id }}">Profile Picture</label>
                                    <input type="file" class="form-control-file" id="editProfilePicture{{ $member->id }}" name="profile_picture" accept="image/*">
                                    <img id="editPreviewImage{{ $member->id }}" src="#" alt="Profile Picture Preview" class="img-thumbnail mt-2" style="display:none; width: 100px; height: 100px; border-radius: 50%;">
                                    <div id="editLoadingSpinner{{ $member->id }}" style="display:none; text-align: center;">
                                        <img src="/img/loading.gif" alt="Loading" style="width: 50px; height: 50px;">
                                    </div>
                                </div>                                
                                <!-- Surname -->
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bx bx-user"></i> <!-- Changed icon class -->
                                        </span>
                                        <input type="text" class="form-control" name="surname" placeholder="Surname" value="{{ $member->surname }}" required>
                                    </div>
                                </div>
                                <!-- Given Name -->
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bx bx-user"></i> <!-- Changed icon class -->
                                        </span>
                                        <input type="text" class="form-control" name="given_name" placeholder="Given Name" value="{{ $member->given_name }}" required>
                                    </div>
                                </div>
                                <!-- Middle Name -->
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bx bx-user"></i> <!-- Changed icon class -->
                                        </span>
                                        <input type="text" class="form-control" name="middle_name" placeholder="Middle Name" value="{{ $member->middle_name }}">
                                    </div>
                                </div>
                                <!-- Email -->
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bx bx-envelope"></i> <!-- Changed icon class -->
                                        </span>
                                        <input type="email" class="form-control" name="email" placeholder="Email" value="{{ $member->email }}" required>
                                    </div>
                                </div>
                                <!-- Contact Number -->
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bx bx-phone"></i> <!-- Changed icon class -->
                                        </span>
                                        <input type="text" class="form-control" name="contact_number" placeholder="Contact Number" value="{{ $member->contact_number }}" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bx bx-phone"></i> <!-- Changed icon class -->
                                        </span>
                                        <input type="number" class="form-control" name="fingerprint_id" placeholder="Fingerprint ID" value="{{ $member->fingerprint_id }}" required>
                                    </div>
                                </div>
                              <!-- Position -->
<div class="form-group">
    <label for="position">Position</label>
    <div class="input-group">
        <span class="input-group-text"></span>
        <select name="position" id="position" class="form-control">
            <option value="" disabled selected>Select Position</option>
            @foreach ($positions as $position)
                <option value="{{ $position->id }}" 
                    {{ $member->position == $position->id ? 'selected' : '' }}>
                    {{ $position->position_name }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<!-- Department -->
<div class="form-group">
    <label for="department">Department</label>
    <div class="input-group">
        <span class="input-group-text"></span>
        <select name="department" id="department" class="form-control">
            <option value="" disabled selected>Select Department</option>
            @foreach ($departments as $department)
                <option value="{{ $department->id }}" 
                    {{ $member->department == $department->id ? 'selected' : '' }}>
                    {{ $department->department_name }}
                </option>
            @endforeach
        </select>
    </div>
</div>

                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </form>                                                
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </tbody>
    </table>
</div>

<!-- Add Member Modal -->
<div class="modal fade" id="addMemberModal" tabindex="-1" role="dialog" aria-labelledby="addMemberModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMemberModalLabel">Add Member</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('/admin/members/store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="profilePicture">Profile Picture</label>
                        <input type="file" class="form-control-file" id="profilePicture" name="profile_picture" accept="image/*">
                        <img id="previewImage" src="#" alt="Profile Picture Preview" class="img-thumbnail mt-2" style="display:none; width: 100px; height: 100px; border-radius: 50%;">
                        <div id="loadingSpinner" style="display:none; text-align: center;">
                            <img src="/img/loading.gif" alt="Loading" style="width: 50px; height: 50px;">
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label for="surname">Surname</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bx bx-user"></i> <!-- User icon -->
                            </span>
                            <input type="text" class="form-control" name="surname" placeholder="Surname" required>
                        </div>
                    </div>
                
                    <!-- Given Name -->
                    <div class="form-group">
                        <label for="given_name">Given Name</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bx bx-user"></i> <!-- User icon -->
                            </span>
                            <input type="text" class="form-control" name="given_name" placeholder="Given Name" required>
                        </div>
                    </div>
                
                    <!-- Middle Name -->
                    <div class="form-group">
                        <label for="middle_name">Middle Name</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bx bx-user"></i> <!-- User icon -->
                            </span>
                            <input type="text" class="form-control" name="middle_name" placeholder="Middle Name">
                        </div>
                    </div>
                
                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bx bx-envelope"></i> <!-- Envelope icon -->
                            </span>
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>
                    </div>
                
                    <!-- Password -->
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bx bx-lock"></i> <!-- Lock icon -->
                            </span>
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
                
                    <!-- Contact Number -->
                    <div class="form-group">
                        <label for="contact_number">Contact Number</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bx bx-phone"></i> <!-- Phone icon -->
                            </span>
                            <input type="text" class="form-control" name="contact_number" placeholder="Contact Number" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bx bx-phone"></i> <!-- Changed icon class -->
                            </span>
                            <input type="number" class="form-control" name="fingerprint_id" placeholder="Fingerprint ID" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="position">Position</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bx bx-briefcase"></i> <!-- Icon for position -->
                            </span>
                            <select id="position" class="form-control" name="position">
                                @foreach($positions as $position)
                                    <option value="{{ $position->name }}" {{ $position->id == $member->position ? 'selected' : '' }}>
                                        {{ $position->position_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <!-- Department -->
                    <div class="form-group">
                        <label for="department">Department</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bx bx-building-house"></i> <!-- Icon for department -->
                            </span>
                            <select id="department" class="form-control" name="department">
                                @foreach($departments as $department)
                                    <option value="{{ $department->name }}" {{ $department->id == $member->department ? 'selected' : '' }}>
                                        {{ $department->department_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-success">Add Employee</button>
                </form>                
            </div>
        </div>
    </div>
</div>
</section>
<script>
    document.getElementById('profilePicture').addEventListener('change', function (e) {
        let reader = new FileReader();
        let loadingSpinner = document.getElementById('loadingSpinner');
        let previewImage = document.getElementById('previewImage');

        // Show the loading spinner
        loadingSpinner.style.display = 'block';
        previewImage.style.display = 'none';

        reader.onload = function (e) {
            previewImage.src = e.target.result;
            previewImage.style.display = 'block';
            loadingSpinner.style.display = 'none'; // Hide the loading spinner
        }
        reader.readAsDataURL(e.target.files[0]);
    });

    @foreach($members as $member)
    document.getElementById('editProfilePicture{{ $member->id }}').addEventListener('change', function (e) {
        let reader = new FileReader();
        let loadingSpinner = document.getElementById('editLoadingSpinner{{ $member->id }}');
        let previewImage = document.getElementById('editPreviewImage{{ $member->id }}');

        // Show the loading spinner
        loadingSpinner.style.display = 'block';
        previewImage.style.display = 'none';

        reader.onload = function (e) {
            previewImage.src = e.target.result;
            previewImage.style.display = 'block';
            loadingSpinner.style.display = 'none'; // Hide the loading spinner
        }
        reader.readAsDataURL(e.target.files[0]);
    });
    @endforeach


</script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
