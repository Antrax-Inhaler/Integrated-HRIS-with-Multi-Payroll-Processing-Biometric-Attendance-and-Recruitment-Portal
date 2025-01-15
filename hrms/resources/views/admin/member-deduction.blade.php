@include('admin.sidenav')

<section class="home-section" style="width: calc(100% - 58px); overflow:scroll">

    <div class="container mt-5">
        <h2>Member Deductions Management</h2>

        <!-- Button to trigger add deduction modal -->
        <button class="btn btn-success mb-3" data-toggle="modal" data-target="#addDeductionModal">Add Deduction</button>

        <!-- Deductions Table -->
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Member Name</th>
                <th>Deduction</th>
                <th>Type</th>
                <th>Amount</th>
                <th>Effective Date</th>
                <th>Actions</th>
            </tr>
            </thead>
            <pjp tbody>
            @foreach($deductions as $deduction)
                <tr>
                    <td>{{ $deduction->id }}</td>
                    <td>{{ $deduction->member->given_name }} {{ $deduction->member->surname }}</td>
                    <td>{{ $deduction->deduction_name }}</td>
                    <td>
                        @switch($deduction->type)
                            @case(1)
                                Monthly
                                @break
                            @case(2)
                                Semi-Monthly
                                @break
                            @case(3)
                                Once
                                @break
                            @default
                                Unknown
                        @endswitch
                    </td>
                    <td>{{ $deduction->amount }}</td>
                    <td>{{ $deduction->effective_date }}</td>
                                        <td>
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editDeductionModal{{ $deduction->id }}">Edit</button>
                        <form action="{{ route('admin.member-deductions.destroy', $deduction->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>

                <!-- Edit Deduction Modal -->
                <div class="modal fade" id="editDeductionModal{{ $deduction->id }}" tabindex="-1" role="dialog" aria-labelledby="editDeductionModalLabel{{ $deduction->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editDeductionModalLabel{{ $deduction->id }}">Edit Deduction</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.member-deductions.update', $deduction->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="member_id">Member</label>
                                        <select class="form-control" name="member_id" required>
                                            @foreach($members as $member)
                                                <option value="{{ $member->id }}" {{ $deduction->member_id == $member->id ? 'selected' : '' }}>{{ $member->given_name }} {{ $member->surname }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="deduction_id">Deduction</label>
                                        <select class="form-control" name="deduction_id" required>
                                            @foreach($deductionsList as $d)
                                                <option value="{{ $d->id }}" {{ $deduction->deduction_id == $d->id ? 'selected' : '' }}>{{ $d->deduction_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="type">Type</label>
                                        <select class="form-control" name="type" required>
                                            <option value="1" {{ $deduction->type == 1 ? 'selected' : '' }}>Monthly</option>
                                            <option value="2" {{ $deduction->type == 2 ? 'selected' : '' }}>Semi-Monthly</option>
                                            <option value="3" {{ $deduction->type == 3 ? 'selected' : '' }}>Once</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <input type="number" class="form-control" name="amount" value="{{ $deduction->amount }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="effective_date">Effective Date</label>
                                        <input type="date" class="form-control" name="effective_date" value="{{ $deduction->effective_date ? \Carbon\Carbon::parse($deduction->effective_date)->format('Y-m-d') : '' }}">
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

    <!-- Add Deduction Modal -->
    <div class="modal fade" id="addDeductionModal" tabindex="-1" role="dialog" aria-labelledby="addDeductionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDeductionModalLabel">Add Deduction</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.member-deductions.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="member_id">Member</label>
                            <select class="form-control" name="member_id" required>
                                @foreach($members as $member)
                                    <option value="{{ $member->id }}">{{ $member->given_name }} {{ $member->surname }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="deduction_id">Deduction</label>
                            <select class="form-control" name="deduction_id" required>
                                @foreach($deductionsList as $d)
                                    <option value="{{ $d->id }}">{{ $d->deduction_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="type">Type</label>
                            <select class="form-control" name="type" required>
                                <option value="1">Monthly</option>
                                <option value="2">Semi-Monthly</option>
                                <option value="3">Once</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" class="form-control" name="amount" required>
                        </div>
                        <div class="form-group">
                            <label for="effective_date">Effective Date</label>
                            <input type="date" class="form-control" name="effective_date">
                        </div>
                        <button type="submit" class="btn btn-success">Add Deduction</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
