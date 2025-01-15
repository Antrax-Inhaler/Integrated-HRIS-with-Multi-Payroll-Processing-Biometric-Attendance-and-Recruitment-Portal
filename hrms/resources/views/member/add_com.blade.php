@include('member.sidenav')

<section class="home-section" style="width: calc(100% - 58px); overflow: scroll">
    <h2>Additional Commissions</h2>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('member.add_com') }}" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <label for="start_date">Start Date</label>
                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-3">
                <label for="end_date">End Date</label>
                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>
            <div class="col-md-3">
                <label for="description">Description</label>
                <input type="text" name="description" id="description" class="form-control" placeholder="Search description" value="{{ request('description') }}">
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('member.add_com') }}" class="btn btn-secondary ml-2">Clear</a>
            </div>
        </div>
    </form>

    <!-- Commissions Listing Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Amount</th>
                <th>Month & Year</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach($commissions as $commission)
                <tr>
                    <td>{{ $commission->id }}</td>
                    <td>{{ $commission->amount }}</td>
                    <td>{{ \Carbon\Carbon::parse($commission->month_year)->format('F Y') }}</td>
                    <td>{{ $commission->description }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
