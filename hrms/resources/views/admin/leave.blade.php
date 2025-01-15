@include('admin.sidenav')
<section class="home-section" style="width: calc(100% - 58px); overflow:scroll">



<div class="container mt-5">
    <h2>Leave Management</h2>

    <!-- Button to trigger add leave modal -->
    {{-- <button class="btn btn-success mb-3" data-toggle="modal" data-target="#addLeaveModal">Add Leave</button> --}}

    <!-- Leaves Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Member</th>
                <th>Leave Types</th>
                <th>Location</th>
                <th>Hospital / Outpatient Details</th>
                <th>Study Leave</th>
                <th>Working Days Applied</th>
                <th>Commutation</th>
                <th>Inclusive Dates</th>
                <th>Approval Status</th>
                <th>Disapproval Reason</th>
                <th>Authorized Official</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            
        </thead>
        <tbody>
        @foreach($leaves as $leave)
            <tr>
                <td>{{ $leave->id }}</td>
                <td>
                    @if($leave->member)
                        {{ $leave->member->surname }}, 
                        {{ $leave->member->given_name }} 
                        {{ $leave->member->last_name }}
                    @else
                        <em>No Member Assigned</em>
                    @endif
                </td>
                
                <!-- Leave Types -->
                <td>
                    @php
                        $leaveTypes = [
                            'vacation_leave', 'mandatory_forced_leave', 'sick_leave', 'maternity_leave',
                            'paternity_leave', 'special_privilege_leave', 'solo_parent_leave', 'study_leave',
                            'ten_day_vawc_leave', 'rehabilitation_privilege', 'special_leave_for_women',
                            'special_emergency_calamity_leave', 'adoption_leave'
                        ];
                    @endphp
                    @foreach($leaveTypes as $type)
                        @if($leave->$type)
                            <span class="badge2 badge-info">{{ ucfirst(str_replace('_', ' ', $type)) }}</span>
                        @endif
                    @endforeach
                    @if($leave->others_type_of_leave)
                        <span class="badge2 badge-secondary">{{ $leave->others_type_of_leave }}</span>
                    @endif
                </td>
            
                <!-- Location -->
                <td>
                    {{ $leave->within_philippines ? 'Within Philippines' : 'Abroad' }}
                    @if($leave->abroad && $leave->abroad_specify)
                        ({{ $leave->abroad_specify }})
                    @endif
                </td>
            
                <!-- Hospital / Outpatient Details -->
                <td>
                    @if($leave->in_hospital)
                        In Hospital ({{ $leave->hospital_specify_illness }})
                    @endif
                    @if($leave->outpatient)
                        Outpatient ({{ $leave->outpatient_specify_illness }})
                    @endif
                </td>
            
                <!-- Study Leave Details -->
                <td>
                    @if($leave->study_leave_completion_masters)
                        Completion of Master's
                    @endif
                    @if($leave->study_leave_bar_review)
                        Bar Review
                    @endif
                </td>
            
                <!-- Working Days Applied -->
                <td>{{ $leave->working_days_applied }}</td>
            
                <!-- Commutation -->
                <td>{{ $leave->commutation }}</td>
            
                <!-- Inclusive Dates -->
                <td>{{ $leave->inclusive_dates }}</td>
            
                <!-- Approval Status -->
                <td>{{ $leave->approval_status }}</td>
            
                <!-- Disapproval Reason -->
                <td>{{ $leave->disapproval_reason ?? 'N/A' }}</td>
            
                <!-- Authorized Official -->
                <td>{{ $leave->authorized_official ?? 'N/A' }}</td>
            
                <td>{{ $leave->status }}</td>
                <td>
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editLeaveModal{{ $leave->id }}">Process</button>
                    <a href="{{ route('leaves.pdf', $leave->id) }}" class="btn btn-secondary btn-sm" target="_blank">View PDF</a>
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
                            <div class="card">
                                <div class="card-header">
                                    <h5>Leave Application Details</h5>
                                </div>
                                <div class="card-body">
                                    <p><strong>Vacation Leave:</strong> {{ $leave->vacation_leave ? 'Yes' : 'No' }}</p>
                                    <p><strong>Sick Leave:</strong> {{ $leave->sick_leave ? 'Yes' : 'No' }}</p>
                                    <p><strong>Maternity Leave:</strong> {{ $leave->maternity_leave ? 'Yes' : 'No' }}</p>
                                    <p><strong>Paternity Leave:</strong> {{ $leave->paternity_leave ? 'Yes' : 'No' }}</p>
                                    <p><strong>Special Privilege Leave:</strong> {{ $leave->special_privilege_leave ? 'Yes' : 'No' }}</p>
                                    <p><strong>Details of Leave:</strong> {{ $leave->details_of_leave }}</p>
                                    <p><strong>Working Days Applied:</strong> {{ $leave->working_days_applied }}</p>
                                    <p><strong>Inclusive Dates:</strong> {{ $leave->inclusive_dates }}</p>
                                    <p><strong>Commutation:</strong> {{ $leave->commutation }}</p>
                                </div>
                            </div>
                            
                            <form action="{{ route('admin.leaves.update', $leave->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                            
                                <!-- Employee Leave Application Details -->
                                <h3>Employee Leave Application Details</h3>
                                <div class="card">
                                    <div>
                                        <strong>Vacation Leave:</strong> {{ $leave->vacation_leave ? 'Yes' : 'No' }}
                                    </div>
                                    <div>
                                        <strong>Mandatory Forced Leave:</strong> {{ $leave->mandatory_forced_leave ? 'Yes' : 'No' }}
                                    </div>
                                    <div>
                                        <strong>Sick Leave:</strong> {{ $leave->sick_leave ? 'Yes' : 'No' }}
                                    </div>
                                    <div>
                                        <strong>Maternity Leave:</strong> {{ $leave->maternity_leave ? 'Yes' : 'No' }}
                                    </div>
                                    <div>
                                        <strong>Paternity Leave:</strong> {{ $leave->paternity_leave ? 'Yes' : 'No' }}
                                    </div>
                                    <div>
                                        <strong>Special Privilege Leave:</strong> {{ $leave->special_privilege_leave ? 'Yes' : 'No' }}
                                    </div>
                                    <div>
                                        <strong>Solo Parent Leave:</strong> {{ $leave->solo_parent_leave ? 'Yes' : 'No' }}
                                    </div>
                                    <div>
                                        <strong>Study Leave:</strong> {{ $leave->study_leave ? 'Yes' : 'No' }}
                                    </div>
                                    <div>
                                        <strong>Others (Specify):</strong> {{ $leave->others_type_of_leave ?? 'N/A' }}
                                    </div>
                                    <div>
                                        <strong>Location:</strong> {{ $leave->within_philippines ? 'Within Philippines' : 'Abroad' }}
                                        @if(!$leave->within_philippines)
                                            <strong>Specify:</strong> {{ $leave->abroad_specify ?? 'N/A' }}
                                        @endif
                                    </div>
                                    <div>
                                        <strong>In Hospital:</strong> {{ $leave->in_hospital ? 'Yes' : 'No' }}
                                        @if($leave->in_hospital)
                                            <strong>Specify Illness:</strong> {{ $leave->hospital_specify_illness ?? 'N/A' }}
                                        @endif
                                    </div>
                                    <div>
                                        <strong>Outpatient:</strong> {{ $leave->outpatient ? 'Yes' : 'No' }}
                                        @if($leave->outpatient)
                                            <strong>Specify Illness:</strong> {{ $leave->outpatient_specify_illness ?? 'N/A' }}
                                        @endif
                                    </div>
                                    <div>
                                        <strong>Details of Leave:</strong> {{ $leave->details_of_leave ?? 'N/A' }}
                                    </div>
                                    <div>
                                        <strong>Working Days Applied:</strong> {{ $leave->working_days_applied ?? 0 }}
                                    </div>
                                    <div>
                                        <strong>Inclusive Dates:</strong> {{ $leave->inclusive_dates ?? 'N/A' }}
                                    </div>
                                </div>
                            
                                <!-- Leave Balances -->
                                <h3>Leave Balances (Calculated by HR/Admin):</h3>
                                <div>
                                    <label for="total_earned_sick">Total Earned Sick Leave:</label>
                                    <input type="number" id="total_earned_sick" name="total_earned_sick" 
                                           value="{{ $leave->total_earned_sick ?? ($member->balance_sick ?? 0) }}" step="0.01" min="0" readonly>
                                </div>
                                <div>
                                    <label for="total_earned_vacation">Total Earned Vacation Leave:</label>
                                    <input type="number" id="total_earned_vacation" name="total_earned_vacation" 
                                           value="{{ $leave->total_earned_vacation ?? ($member->balance_vacation ?? 0) }}" step="0.01" min="0" readonly>
                                </div>
                                <div>
                                    <label for="less_this_application_vacation">Less This Application Vacation:</label>
                                    <input type="number" id="less_this_application_vacation" name="less_this_application_vacation" 
                                           value="{{ $leave->less_this_application_vacation ?? 0 }}" step="0.01" min="0" oninput="computeBalances()">
                                </div>
                                <div>
                                    <label for="less_this_application_sick">Less This Application Sick:</label>
                                    <input type="number" id="less_this_application_sick" name="less_this_application_sick" 
                                           value="{{ $leave->less_this_application_sick ?? 0 }}" step="0.01" min="0" oninput="computeBalances()">
                                </div>
                                <div>
                                    <label for="balance_vacation">Balance Vacation Leave:</label>
                                    <input type="number" id="balance_vacation" name="balance_vacation" 
                                           value="{{ $leave->balance_vacation ?? 0 }}" step="0.01" min="0" disabled>
                                </div>
                                <div>
                                    <label for="balance_sick">Balance Sick Leave:</label>
                                    <input type="number" id="balance_sick" name="balance_sick" 
                                           value="{{ $leave->balance_sick ?? 0 }}" step="0.01" min="0" disabled>
                                </div>
                            
                            
                                <!-- Approval and Recommendations -->
                                <h3>Approval and Recommendations:</h3>
                                <div>
                                    <label for="approval_status">Approval Status:</label>
                                    <select name="approval_status">
                                        <option value="For approval" {{ $leave->approval_status == 'For approval' ? 'selected' : '' }}>For approval</option>
                                        <option value="For disapproval" {{ $leave->approval_status == 'For disapproval' ? 'selected' : '' }}>For disapproval</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="disapproval_reason">Disapproval Reason:</label>
                                    <textarea name="disapproval_reason" rows="3">{{ $leave->disapproval_reason ?? '' }}</textarea>
                                </div>
                                <div>
                                    <label for="authorize_officer_credits">Authorize Officer Credits:</label>
                                    <input type="text" name="authorize_officer_credits" value="{{ $leave->authorize_officer_credits ?? '' }}">
                                </div>
                                <div>
                                    <label for="authorize_officer_recommendation">Authorize Officer Recommendation:</label>
                                    <input type="text" name="authorize_officer_recommendation" value="{{ $leave->authorize_officer_recommendation ?? '' }}">
                                </div>
                                <div>
                                    <label for="approved_days_with_pay">Approved Days with Pay:</label>
                                    <input type="number" name="approved_days_with_pay" value="{{ $leave->approved_days_with_pay ?? 0 }}">
                                </div>
                                <div>
                                    <label for="approved_days_without_pay">Approved Days without Pay:</label>
                                    <input type="number" name="approved_days_without_pay" value="{{ $leave->approved_days_without_pay ?? 0 }}">
                                </div>
                                <div>
                                    <label for="approved_others">Approved Others:</label>
                                    <textarea name="approved_others" rows="3">{{ $leave->approved_others ?? '' }}</textarea>
                                </div>
                                <div>
                                    <label for="disapproved_due_to">Disapproved Due to:</label>
                                    <textarea name="disapproved_due_to" rows="3">{{ $leave->disapproved_due_to ?? '' }}</textarea>
                                </div>
                                <div>
                                    <label for="authorized_official">Authorized Official:</label>
                                    <input type="text" name="authorized_official" value="{{ $leave->authorized_official ?? '' }}">
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
                <form action="{{ route('admin.leaves.store') }}" method="POST"> 
                    @csrf
                
                    <!-- Member -->
                    <div class="form-group">
                        <label for="member_id">Member</label>
                        <select class="form-control" name="member_id" required>
                            @foreach($members as $member)
                                <option value="{{ $member->id }}">{{ $member->name }}</option>
                            @endforeach
                        </select>
                    </div>
                
                    <!-- Start and End Dates -->
                    <div class="form-group">
                        <label for="start_date">Start Date</label>
                        <input type="date" class="form-control" name="start_date" required>
                    </div>
                
                    <div class="form-group">
                        <label for="end_date">End Date</label>
                        <input type="date" class="form-control" name="end_date" required>
                    </div>
                
                    <!-- Type of Leave -->
                    <div class="form-group">
                        <label>Type of Leave</label>
                        @foreach(['vacation_leave', 'mandatory_forced_leave', 'sick_leave', 'maternity_leave', 'paternity_leave', 'special_privilege_leave', 'solo_parent_leave', 'study_leave', 'ten_day_vawc_leave', 'rehabilitation_privilege', 'special_leave_for_women', 'special_emergency_calamity_leave', 'adoption_leave'] as $leaveType)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="{{ $leaveType }}" value="1">
                                <label class="form-check-label">{{ ucwords(str_replace('_', ' ', $leaveType)) }}</label>
                            </div>
                        @endforeach
                    </div>
                
                    <!-- Optional Leave Details -->
                    <div class="form-group">
                        <label for="others_type_of_leave">Other Type of Leave (if any)</label>
                        <input type="text" class="form-control" name="others_type_of_leave" placeholder="Specify other leave type">
                    </div>
                
                    <!-- Leave Location -->
                    <div class="form-group">
                        <label>Location</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="within_philippines" value="1">
                            <label class="form-check-label">Within Philippines</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="abroad" value="1">
                            <label class="form-check-label">Abroad</label>
                        </div>
                        <input type="text" class="form-control mt-2" name="abroad_specify" placeholder="Specify location if abroad">
                    </div>
                
                    <!-- Illness Details (if applicable) -->
                    <div class="form-group">
                        <label>Health-Related Leave</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="in_hospital" value="1">
                            <label class="form-check-label">In Hospital</label>
                        </div>
                        <input type="text" class="form-control mt-2" name="hospital_specify_illness" placeholder="Specify illness (if in hospital)">
                
                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" name="outpatient" value="1">
                            <label class="form-check-label">Outpatient</label>
                        </div>
                        <input type="text" class="form-control mt-2" name="outpatient_specify_illness" placeholder="Specify illness (if outpatient)">
                    </div>
                
                    <!-- Study Leave -->
                    <div class="form-group">
                        <label>Study Leave</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="study_leave_completion_masters" value="1">
                            <label class="form-check-label">Completion of Masters</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="study_leave_bar_review" value="1">
                            <label class="form-check-label">Bar/Board Review</label>
                        </div>
                    </div>
                
                    <!-- Leave Balance and Working Days -->
                    <div class="form-group">
                        <label for="working_days_applied">Working Days Applied</label>
                        <input type="number" class="form-control" name="working_days_applied">
                    </div>
                
                    <div class="form-group">
                        <label for="total_earned_sick">Total Earned Sick Leave</label>
                        <input type="number" step="0.01" class="form-control" name="total_earned_sick">
                    </div>
                
                    <div class="form-group">
                        <label for="total_earned_vacation">Total Earned Vacation Leave</label>
                        <input type="number" step="0.01" class="form-control" name="total_earned_vacation">
                    </div>
                
                    <div class="form-group">
                        <label for="less_this_application_vacation">Less this Application (Vacation)</label>
                        <input type="number" step="0.01" class="form-control" name="less_this_application_vacation">
                    </div>
                
                    <div class="form-group">
                        <label for="less_this_application_sick">Less this Application (Sick)</label>
                        <input type="number" step="0.01" class="form-control" name="less_this_application_sick">
                    </div>
                
                    <div class="form-group">
                        <label for="balance_vacation">Balance (Vacation)</label>
                        <input type="number" step="0.01" class="form-control" name="balance_vacation">
                    </div>
                
                    <div class="form-group">
                        <label for="balance_sick">Balance (Sick)</label>
                        <input type="number" step="0.01" class="form-control" name="balance_sick">
                    </div>
                
                    <!-- Approval and Authorization -->
                    <div class="form-group">
                        <label for="approval_status">Approval Status</label>
                        <select class="form-control" name="approval_status">
                            <option value="For approval">For Approval</option>
                            <option value="For disapproval">For Disapproval</option>
                        </select>
                    </div>
                
                    <div class="form-group">
                        <label for="disapproval_reason">Disapproval Reason (if any)</label>
                        <textarea class="form-control" name="disapproval_reason" rows="3"></textarea>
                    </div>
                
                    <div class="form-group">
                        <label for="authorize_officer_credits">Authorized Officer Credits</label>
                        <textarea class="form-control" name="authorize_officer_credits" rows="3"></textarea>
                    </div>
                
                    <button type="submit" class="btn btn-success">Submit Leave Application</button>
                </form>
                
            </div>
        </div>
    </div>
