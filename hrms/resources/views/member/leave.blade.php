@include('member.sidenav') <!-- Include member sidebar -->

<section class="home-section" style="width: calc(100% - 58px); overflow:scroll">
    <div class="container mt-5">
        <h2>Leave Management</h2>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
        <!-- Button to trigger add leave modal -->
        <button class="btn btn-success mb-3" data-toggle="modal" data-target="#addLeaveModal">Add Leave</button>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($leaves as $leave)
                <tr>
                    <td>{{ $leave->id }}</td>
                    <td>{{ $leave->status }}</td>
                    <td>
                        <!-- Edit button -->
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editLeaveModal{{ $leave->id }}">Edit</button>

                        <!-- Delete button to open confirmation modal -->
                        <button class="btn btn-danger btn-sm" data-toggle="modal" 
                            data-target="#confirmDeleteModal" 
                            data-leave-id="{{ $leave->id }}">
                            Delete
                        </button>
                    </td>
                </tr>

                <!-- Edit Leave Modal -->
                <div class="modal fade" id="editLeaveModal{{ $leave->id }}" tabindex="-1" role="dialog" aria-labelledby="editLeaveModalLabel{{ $leave->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editLeaveModalLabel{{ $leave->id }}">Edit Leave</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('member.leaves.update', $leave->id) }}" method="POST"> 
                                    @csrf
                                    @method('PUT')
                                
                                    <!-- Leave Types -->
                                    <h3>Type of Leave</h3>
                                    <div>
                                        <input type="checkbox" name="vacation_leave" value="1" {{ $leave->vacation_leave ? 'checked' : '' }}>
                                        <label>Vacation Leave</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="mandatory_forced_leave" value="1" {{ $leave->mandatory_forced_leave ? 'checked' : '' }}>
                                        <label>Mandatory/Forced Leave</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="sick_leave" value="1" {{ $leave->sick_leave ? 'checked' : '' }}>
                                        <label>Sick Leave</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="maternity_leave" value="1" {{ $leave->maternity_leave ? 'checked' : '' }}>
                                        <label>Maternity Leave</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="paternity_leave" value="1" {{ $leave->paternity_leave ? 'checked' : '' }}>
                                        <label>Paternity Leave</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="special_privilege_leave" value="1" {{ $leave->special_privilege_leave ? 'checked' : '' }}>
                                        <label>Special Privilege Leave</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="solo_parent_leave" value="1" {{ $leave->solo_parent_leave ? 'checked' : '' }}>
                                        <label>Solo Parent Leave</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="study_leave" value="1" {{ $leave->study_leave ? 'checked' : '' }}>
                                        <label>Study Leave</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="vawc_leave" value="1" {{ $leave->vawc_leave ? 'checked' : '' }}>
                                        <label>VAWC Leave</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="rehabilitation_privilege" value="1" {{ $leave->rehabilitation_privilege ? 'checked' : '' }}>
                                        <label>Rehabilitation Privilege</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="special_leave_for_women" value="1" {{ $leave->special_leave_for_women ? 'checked' : '' }}>
                                        <label>Special Leave for Women</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="special_emergency_calamity_leave" value="1" {{ $leave->special_emergency_calamity_leave ? 'checked' : '' }}>
                                        <label>Calamity Leave</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="adoption_leave" value="1" {{ $leave->adoption_leave ? 'checked' : '' }}>
                                        <label>Adoption Leave</label>
                                    </div>
                                    <div>
                                        <label for="others_type_of_leave">Others:</label>
                                        <input type="text" name="others_type_of_leave" value="{{ $leave->others_type_of_leave }}" placeholder="Specify if any">
                                    </div>
                                
                                    <!-- Location Details -->
                                    <h3>Location</h3>
                                    <div>
                                        <input type="radio" name="location" value="within_philippines" {{ $leave->location == 'within_philippines' ? 'checked' : '' }}>
                                        <label>Within Philippines</label>
                                    </div>
                                    <div>
                                        <input type="radio" name="location" value="abroad" {{ $leave->location == 'abroad' ? 'checked' : '' }}>
                                        <label>Abroad</label>
                                    </div>
                                    <input type="text" name="abroad_specify" value="{{ $leave->abroad_specify }}" placeholder="Specify location if abroad">
                                
                                    <!-- Hospital/Illness Details -->
                                    <h3>Sick Leave</h3>
                                    <div>
                                        <input type="checkbox" name="in_hospital" value="1" {{ $leave->in_hospital ? 'checked' : '' }}>
                                        <label>In Hospital</label>
                                    </div>
                                    <input type="text" name="hospital_specify_illness" value="{{ $leave->hospital_specify_illness }}" placeholder="Specify illness">
                                    <div>
                                        <input type="checkbox" name="outpatient" value="1" {{ $leave->outpatient ? 'checked' : '' }}>
                                        <label>Outpatient</label>
                                    </div>
                                    <input type="text" name="outpatient_specify_illness" value="{{ $leave->outpatient_specify_illness }}" placeholder="Specify illness">
                                
                                    <!-- Study Leave Details -->
                                    <h3>Study Leave</h3>
                                    <div>
                                        <input type="checkbox" name="study_leave_completion_masters" value="1" {{ $leave->study_leave_completion_masters ? 'checked' : '' }}>
                                        <label>Completion of Master's Degree</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="study_leave_bar_review" value="1" {{ $leave->study_leave_bar_review ? 'checked' : '' }}>
                                        <label>BAR/Board Exam Review</label>
                                    </div>
                                
                                    <h3>Other Purpose</h3>
                                    <div>
                                        <input type="checkbox" name="monetization_of_leave_credits" value="1" {{ $leave->monetization_of_leave_credits ? 'checked' : '' }}>
                                        <label>Monetization of Leave Credits</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="terminal_leave" value="1" {{ $leave->terminal_leave ? 'checked' : '' }}>
                                        <label>Terminal Leave</label>
                                    </div>
                                
                                    <!-- Leave Application Details -->
                                    <h3>Leave Details</h3>
                                    <div>
                                        <label for="details_of_leave">Details</label>
                                        <textarea name="details_of_leave" rows="3">{{ $leave->details_of_leave }}</textarea>
                                    </div>
                                    <div>
                                        <label for="working_days_applied">Working Days Applied</label>
                                        <input type="number" name="working_days_applied" value="{{ $leave->working_days_applied }}" min="1">
                                    </div>
                                    <div>
                                        <label for="inclusive_dates">Inclusive Dates</label>
                                        <input type="text" name="inclusive_dates" value="{{ $leave->inclusive_dates }}" placeholder="e.g., 2024-10-20 to 2024-10-25">
                                    </div>
                                
                                    <!-- Commutation -->
                                    <div>
                                        <label for="commutation">Commutation</label>
                                        <select name="commutation">
                                            <option value="Not Requested" {{ $leave->commutation == 'Not Requested' ? 'selected' : '' }}>Not Requested</option>
                                            <option value="Requested" {{ $leave->commutation == 'Requested' ? 'selected' : '' }}>Requested</option>
                                        </select>
                                    </div>
                                
                                    <!-- Submit Button -->
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

    <!-- Add Leave Modal -->
    <div class="modal fade" id="addLeaveModal" tabindex="-1" role="dialog" aria-labelledby="addLeaveModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addLeaveModalLabel">Add Leave</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('member.leaves.store') }}" method="POST">
                        @csrf
                    
                        <!-- Leave Types -->
                        <h3>Leave Types</h3>
                        <div>
                            <input type="checkbox" name="vacation_leave" value="1">
                            <label>Vacation Leave</label>
                        </div>
                        <div>
                            <input type="checkbox" name="mandatory_forced_leave" value="1">
                            <label>Mandatory Forced Leave</label>
                        </div>
                        <div>
                            <input type="checkbox" name="sick_leave" value="1">
                            <label>Sick Leave</label>
                        </div>
                        <div>
                            <input type="checkbox" name="maternity_leave" value="1">
                            <label>Maternity Leave</label>
                        </div>
                        <div>
                            <input type="checkbox" name="paternity_leave" value="1">
                            <label>Paternity Leave</label>
                        </div>
                        <div>
                            <input type="checkbox" name="special_privilege_leave" value="1">
                            <label>Special Privilege Leave</label>
                        </div>
                        <div>
                            <input type="checkbox" name="solo_parent_leave" value="1">
                            <label>Solo Parent Leave</label>
                        </div>
                        <div>
                            <input type="checkbox" name="study_leave" value="1">
                            <label>Study Leave</label>
                        </div>
                        <div>
                            <input type="checkbox" name="special_emergency_calamity_leave" value="1">
                            <label>Special Emergency Calamity Leave</label>
                        </div>
                        <div>
                            <input type="checkbox" name="adoption_leave" value="1">
                            <label>Adoption Leave</label>
                        </div>
                        <div>
                            <label for="others_type_of_leave">Others (Specify):</label>
                            <input type="text" name="others_type_of_leave" placeholder="Specify other leave type">
                        </div>
                    
                        <!-- Location Details -->
                        <h3>Location Details</h3>
                        <div>
                            <input type="radio" name="location" value="within_philippines" checked>
                            <label>Within Philippines</label>
                        </div>
                        <div>
                            <input type="radio" name="location" value="abroad">
                            <label>Abroad</label>
                        </div>
                        <input type="text" name="abroad_specify" placeholder="Specify location if abroad">
                    
                        <!-- Hospital/Illness Details -->
                        <h3>Hospital / Illness Details</h3>
                        <div>
                            <input type="checkbox" name="in_hospital" value="1">
                            <label>In Hospital</label>
                        </div>
                        <input type="text" name="hospital_specify_illness" placeholder="Specify illness if hospitalized">
                        <div>
                            <input type="checkbox" name="outpatient" value="1">
                            <label>Outpatient</label>
                        </div>
                        <input type="text" name="outpatient_specify_illness" placeholder="Specify outpatient illness">
                    
                        <!-- Study Leave Details -->
                        <h3>Study Leave</h3>
                        <div>
                            <input type="checkbox" name="study_leave_completion_masters" value="1">
                            <label>Completion of Master's Degree</label>
                        </div>
                        <div>
                            <input type="checkbox" name="study_leave_bar_review" value="1">
                            <label>Bar Review</label>
                        </div>
                        <h3>Other purpose</h3>



                    
                        <!-- Monetization Request -->
                        <div>
                            <input type="checkbox" name="monetization_of_leave_credits" value="1">
                            <label>Monetization of Leave Credits</label>
                        </div>
                                                <div>
                            <input type="checkbox" name="terminal_leave" value="1">
                            <label>Terminal Leave </label>
                        </div>
                    
                        <!-- Leave Details -->
                        <h3>Leave Application Details</h3>
                        <div>
                            <label for="details_of_leave">Details of Leave</label>
                            <textarea name="details_of_leave" rows="3" placeholder="Describe the purpose of the leave"></textarea>
                        </div>
                        <div>
                            <label for="working_days_applied">Working Days Applied</label>
                            <input type="number" name="working_days_applied" min="1" placeholder="Enter number of working days">
                        </div>
                        <div>
                            <label for="commutation">Commutation</label>
                            <select name="commutation">
                                <option value="Not Requested">Not Requested</option>
                                <option value="Requested">Requested</option>
                            </select>
                        </div>
                        <div>
                            <label for="inclusive_dates">Inclusive Dates</label>
                            <input type="text" name="inclusive_dates" placeholder="Enter inclusive dates (e.g., 2024-10-20 to 2024-10-25)">
                        </div>
                    
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-success">Submit Leave Request</button>
                    
                    </form>
                    
                </div>
                
            </div>
        </div>
    </div>
       <!-- Delete Confirmation Modal -->
       <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this leave?
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
