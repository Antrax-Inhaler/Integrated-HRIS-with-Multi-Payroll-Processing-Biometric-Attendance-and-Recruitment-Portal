@include('admin.sidenav')
<section class="home-section" style="width: calc(100% - 58px); overflow:scroll">

<div class="container mt-5">
    <h2>Adjustment Management</h2>

    <!-- Button to trigger add bonus modal -->
    <button class="btn btn-success mb-3" data-toggle="modal" data-target="#addBonusModal">Add Adjustment</button>
    <br>
    <!-- Bonuses Table -->
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Adjustment Name</th>
            <th>Description</th>
            <th>Amount</th> <!-- Added Amount Column -->
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($bonuses as $bonus)
            <tr>
                <td>{{ $bonus->id }}</td>
                <td>{{ $bonus->bonus_name }}</td>
                <td>{{ $bonus->description }}</td>
                <td>{{ $bonus->amount }}</td> <!-- Display Amount -->
                <td>
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editBonusModal{{ $bonus->id }}">Edit</button>
                    <form action="{{ route('admin.bonuses.destroy', $bonus->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>

            <!-- Edit Bonus Modal -->
            <div class="modal fade" id="editBonusModal{{ $bonus->id }}" tabindex="-1" role="dialog" aria-labelledby="editBonusModalLabel{{ $bonus->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editBonusModalLabel{{ $bonus->id }}">Edit Bonus</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.bonuses.update', $bonus->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <!-- Bonus Name -->
                                <div class="form-group">
                                    <label for="bonus_name">Bonus Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bx bx-gift"></i>
                                        </span>
                                        <input type="text" class="form-control" name="bonus_name" value="{{ $bonus->bonus_name }}" required>
                                    </div>
                                </div>
                                <!-- Description -->
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" rows="4" required>{{ $bonus->description }}</textarea>
                                </div>
                                <!-- Amount -->
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="number" class="form-control" name="amount" value="{{ $bonus->amount }}" required>
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

<!-- Add Bonus Modal -->
<div class="modal fade" id="addBonusModal" tabindex="-1" role="dialog" aria-labelledby="addBonusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBonusModalLabel">Add Bonus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.bonuses.store') }}" method="POST">
                    @csrf
                    <!-- Bonus Name -->
                    <div class="form-group">
                        <label for="bonus_name">Adjustment Name</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bx bx-gift"></i>
                            </span>
                            <input type="text" class="form-control" name="bonus_name" placeholder="Bonus Name" required>
                        </div>
                    </div>
                    <!-- Description -->
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" rows="4" placeholder="Description" required></textarea>
                    </div>
                    <!-- Amount -->
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" class="form-control" name="amount" placeholder="Amount" required>
                    </div>
                    <button type="submit" class="btn btn-success">Add Adjustment</button>
                </form>
            </div>
        </div>
    </div>
</div>

</section>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
