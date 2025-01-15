@include('admin.sidenav')

<section class="home-section" style="width: calc(100% - 58px); overflow:scroll">
    <div class="container mt-5">
        <h2>Requirements Management</h2>

        <!-- Button to trigger add requirement modal -->
        <button class="btn btn-success mb-3" data-toggle="modal" data-target="#addRequirementModal">Add Requirement</button>
        <br>
        <br>
        <!-- Requirements Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Job Title</th>
                    <th>Requirement Name</th>
                    <th>File Path</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requirements as $requirement)
                    <tr>
                        <td>{{ $requirement->id }}</td>
                        <td>{{ $requirement->jobListing->job_title ?? 'N/A' }}</td>
                        <td>{{ $requirement->requirement_name }}</td>
                        <td>{{ $requirement->file_path }}</td>
                        <td>
                            <form action="{{ route('admin.requirements.destroy', $requirement->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Add Requirement Modal -->
    <div class="modal fade" id="addRequirementModal" tabindex="-1" role="dialog" aria-labelledby="addRequirementModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRequirementModalLabel">Add Requirement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.requirements.store') }}" method="POST">
                        @csrf
                        <!-- Job Listing Dropdown -->
                        <div class="form-group">
                            <label for="job_listing_id">Job Title</label>
                            <select name="job_listing_id" class="form-control" required>
                                <option value="">Select Job</option>
                                @foreach($jobListings as $jobListing)
                                    <option value="{{ $jobListing->id }}">{{ $jobListing->job_title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Requirement Name -->
                        <div class="form-group">
                            <label for="requirement_name">Requirement Name</label>
                            <input type="text" class="form-control" name="requirement_name" placeholder="Requirement Name" required>
                        </div>
                        <!-- File Path -->
                        <div class="form-group">
                            <label for="file_path">File Path</label>
                            <input type="text" class="form-control" name="file_path" placeholder="File Path" required>
                        </div>
                        <button type="submit" class="btn btn-success">Add Requirement</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