</div>

</section>
<script>
    function computeBalances() {
        const totalEarnedSick = parseFloat(document.getElementById('total_earned_sick').value) || 0;
        const totalEarnedVacation = parseFloat(document.getElementById('total_earned_vacation').value) || 0;
        const lessThisApplicationSick = parseFloat(document.getElementById('less_this_application_sick').value) || 0;
        const lessThisApplicationVacation = parseFloat(document.getElementById('less_this_application_vacation').value) || 0;

        // Calculate balances
        const newBalanceSick = totalEarnedSick - lessThisApplicationSick;
        const newBalanceVacation = totalEarnedVacation - lessThisApplicationVacation;

        // Update balance inputs
        document.getElementById('balance_sick').value = newBalanceSick >= 0 ? newBalanceSick.toFixed(2) : 0;
        document.getElementById('balance_vacation').value = newBalanceVacation >= 0 ? newBalanceVacation.toFixed(2) : 0;
    }

    // Disable balance inputs if totals are null
    document.addEventListener('DOMContentLoaded', function() {
        const totalSick = parseFloat(document.getElementById('total_earned_sick').value);
        const totalVacation = parseFloat(document.getElementById('total_earned_vacation').value);

        if (isNaN(totalSick) || isNaN(totalVacation)) {
            document.getElementById('balance_vacation').disabled = true;
            document.getElementById('balance_sick').disabled = true;
        }
    });
</script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

