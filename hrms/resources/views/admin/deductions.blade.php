@include('admin.sidenav')

<section class="home-section" style="width: calc(100% - 58px); overflow:scroll">
    <div class="container mt-5">
        <h2>Deductions Management</h2>

        <!-- Regular Deductions Table -->
        <h4>Regular Deductions</h4>
        <button class="btn btn-success mb-3" data-toggle="modal" data-target="#addDeductionModal">Add Deduction</button>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Deduction Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($deductions as $deduction)
                    <tr>
                        <td>{{ $deduction->id }}</td>
                        <td>{{ $deduction->deduction_name }}</td>
                        <td>{{ $deduction->description }}</td>
                        <td>
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editDeductionModal{{ $deduction->id }}">Edit</button>
                            <form action="{{ route('admin.deductions.destroy', $deduction->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <!-- Edit Regular Deduction Modal -->
                    <div class="modal fade" id="editDeductionModal{{ $deduction->id }}" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Deduction</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('admin.deductions.update', $deduction->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="deduction_name">Deduction Name</label>
                                            <input type="text" class="form-control" name="deduction_name" value="{{ $deduction->deduction_name }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea class="form-control" name="description" rows="4" required>{{ $deduction->description }}</textarea>
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

        <!-- Late Deductions Table -->
        <h4>Late Deductions</h4>
        <button class="btn btn-success mb-3" data-toggle="modal" data-target="#addLateDeductionModal">Add Late Deduction</button>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Amount</th>
                    <th>Effective Month</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lateDeductions as $lateDeduction)
                    <tr>
                        <td>{{ $lateDeduction->id }}</td>
                        <td>{{ $lateDeduction->amount }}</td>
                        <td>{{ $lateDeduction->effective_month }}</td>
                        <td>
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editLateDeductionModal{{ $lateDeduction->id }}">Edit</button>
                            <form action="{{ route('admin.deductions.destroyLateDeduction', $lateDeduction->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <!-- Edit Late Deduction Modal -->
                    <div class="modal fade" id="editLateDeductionModal{{ $lateDeduction->id }}" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Late Deduction</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('admin.deductions.updateLateDeduction', $lateDeduction->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="amount">Amount</label>
                                            <input type="number" class="form-control" name="amount" value="{{ $lateDeduction->amount }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="effective_month">Effective Month</label>
                                            <input type="date" class="form-control" name="effective_month" value="{{ $lateDeduction->effective_month }}" required>
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

    <!-- Add Regular Deduction Modal -->
    <div class="modal fade" id="addDeductionModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Deduction</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.deductions.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="deduction_name">Deduction Name</label>
                            <input type="text" class="form-control" name="deduction_name" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Add Deduction</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Late Deduction Modal -->
    <div class="modal fade" id="addLateDeductionModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Late Deduction</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.deductions.storeLateDeduction') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" class="form-control" name="amount" required>
                        </div>
                        <div class="form-group">
                            <label for="effective_month">Effective Month</label>
                            <input type="date" class="form-control" name="effective_month" required>
                        </div>
                        <button type="submit" class="btn btn-success">Add Late Deduction</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
