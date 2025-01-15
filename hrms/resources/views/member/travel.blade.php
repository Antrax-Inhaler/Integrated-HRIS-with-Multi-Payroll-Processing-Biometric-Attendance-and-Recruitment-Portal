@include('member.sidenav')
<section class="home-section" style="width: calc(100% - 58px); overflow: scroll">
    <button  class="btn btn-success mb-3"  onclick="showCreateModal()">Add New Travel</button>
<br>
<br>
    <!-- Travel List for the current member -->
    <table border="1" cellpadding="10"  class="table table-bordered">
        <thead>
            <tr>
                <th>Departure Date</th>
                <th>Return Date</th>
                <th>Destination</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($travels as $travel)
            <tr>
                <td>{{ $travel->departure_date }}</td>
                <td>{{ $travel->return_date }}</td>
                <td>{{ $travel->destination }}</td>
                <td>{{ $travel->status }}</td>
                <td>
                    <!-- Edit Button -->
                    <button class="btn btn-primary btn-sm" onclick="showEditModal({{ $travel->id }}, '{{ $travel->official_station }}', '{{ $travel->departure_date }}', '{{ $travel->return_date }}', '{{ $travel->destination }}')">Edit</button>
                    <!-- Delete Form -->
                    <form method="POST" action="{{ route('member.travel.destroy', $travel->id) }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Are you sure you want to delete this travel application?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Create Travel Button -->

    <!-- Create Travel Modal -->
    <div id="createModal" style="display:none;">
        <h2>Create Travel Application</h2>
        <form method="POST" action="{{ route('member.travel.store') }}">
            @csrf
    
    
            <label for="departure_date">Departure Date:</label>
            <input type="date" name="departure_date" required><br>
    
            <label for="return_date">Return Date:</label>
            <input type="date" name="return_date" required><br>
    
            <label for="destination">Destination:</label>
            <input type="text" name="destination" required><br>
    
            <label for="inclusive_dates">Inclusive Dates:</label>
            <textarea name="inclusive_dates" rows="2"></textarea><br>
    
            <label for="specific_purpose">Specific Purpose:</label>
            <textarea name="specific_purpose" rows="3" required></textarea><br>
    
            <label for="objectives">Objectives:</label>
            <textarea name="objectives" rows="3"></textarea><br>
    
            <label for="per_diem_expenses">Per Diem Expenses:</label>
            <input type="number" name="per_diem_expenses" step="0.01"><br>
    
            <label for="assistant_or_laborers_allowed">Assistant/Laborers Allowed:</label>
            <input type="checkbox" name="assistant_or_laborers_allowed" value="1"><br>
    
            <label for="appropriation_to_which_travel">Appropriation to Which Travel Should Be Charged:</label>
            <input type="text" name="appropriation_to_which_travel"><br>
    
            <label for="remarks_or_special_instructions">Remarks or Special Instructions:</label>
            <textarea name="remarks_or_special_instructions" rows="2"></textarea><br>
    
            <button type="submit">Submit</button>
            <button type="button" onclick="closeCreateModal()">Cancel</button>
        </form>
    </div>
    

    <div id="editModal" style="display:none;">
        <h2>Edit Travel Application</h2>
        <form method="POST" action="" id="editForm">
            @csrf
            @method('PUT')
            <input type="hidden" name="travel_id" id="edit_travel_id">
    
            <label for="official_station">Official Station:</label>
            <input type="text" name="official_station" id="edit_official_station" required><br>
    
            <label for="departure_date">Departure Date:</label>
            <input type="date" name="departure_date" id="edit_departure_date" required><br>
    
            <label for="return_date">Return Date:</label>
            <input type="date" name="return_date" id="edit_return_date" required><br>
    
            <label for="destination">Destination:</label>
            <input type="text" name="destination" id="edit_destination" required><br>
    
            <label for="inclusive_dates">Inclusive Dates:</label>
            <textarea name="inclusive_dates" id="edit_inclusive_dates" rows="2"></textarea><br>
    
            <label for="specific_purpose">Specific Purpose:</label>
            <textarea name="specific_purpose" id="edit_specific_purpose" rows="3" required></textarea><br>
    
            <label for="objectives">Objectives:</label>
            <textarea name="objectives" id="edit_objectives" rows="3"></textarea><br>
    
            <label for="per_diem_expenses">Per Diem Expenses:</label>
            <input type="number" name="per_diem_expenses" id="edit_per_diem_expenses" step="0.01"><br>
    
            <label for="assistant_or_laborers_allowed">Assistant/Laborers Allowed:</label>
            <input type="checkbox" name="assistant_or_laborers_allowed" id="edit_assistant_or_laborers_allowed" value="1"><br>
    
            <label for="immediate_supervisor">Immidiate Supervisor</label>
            <input type="text" name="immediate_supervisor" id="immediate_supervisor"><br>

            <label for="appropriation_to_which_travel">Appropriation to Which Travel Should Be Charged:</label>
            <input type="text" name="appropriation_to_which_travel" id="edit_appropriation_to_which_travel"><br>
    
            <label for="remarks_or_special_instructions">Remarks or Special Instructions:</label>
            <textarea name="remarks_or_special_instructions" id="edit_remarks_or_special_instructions" rows="2"></textarea><br>
    
            <button type="submit">Update</button>
            <button type="button" onclick="closeEditModal()">Cancel</button>
        </form>
    </div>
    
</section>
    <script>
        // Show Create Modal
        function showCreateModal() {
            document.getElementById('createModal').style.display = 'block';
        }

        // Close Create Modal
        function closeCreateModal() {
            document.getElementById('createModal').style.display = 'none';
        }

        // Show Edit Modal and populate data
        function showEditModal(id, official_station, departure_date, return_date, destination, 
                       inclusive_dates, specific_purpose, objectives, per_diem_expenses, 
                       assistant_or_laborers_allowed, appropriation, remarks) {
    document.getElementById('editModal').style.display = 'block';
    document.getElementById('editForm').action = '/member/travel/' + id;
    
    // Set the values for the employee inputs
    document.getElementById('edit_travel_id').value = id;
    document.getElementById('edit_official_station').value = official_station;
    document.getElementById('edit_departure_date').value = departure_date;
    document.getElementById('edit_return_date').value = return_date;
    document.getElementById('edit_destination').value = destination;
    document.getElementById('edit_inclusive_dates').value = inclusive_dates;
    document.getElementById('edit_specific_purpose').value = specific_purpose;
    document.getElementById('edit_objectives').value = objectives;
    document.getElementById('edit_per_diem_expenses').value = per_diem_expenses;
    document.getElementById('edit_assistant_or_laborers_allowed').checked = assistant_or_laborers_allowed;
    document.getElementById('edit_appropriation').value = appropriation;
    document.getElementById('edit_remarks').value = remarks;
}


        // Close Edit Modal
        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }
    </script>
