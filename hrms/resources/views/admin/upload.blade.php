@include('admin.sidenav')
<section class="home-section" style="width: calc(100% - 58px); overflow-x:scroll">

<div class="container">
    
    <h2>Upload Attendance File</h2>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Display error messages -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form for file upload -->
    <form action="{{ route('admin.upload.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="attendance_file">Choose Attendance File (Upload the file from the Exported Logs from Fingerprint Scannero)</label>
            <input type="file" class="form-control-file" id="attendance_file" name="attendance_file" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Upload</button>
    </form>

    <!-- Table for Latest Attendance -->
    <h3 class="mt-5">Latest Attendance Records</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Member ID</th>
                <th>Log Type</th>
                <th>Date & Time</th>
                <th>Source</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($latestAttendance as $attendance)
                <tr>
                    <td>{{ $attendance->member_id }}</td>
                    <td>{{ $attendance->log_type }}</td>
                    <td>{{ $attendance->datetime_log }}</td>
                    <td>{{ $attendance->source }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <!-- Pagination for Latest Attendance -->
    <div class="pagination-container">
        {{ $latestAttendance->links() }}
    </div>

    <!-- Table for All Attendance -->
    <h3 class="mt-5">All Attendance Records</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Member ID</th>
                <th>Log Type</th>
                <th>Date & Time</th>
                <th>Source</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allAttendance as $attendance)
                <tr>
                    <td>{{ $attendance->member_id }}</td>
                    <td>{{ $attendance->log_type }}</td>
                    <td>{{ $attendance->datetime_log }}</td>
                    <td>{{ $attendance->source }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination for All Attendance -->
    <div class="pagination-container">
        {{ $allAttendance->links() }}
    </div>

</div>

<style>
    .pagination-container {
        display: flex;
        justify-content: left;
        overflow: hidden; /* Hide overflow if necessary */
        width: 300px; /* Fixed width for the container */
        margin: 20px auto; /* Center the container with margin */
        height: 50px;
    }

    .pagination {
        display: flex;
    }

    .pagination a,
    .pagination span {
        margin: 0 5px;
        padding: 8px 12px;
        border: 1px solid #007bff; /* Change the border color */
        border-radius: 4px; /* Rounded corners */
        text-decoration: none;
        color: #007bff; /* Link color */
        font-weight: bold;
    }

    .pagination a:hover {
        background-color: #007bff; /* Background color on hover */
        color: white; /* Text color on hover */
    }

    .pagination .active {
        background-color: #007bff; /* Active page background color */
        color: white; /* Active page text color */
        border: 1px solid #007bff; /* Border to match */
    }
</style>
</section>
