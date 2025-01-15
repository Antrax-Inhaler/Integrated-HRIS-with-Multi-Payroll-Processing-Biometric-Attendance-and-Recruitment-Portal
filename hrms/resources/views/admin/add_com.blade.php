@include('admin.sidenav')

<section class="home-section" style="width: calc(100% - 58px); overflow:scroll">
    <div class="container mt-5">
        <h2>Add Commissions</h2>

        <!-- Button to trigger add commission modal -->
        <button class="btn btn-success mb-3" data-toggle="modal" data-target="#addComModal">Add Commission</button>
        <br> <br>
        <!-- Commissions Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Member</th>
                    <th>Amount</th>
                    <th>Month & Year</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($addComs as $addCom)
                    <tr>
                        <td>{{ $addCom->id }}</td>
                        <td>{{ $addCom->member->surname }} {{ $addCom->member->given_name }}</td>
                        <td>{{ $addCom->amount }}</td>
                        <td>{{ $addCom->month_year }}</td>
                        <td>{{ $addCom->description }}</td>
                        <td>
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editComModal{{ $addCom->id }}">Edit</button>
                            <form action="{{ route('admin.add_com.destroy', $addCom->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Commission Modal -->
                    <div class="modal fade" id="editComModal{{ $addCom->id }}" tabindex="-1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Commission</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('admin.add_com.update', $addCom->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="member_id">Member</label>
                                            <select name="member_id" class="form-control" required>
                                                @foreach($members as $member)
                                                    <option value="{{ $member->id }}" {{ $addCom->member_id == $member->id ? 'selected' : '' }}>
                                                        {{ $member->surname }} {{ $member->given_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="amount">Amount</label>
                                            <input type="number" step="0.01" name="amount" class="form-control" value="{{ $addCom->amount }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="month_year">Month & Year</label>
                                            <input type="date" name="month_year" class="form-control" value="{{ $addCom->month_year }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <input type="text" name="description" class="form-control" value="{{ $addCom->description }}">
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

    <!-- Add Commission Modal -->
    <div class="modal fade" id="addComModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Commission</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.add_com.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="member_id">Member</label>
                            <select name="member_id" class="form-control" required>
                                @foreach($members as $member)
                                    <option value="{{ $member->id }}">
                                        {{ $member->surname }} {{ $member->given_name }}
                                    </option>
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
                            <input type="text" name="description" class="form-control" value="Commission">
                        </div>
                        <button type="submit" class="btn btn-success">Add Commission</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
