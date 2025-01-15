@include('admin.sidenav')

<section class="home-section" style="width: calc(100% - 58px); overflow:scroll">
    <div class="container mt-5">
        <h2>Adjustments Management</h2>

        <!-- Button to trigger add adjustment modal -->
        <button class="btn btn-success mb-3" data-toggle="modal" data-target="#addAdjustmentModal">Add Adjustment</button>

        <!-- Adjustments Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Member Name</th>
                    <th>Adjustment Name</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Effective Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($adjustments as $adjustment)
                <tr>
                    <td>{{ $adjustment->id }}</td>
                    <td>{{ $adjustment->member->given_name }} {{ $adjustment->member->surname }}</td>
                    <td>{{ $adjustment->bonus_name }}</td>
                    <td>{{ $adjustment->description }}</td>
                    <td>{{ $adjustment->amount }}</td>
                    <td>{{ $adjustment->effective_date }}</td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editAdjustmentModal{{ $adjustment->id }}">Edit</button>
                        <form action="{{ route('adjustment.destroy', $adjustment->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>

                <!-- Edit Adjustment Modal -->
                <div class="modal fade" id="editAdjustmentModal{{ $adjustment->id }}" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Adjustment</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('adjustment.update', $adjustment->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="member_id">Member</label>
                                        <select name="member_id" class="form-control" required>
                                            @foreach($members as $member)
                                                <option value="{{ $member->id }}" {{ $member->id == $adjustment->member_id ? 'selected' : '' }}>
                                                    {{ $member->given_name }} {{ $member->surname }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="bonus_name">Adjustment Name</label>
                                        <input type="text" class="form-control" name="bonus_name" value="{{ $adjustment->bonus_name }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" class="form-control">{{ $adjustment->description }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <input type="number" class="form-control" name="amount" value="{{ $adjustment->amount }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="effective_date">Effective Date</label>
                                        <input type="date" class="form-control" name="effective_date" value="{{ $adjustment->effective_date }}" required>
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

    <!-- Add Adjustment Modal -->
    <div class="modal fade" id="addAdjustmentModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Adjustment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('adjustment.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="member_id">Member</label>
                            <select name="member_id" class="form-control" required>
                                @foreach($members as $member)
                                    <option value="{{ $member->id }}">{{ $member->given_name }} {{ $member->surname }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="bonus_name">Adjustment Name</label>
                            <input type="text" class="form-control" name="bonus_name" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" class="form-control" name="amount" required>
                        </div>
                        <div class="form-group">
                            <label for="effective_date">Effective Date</label>
                            <input type="date" class="form-control" name="effective_date" required>
                        </div>
                        <button type="submit" class="btn btn-success">Add Adjustment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Include necessary scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
