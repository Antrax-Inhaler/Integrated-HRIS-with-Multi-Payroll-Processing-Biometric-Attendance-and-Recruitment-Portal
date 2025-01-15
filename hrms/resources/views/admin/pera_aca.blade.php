@include('admin.sidenav')

<section class="home-section" style="width: calc(100% - 58px); overflow:scroll">
    <div class="container mt-5">
        <h2>Pera/Aca Allowance</h2>

        <!-- Button to trigger add allowance modal -->
        <button class="btn btn-success mb-3" data-toggle="modal" data-target="#addAllowanceModal">Add Allowance</button>
        <br><br>
        <!-- Allowance Listings Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Member Name</th>
                    <th>Amount</th>
                    <th>Month & Year</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($allowances as $allowance)
                    <tr>
                        <td>{{ $allowance->id }}</td>
                        <td>{{ $allowance->member_name }}</td>
                        <td>{{ $allowance->amount }}</td>
                        <td>{{ $allowance->month_year }}</td>
                        <td>{{ $allowance->description }}</td>
                        <td>
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editAllowanceModal{{ $allowance->id }}">Edit</button>
                            <form action="{{ route('admin.pera_aca.destroy', $allowance->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Allowance Modal -->
                    <div class="modal fade" id="editAllowanceModal{{ $allowance->id }}" tabindex="-1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Allowance</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('admin.pera_aca.update', $allowance->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="member_id">Member Name</label>
                                            <input type="text" name="member_name" class="form-control" value="{{ $allowance->member_name }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="amount">Amount</label>
                                            <input type="number" step="0.01" name="amount" class="form-control" value="{{ $allowance->amount }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="month_year">Month & Year</label>
                                            <input type="date" name="month_year" class="form-control" value="{{ $allowance->month_year }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <input type="text" name="description" class="form-control" value="{{ $allowance->description }}">
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

    <!-- Add Allowance Modal -->
    <div class="modal fade" id="addAllowanceModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Allowance</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.pera_aca.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="member_id">Member ID</label>
                            <select name="member_id" class="form-control" required>
                                @foreach($members as $member)
                                    <option value="{{ $member->id }}">{{ $member->surname }}, {{ $member->given_name }} {{ $member->middle_name ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" step="0.01" name="amount" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="month_year">Month & Year</label>
                            <input type="date" name="month_year" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" name="description" class="form-control" value="Pera/Aca Allowance">
                        </div>
                        <button type="submit" class="btn btn-success">Add Allowance</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
