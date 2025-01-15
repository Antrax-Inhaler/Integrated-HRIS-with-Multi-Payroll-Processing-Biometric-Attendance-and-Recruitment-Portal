@include('admin.sidenav')
<section class="home-section" style="width: calc(100% - 58px); overflow:scroll">

    <div class="container mt-5">
        <h2>Travel Applications Management</h2>

        <!-- Button to trigger add travel application modal -->
        {{-- <button class="btn btn-success mb-3" data-toggle="modal" data-target="#addTravelModal">Add Travel Application</button> --}}

        <!-- Travel Applications Table -->
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Member Name</th>
                <th>Destination</th>
                <th>Departure Date</th>
                <th>Return Date</th>
                <th>Status</th>
                <th>Actions</th>
        
            </tr>
            </thead>
            <tbody>
            @foreach($travels as $travel)
                <tr>
                    <td>{{ $travel->id }}</td>

                    <!-- Check if member relationship exists to avoid errors -->
                    <td>
                        {{ optional($travel->member)->given_name ?? 'N/A' }} 
                        {{ optional($travel->member)->surname ?? '' }}
                    </td>
        
                    <td>{{ $travel->destination }}</td>
        
                    <!-- Format dates for better readability -->
                    <td>{{ \Carbon\Carbon::parse($travel->departure_date)->format('M d, Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($travel->return_date)->format('M d, Y') }}</td>
        
                    <!-- Capitalize status -->
                    <td>{{ ucfirst($travel->status) }}</td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editTravelModal{{ $travel->id }}">Process</button>
                        <a href="{{ route('travel.pdf', $travel->id) }}" class="btn btn-secondary btn-sm" target="_blank">View PDF</a>

                        {{-- <form action="{{ route('admin.travel.destroy', $travel->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form> --}}
                    </td>
                </tr>

                <!-- Edit Travel Modal -->
                <div class="modal fade" id="editTravelModal{{ $travel->id }}" tabindex="-1" role="dialog" aria-labelledby="editTravelModalLabel{{ $travel->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editTravelModalLabel{{ $travel->id }}">Edit Travel Application</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.travel.update', $travel->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                
                                    <!-- Official Station (Employee Input) -->
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5>Official Station</h5>
                                            <p>{{ $travel->official_station ?? 'Missing' }}</p>
                                        </div>
                                    </div>
                                
                                    <!-- Departure Date (Employee Input) -->
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5>Departure Date</h5>
                                            <p>{{ $travel->departure_date ?? 'Missing' }}</p>
                                        </div>
                                    </div>
                                
                                    <!-- Return Date (Employee Input) -->
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5>Return Date</h5>
                                            <p>{{ $travel->return_date ?? 'Missing' }}</p>
                                        </div>
                                    </div>
                                
                                    <!-- Destination (Employee Input) -->
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5>Destination</h5>
                                            <p>{{ $travel->destination ?? 'Missing' }}</p>
                                        </div>
                                    </div>
                                
                                    <!-- Specific Purpose (Employee Input) -->
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5>Specific Purpose</h5>
                                            <p>{{ $travel->specific_purpose ?? 'Missing' }}</p>
                                        </div>
                                    </div>
                                
                                    <!-- Objectives (Employee Input) -->
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5>Objectives</h5>
                                            <p>{{ $travel->objectives ?? 'Missing' }}</p>
                                        </div>
                                    </div>
                                
                                    <!-- Per Diem Expenses (Employee Input) -->
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5>Per Diem Expenses</h5>
                                            <p>{{ $travel->per_diem_expenses ?? 'Missing' }}</p>
                                        </div>
                                    </div>
                                
                                    <!-- Assistant/Laborers Allowed (Employee Input) -->
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5>Assistant or Laborers Allowed</h5>
                                            <p>{{ $travel->assistant_or_laborers_allowed ? 'Yes' : 'No' }}</p>
                                        </div>
                                    </div>
                                
                                    <!-- Appropriation to Which Travel Should Be Charged (Employee Input) -->
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5>Appropriation to Which Travel Should Be Charged</h5>
                                            <p>{{ $travel->appropriation_to_which_travel ?? 'Missing' }}</p>
                                        </div>
                                    </div>
                                
                                    <!-- Remarks or Special Instructions (Employee Input) -->
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5>Remarks or Special Instructions</h5>
                                            <p>{{ $travel->remarks_or_special_instructions ?? 'Missing' }}</p>
                                        </div>
                                    </div>
                                
                                    <!-- Recommending Approval (HR Input) -->
                                    <div class="form-group">
                                        <label for="recommending_approval">Recommending Approval</label>
                                        <input type="text" class="form-control" name="recommending_approval" value="{{ $travel->recommending_approval }}">
                                    </div>
                                
                                    <!-- Approved By (HR Input) -->
                                    <div class="form-group">
                                        <label for="approved_by">Approved By</label>
                                        <input type="text" class="form-control" name="approved_by" value="{{ $travel->approved_by }}">
                                    </div>
                                
                                   
                                
                                    <!-- Place Signed (HR Input) -->
                                    <div class="form-group">
                                        <label for="place_signed">Place Signed</label>
                                        <input type="text" class="form-control" name="place_signed" value="{{ $travel->place_signed }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="immediate_supervisor">Immidiate Supervisor</label>
                                        <input type="text" class="form-control" name="immediate_supervisor" value="{{ $travel->immediate_supervisor }}">
                                    </div>
                                
                                    <!-- Document Number (HR Input) -->
                                    <div class="form-group">
                                        <label for="document_number">Document Number</label>
                                        <input type="text" class="form-control" name="document_number" value="{{ $travel->document_number }}">
                                    </div>
                                
                                    <!-- Revision Number (HR Input) -->
                                    <div class="form-group">
                                        <label for="revision_number">Revision Number</label>
                                        <input type="number" class="form-control" name="revision_number" value="{{ $travel->revision_number }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="should_be_charged">Should be Charged</label>
                                        <input type="text" class="form-control" name="should_be_charged" value="{{ $travel->should_be_charged }}">
                                    </div>
                                
                                    <!-- Issued Date (HR Input) -->
                                    <div class="form-group">
                                        <label for="issued_date">Issued Date</label>
                                        <input type="date" class="form-control" name="issued_date" value="{{ $travel->issued_date }}">
                                    </div>
                                    <!-- Additional Date (HR Input) -->
<div class="form-group">
    <label for="additional_date">Additional Date</label>
    <input type="date" class="form-control" name="additional_date" value="{{ $travel->additional_date }}">
</div>

<!-- Travel Number (HR Input) -->
<div class="form-group">
    <label for="travel_number">Travel Number</label>
    <input type="number" class="form-control" name="travel_number" value="{{ $travel->travel_number }}">
</div>

                                 <!-- Status (HR Input) -->
                                 <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" name="status" required>
                                        <option value="Pending" {{ $travel->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Approved" {{ $travel->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="Disaproved" {{ $travel->status == 'denied' ? 'selected' : '' }}>Denied</option>
                                    </select>
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

    {{-- <!-- Add Travel Modal -->
    <div class="modal fade" id="addTravelModal" tabindex="-1" role="dialog" aria-labelledby="addTravelModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTravelModalLabel">Add Travel Application</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.travel.store') }}" method="POST">
                        @csrf
                    
                        <!-- Member -->
                        <div class="form-group">
                            <label for="member_id">Member</label>
                            <select class="form-control" name="member_id" required>
                                @foreach($members as $member)
                                    <option value="{{ $member->id }}">{{ $member->given_name }} {{ $member->surname }}</option>
                                @endforeach
                            </select>
                        </div>
                    
                        <!-- Official Station -->
                        <div class="form-group">
                            <label for="official_station">Official Station</label>
                            <input type="text" class="form-control" name="official_station" placeholder="Official Station" required>
                        </div>
                    
                        <!-- Departure Date -->
                        <div class="form-group">
                            <label for="departure_date">Departure Date</label>
                            <input type="date" class="form-control" name="departure_date" required>
                        </div>
                    
                        <!-- Return Date -->
                        <div class="form-group">
                            <label for="return_date">Return Date</label>
                            <input type="date" class="form-control" name="return_date" required>
                        </div>
                    
                        <!-- Destination -->
                        <div class="form-group">
                            <label for="destination">Destination</label>
                            <input type="text" class="form-control" name="destination" placeholder="Destination" required>
                        </div>
                    
                        <!-- Specific Purpose -->
                        <div class="form-group">
                            <label for="specific_purpose">Specific Purpose</label>
                            <textarea class="form-control" name="specific_purpose" placeholder="Specific Purpose" required></textarea>
                        </div>
                    
                        <!-- Objectives -->
                        <div class="form-group">
                            <label for="objectives">Objectives</label>
                            <textarea class="form-control" name="objectives" placeholder="Objectives"></textarea>
                        </div>
                    
                        <!-- Per Diem Expenses -->
                        <div class="form-group">
                            <label for="per_diem_expenses">Per Diem Expenses</label>
                            <input type="number" step="0.01" class="form-control" name="per_diem_expenses" placeholder="Per Diem Expenses">
                        </div>
                    
                        <!-- Assistant/Laborers Allowed -->
                        <div class="form-group">
                            <label for="assistant_or_laborers_allowed">Assistant or Laborers Allowed</label>
                            <select class="form-control" name="assistant_or_laborers_allowed">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    
                        <!-- Appropriation to Which Travel Should Be Charged -->
                        <div class="form-group">
                            <label for="appropriation_to_which_travel">Appropriation to Which Travel Should Be Charged</label>
                            <input type="text" class="form-control" name="appropriation_to_which_travel" placeholder="Appropriation">
                        </div>
                    
                        <!-- Remarks or Special Instructions -->
                        <div class="form-group">
                            <label for="remarks_or_special_instructions">Remarks or Special Instructions</label>
                            <textarea class="form-control" name="remarks_or_special_instructions" placeholder="Special Instructions"></textarea>
                        </div>
                    
                        <!-- Status -->
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" name="status" required>
                                <option value="pending">Pending</option>
                                <option value="processing">Processing</option>
                                <option value="approved">Approved</option>
                                <option value="denied">Denied</option>
                            </select>
                        </div>
                    
                        <!-- Recommending Approval -->
                        <div class="form-group">
                            <label for="recommending_approval">Recommending Approval</label>
                            <input type="text" class="form-control" name="recommending_approval" placeholder="Recommending Approval">
                        </div>
                    
                        <!-- Approved By -->
                        <div class="form-group">
                            <label for="approved_by">Approved By</label>
                            <input type="text" class="form-control" name="approved_by" placeholder="Approved By">
                        </div>
                    
                        <!-- Place Signed -->
                        <div class="form-group">
                            <label for="place_signed">Place Signed</label>
                            <input type="text" class="form-control" name="place_signed" placeholder="Place Signed">
                        </div>
                    
                        <!-- Document Number -->
                        <div class="form-group">
                            <label for="document_number">Document Number</label>
                            <input type="text" class="form-control" name="document_number" placeholder="Document Number">
                        </div>
                    
                        <!-- Revision Number -->
                        <div class="form-group">
                            <label for="revision_number">Revision Number</label>
                            <input type="number" class="form-control" name="revision_number" placeholder="Revision Number">
                        </div>
                    
                        <!-- Issued Date -->
                        <div class="form-group">
                            <label for="issued_date">Issued Date</label>
                            <input type="date" class="form-control" name="issued_date">
                        </div>
                    
                        <button type="submit" class="btn btn-success">Add Travel</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div> --}}
</section>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
