@include('admin.sidenav')
<section class="home-section" style="width: calc(100% - 58px); overflow:scroll">
    <style>

    </style>
    <div class="container mt-5">
        <h2>Positions Management</h2>

        <!-- Button to trigger add position modal -->
        <button class="btn btn-success mb-3" data-toggle="modal" data-target="#addPositionModal">Add Position</button>

        <!-- Positions Table -->
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Position Name</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($positions as $position)
                <tr>
                    <td>{{ $position->id }}</td>
                    <td>{{ $position->position_name }}</td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editPositionModal{{ $position->id }}">Edit</button>
                        <form action="{{ route('admin.positions.destroy', $position->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>

                <!-- Edit Position Modal -->
                <div class="modal fade" id="editPositionModal{{ $position->id }}" tabindex="-1" role="dialog" aria-labelledby="editPositionModalLabel{{ $position->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editPositionModalLabel{{ $position->id }}">Edit Position</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.positions.update', $position->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="position_name">Position Name</label>
                                        <input type="text" class="form-control" name="position_name" value="{{ $position->position_name }}" required>
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

    <!-- Add Position Modal -->
    <div class="modal fade" id="addPositionModal" tabindex="-1" role="dialog" aria-labelledby="addPositionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPositionModalLabel">Add Position</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.positions.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="position_name">Position Name</label>
                            <input type="text" class="form-control" name="position_name" placeholder="Position Name" required>
                        </div>
                        <button type="submit" class="btn btn-success">Add Position</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
