@include('member.sidenav')
<section class="home-section" style="width: calc(100% - 58px); overflow: scroll">

    <div class="container mt-5">
        <div class="table-container">
            <h2>Your Attendance Records</h2>

            <!-- Filter Form -->
            <form method="GET" action="{{ route('member.attendance') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-3">
                        <label for="log_type">Log Type</label>
                        <select name="log_type" id="log_type" class="form-control">
                            <option value="">All</option>
                            <option value="AM IN" {{ request('log_type') == 'AM IN' ? 'selected' : '' }}>AM IN</option>
                            <option value="AM OUT" {{ request('log_type') == 'AM OUT' ? 'selected' : '' }}>AM OUT</option>
                            <option value="PM IN" {{ request('log_type') == 'PM IN' ? 'selected' : '' }}>PM IN</option>
                            <option value="PM OUT" {{ request('log_type') == 'PM OUT' ? 'selected' : '' }}>PM OUT</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="start_date">Start Date</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="end_date">End Date</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('member.attendance') }}" class="btn btn-secondary ml-2">Clear</a>
                    </div>
                </div>
            </form>

            <!-- Attendance Table -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Log Type</th>
                        <th>Date & Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attendance as $record)
                        <tr>
                            <td>{{ $record->id }}</td>
                            <td>{{ $record->log_type }}</td>
                            <td>{{ $record->datetime_log }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
