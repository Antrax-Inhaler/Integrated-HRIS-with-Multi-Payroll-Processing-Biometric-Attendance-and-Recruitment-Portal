@include('admin.sidenav')
<section class="home-section" style="width: calc(100% - 58px); overflow: scroll">

<h2>Job Applications</h2>

@if (session('success'))
    <div>{{ session('success') }}</div>
@endif
<div class="table-container">
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Job Title</th>
            <th>Applicant Name</th>
            <th>Status</th>
            <th>Date Applied</th>
            <th>View PDS</th> <!-- New column for viewing the PDS -->
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($applications as $application)
            <tr>
                <td>{{ $application->jobListing->job_title }}</td>
                <td>{{ $application->applicant->name }}</td>
                <td>{{ $application->status }}</td>
                <td>{{ $application->created_at->format('m/d/Y') }}</td>
                <td>
                    <form action="{{ route('applicant.pds', $application->applicant->id) }}" method="GET" target="_blank">
                        @csrf
                        <button type="submit" class="btn btn-info">View PDS</button>
                    </form>
                </td>
                
                <td>
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#updateModal{{ $application->id }}">Update</button>
                </td>
            </tr>

            <!-- Update Modal -->
            <div class="modal fade" id="updateModal{{ $application->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> 
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('admin.job-applications.update', $application->id) }}">
                            @csrf
                            @method('PATCH')
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Update Application</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Status Dropdown -->
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status-{{ $application->id }}" class="form-control status-selector" required>
                                        <option value="Pending" {{ $application->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Interview" {{ $application->status == 'Interview' ? 'selected' : '' }}>Interview</option>
                                        <option value="Offered" {{ $application->status == 'Offered' ? 'selected' : '' }}>Offered</option>
                                        <option value="Rejected" {{ $application->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                </div>
            
                                <!-- General Comment -->
                                <div class="form-group">
                                    <label for="comment">Comment</label>
                                    <textarea name="comment" id="comment" rows="3" class="form-control">{{ $application->comment }}</textarea>
                                </div>
            
                                <!-- Fields for "Interview" -->
                                <div class="interview-fields" style="display: none;">
                                    <div class="form-group">
                                        <label for="interview_date">Interview Date</label>
                                        <input type="datetime-local" name="interview_date" id="interview_date" class="form-control" value="{{ $application->interview_date }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="interview_location">Interview Location</label>
                                        <input type="text" name="interview_location" id="interview_location" class="form-control" value="{{ $application->interview_location }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="interviewer_name">Interviewer Name</label>
                                        <input type="text" name="interviewer_name" id="interviewer_name" class="form-control" value="{{ $application->interviewer_name }}">
                                    </div>
                                </div>
            
                                <!-- Fields for "Rejected" -->
                                <div class="rejection-fields" style="display: none;">
                                    <div class="form-group">
                                        <label for="rejection_reason">Rejection Reason</label>
                                        <textarea name="rejection_reason" id="rejection_reason" rows="3" class="form-control">{{ $application->rejection_reason }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update Application</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        @empty
            <tr>
                <td colspan="5">No job applications found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
</div>
</section>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    // Select all modals by their unique ID or class
    const modals = document.querySelectorAll('.modal');

    modals.forEach(modal => {
        const statusSelector = modal.querySelector('.status-selector');
        const interviewFields = modal.querySelector('.interview-fields');
        const rejectionFields = modal.querySelector('.rejection-fields');

        function toggleFields() {
            const status = statusSelector.value;
            if (status === 'Interview') {
                interviewFields.style.display = 'block';
                rejectionFields.style.display = 'none';
            } else if (status === 'Rejected') {
                interviewFields.style.display = 'none';
                rejectionFields.style.display = 'block';
            } else {
                interviewFields.style.display = 'none';
                rejectionFields.style.display = 'none';
            }
        }

        // Run toggleFields on page load
        toggleFields();

        // Add change event listener to the status selector
        statusSelector.addEventListener('change', toggleFields);
    });
});

</script>