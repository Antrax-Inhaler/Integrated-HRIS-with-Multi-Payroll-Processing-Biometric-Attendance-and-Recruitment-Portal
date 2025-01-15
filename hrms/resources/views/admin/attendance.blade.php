@include('admin.sidenav')
<section class="home-section" style="width: calc(100% - 58px); overflow:scroll">

<style>

    .card-container {
        flex: 1;
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        max-width: 300px;
    }
    .container{
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        gap: 20px;
    }
    .table-container{
        width: 100%;
    }

</style>
<h2>Attendance Management</h2>
<div class="container mt-5">
    <form action="{{ route('admin.attendance.index') }}" method="GET" class="form-inline mb-3">
        <!-- Member Filter -->
        <div class="form-group mr-2">
            <label for="member_id">Employee:</label>
            <select name="member_id" id="member_id" class="form-control ml-2">
                <option value="">All</option>
                @foreach($members as $member)
                    <option value="{{ $member->id }}" 
                        {{ $selectedMember == $member->id ? 'selected' : '' }}>
                        {{ $member->surname }}, {{ $member->given_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Date Range Filters -->
        <div class="form-group mr-2">
            <label for="start_date">Start Date:</label>
            <input type="date" name="start_date" id="start_date" 
                   class="form-control ml-2" value="{{ $startDate }}">
        </div>

        <div class="form-group mr-2">
            <label for="end_date">End Date:</label>
            <input type="date" name="end_date" id="end_date" 
                   class="form-control ml-2" value="{{ $endDate }}">
        </div>

        <!-- Filter Button -->
        <button type="submit" class="btn btn-primary">Filter</button>
        
        <!-- Reset Button -->
        <a href="{{ route('admin.attendance.index') }}" class="btn btn-secondary ml-2">Reset</a>
    </form>
    <div class="table-container">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Employee</th>
                <th>Log Type</th>
                <th>Date & Time</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($attendance as $record)
                <tr>
                    <td>{{ $record->id }}</td>
                    <td>{{ $record->member->surname }}, {{ $record->member->given_name }}</td>
                    <td>{{ $record->log_type }}</td>
                    <td>{{ $record->datetime_log }}</td>
                    <td>
                        <!-- Trigger Edit Modal -->
                        <button class="btn btn-primary btn-sm" data-toggle="modal" 
                                data-target="#editAttendanceModal{{ $record->id }}">
                            Edit
                        </button>

                        <!-- Trigger Delete Confirmation Modal -->
                        <button class="btn btn-danger btn-sm" 
                                onclick="confirmDelete({{ $record->id }})">Delete</button>
                    </td>
                </tr>

                <!-- Edit Attendance Modal -->
                <div class="modal fade" id="editAttendanceModal{{ $record->id }}" tabindex="-1" role="dialog" 
                     aria-labelledby="editModalLabel{{ $record->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $record->id }}">Edit Attendance</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('attendance.update', $record->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="modal-body">
                                    <!-- Employee -->
                                    <div class="form-group">
                                        <label for="member_id_{{ $record->id }}">Employee</label>
                                        <select class="form-control" id="member_id_{{ $record->id }}" 
                                                name="member_id" required>
                                            @foreach($members as $member)
                                                <option value="{{ $member->id }}" 
                                                    @if($record->member_id == $member->id) selected @endif>
                                                    {{ $member->employee_no }} - 
                                                    {{ $member->surname }}, {{ $member->given_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Log Type -->
                                    <div class="form-group">
                                        <label for="log_type_{{ $record->id }}">Log Type</label>
                                        <select class="form-control" id="log_type_{{ $record->id }}" 
                                                name="log_type" required>
                                            <option value="AM IN" @if($record->log_type == 'AM IN') selected @endif>AM IN</option>
                                            <option value="AM OUT" @if($record->log_type == 'AM OUT') selected @endif>AM OUT</option>
                                            <option value="PM IN" @if($record->log_type == 'PM IN') selected @endif>PM IN</option>
                                            <option value="PM OUT" @if($record->log_type == 'PM OUT') selected @endif>PM OUT</option>
                                        </select>
                                    </div>

                                    <!-- Date & Time -->
                                    <div class="form-group">
                                        <label for="datetime_log_{{ $record->id }}">Date & Time</label>
                                        <input type="datetime-local" class="form-control" 
                                               id="datetime_log_{{ $record->id }}" name="datetime_log" 
                                               value="{{ \Carbon\Carbon::parse($record->datetime_log)->format('Y-m-d\TH:i') }}" 
                                               required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Update Attendance</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Add Attendance Form -->
    <div class="card-container p-4 shadow rounded mt-5">
        <h3 class="text-center mb-4">Add Attendance</h3>
        <form action="{{ route('attendance.store') }}" method="POST">
            @csrf
            <!-- Employee -->
            <div class="form-group">
                <label for="member_id">Employee</label>
                <select class="form-control custom-select" id="member_id" name="member_id" required>
                    @foreach($members as $member)
                        <option value="{{ $member->id }}">
                            {{ $member->employee_no }} - {{ $member->surname }}, 
                            {{ $member->given_name }} {{ $member->middle_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Log Type -->
            <div class="form-group">
                <label for="log_type">Log Type</label>
                <select class="form-control" id="log_type" name="log_type" required>
                    <option value="AM IN">AM IN</option>
                    <option value="AM OUT">AM OUT</option>
                    <option value="PM IN">PM IN</option>
                    <option value="PM OUT">PM OUT</option>
                </select>
            </div>

            <!-- Date & Time -->
            <div class="form-group">
                <label for="datetime_log">Date & Time</label>
                <input type="datetime-local" class="form-control" id="datetime_log" name="datetime_log" required>
            </div>

            <button type="submit" class="btn btn-success w-100">Add Attendance</button>
        </form>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" 
         aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this attendance record?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(recordId) {
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = `/attendance/${recordId}`;
        $('#deleteConfirmationModal').modal('show');
    }
</script>

    <style>
        /* Card Container Style */
        .card-container {
            max-width: 600px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
        }
    
        /* Custom Select Style */
        .custom-select option {
            display: flex;
            align-items: center;
        }
    
        /* Profile Picture in Select Option */
        .profile-pic {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;
        }
    
        /* Verified Icon in Select Option */
        .verified-icon {
            width: 16px;
            height: 16px;
            margin-right: 5px;
        }
    
        /* Form Group Styling */
        .form-group {
            margin-bottom: 15px;
        }
    
        /* Button Styling */
        .btn {
            border-radius: 4px;
        }
    
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }
    
        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
    
        /* Media Query for Smaller Screens */
        @media (max-width: 576px) {
            .profile-pic {
                width: 24px;
                height: 24px;
            }
        }
    </style>
    
</div>

</section>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
