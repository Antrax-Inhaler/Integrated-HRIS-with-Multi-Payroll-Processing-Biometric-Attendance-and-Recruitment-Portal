@include('admin.sidenav')

<section class="home-section" style="width: calc(100% - 58px); overflow:scroll">
    <div class="container mt-5">
        <h2>Holiday Listings</h2>
        <!-- Button to trigger add holiday modal -->
        <button class="btn btn-success mb-3" data-toggle="modal" data-target="#addHolidayModal">Add Holiday</button>
        <br>
        <br>
        <!-- Holiday Listings Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Holiday Date</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($holidays as $holiday)
                    <tr>
                        <td>{{ $holiday->id }}</td>
                        <td>{{ $holiday->holiday_date }}</td>
                        <td>{{ $holiday->name }}</td>
                        <td>{{ ucfirst($holiday->type) }}</td>
                        <td>
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editHolidayModal{{ $holiday->id }}">Edit</button>
                            <form action="{{ route('admin.holidays.destroy', $holiday->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Holiday Modal -->
                    <div class="modal fade" id="editHolidayModal{{ $holiday->id }}" tabindex="-1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Holiday</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('admin.holidays.update', $holiday->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="holiday_date">Holiday Date</label>
                                            <input type="date" name="holiday_date" class="form-control" value="{{ $holiday->holiday_date }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Holiday Name</label>
                                            <input type="text" name="name" class="form-control" value="{{ $holiday->name }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="type">Holiday Type</label>
                                            <select name="type" class="form-control">
                                                <option value="regular" {{ $holiday->type == 'regular' ? 'selected' : '' }}>Regular</option>
                                                <option value="special_non_working" {{ $holiday->type == 'special_non_working' ? 'selected' : '' }}>Special Non-Working</option>
                                            </select>
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

    <!-- Add Holiday Modal -->
    <div class="modal fade" id="addHolidayModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Holiday</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.holidays.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="holiday_date">Holiday Date</label>
                            <input type="date" name="holiday_date" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Holiday Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="type">Holiday Type</label>
                            <select name="type" class="form-control">
                                <option value="regular">Regular</option>
                                <option value="special_non_working">Special Non-Working</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Add Holiday</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>