@include('member.sidenav')

<section class="home-section" style="width: calc(100% - 58px); overflow: scroll">
    <h2>Member Bonuses</h2>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('member.bonuses') }}" class="mb-4">
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
                <label for="bonus_name">Bonus Name</label>
                <input type="text" name="bonus_name" id="bonus_name" class="form-control" placeholder="Search bonus name" value="{{ request('bonus_name') }}">
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('member.bonuses') }}" class="btn btn-secondary ml-2">Clear</a>
            </div>
        </div>
    </form>

    <!-- Bonuses Listing Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Bonus Name</th>
                <th>Amount</th>
                <th>Effective Date</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bonuses as $bonus)
                <tr>
                    <td>{{ $bonus->id }}</td>
                    <td>{{ $bonus->bonus_name }}</td>
                    <td>{{ $bonus->amount }}</td>
                    <td>{{ $bonus->effective_date }}</td>
                    <td>{{ $bonus->description }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
