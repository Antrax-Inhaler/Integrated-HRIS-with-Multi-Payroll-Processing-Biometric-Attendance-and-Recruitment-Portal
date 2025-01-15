@include('admin.sidenav')
<section class="home-section" style="width: calc(100% - 58px); overflow:scroll">


<div class="container mt-5">
    <h2>Departments Management</h2>

    <!-- Button to trigger add department modal -->
    <button class="btn btn-success mb-3" data-toggle="modal" data-target="#addDepartmentModal">Add Department</button>

    <!-- Departments Table -->
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Department Name</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($departments as $department)
            <tr>
                <td>{{ $department->id }}</td>
                <td>{{ $department->department_name }}</td>
                <td>
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editDepartmentModal{{ $department->id }}">Edit</button>
                    <form action="{{ route('departments.destroy', $department->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>

            <!-- Edit Department Modal -->
            <div class="modal fade" id="editDepartmentModal{{ $department->id }}" tabindex="-1" role="dialog" aria-labelledby="editDepartmentModalLabel{{ $department->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editDepartmentModalLabel{{ $department->id }}">Edit Department</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('departments.update', $department->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <!-- Department Name -->
                                <div class="form-group">
                                    <label for="department_name">Department Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bx bx-building-house"></i> <!-- Changed icon class -->
                                        </span>
                                        <input type="text" class="form-control" name="department_name" value="{{ $department->department_name }}" required>
                                    </div>
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

<!-- Add Department Modal -->
<div class="modal fade" id="addDepartmentModal" tabindex="-1" role="dialog" aria-labelledby="addDepartmentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDepartmentModalLabel">Add Department</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('departments.store') }}" method="POST">
                    @csrf
                    <!-- Department Name -->
                    <div class="form-group">
                        <label for="department_name">Department Name</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bx bx-building-house"></i> <!-- Building icon -->
                            </span>
                            <input type="text" class="form-control" name="department_name" placeholder="Department Name" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Add Department</button>
                </form>
            </div>
        </div>
    </div>
</div>
</section>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
