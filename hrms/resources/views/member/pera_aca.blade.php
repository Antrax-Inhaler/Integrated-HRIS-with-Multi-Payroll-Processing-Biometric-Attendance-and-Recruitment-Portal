@include('member.sidenav')
<style>

</style>
<section class="home-section" style="width: calc(100% - 58px); overflow: scroll">
    <h2>Pera/Aca Allowance</h2>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('member.pera_aca') }}" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <label for="month_year">Month & Year</label>
                <input type="month" name="month_year" id="month_year" class="form-control" value="{{ request('month_year') }}">
            </div>
            <div class="col-md-3">
                <label for="min_amount">Minimum Amount</label>
                <input type="number" name="min_amount" id="min_amount" class="form-control" value="{{ request('min_amount') }}" step="0.01" min="0">
            </div>
            <div class="col-md-3">
                <label for="max_amount">Maximum Amount</label>
                <input type="number" name="max_amount" id="max_amount" class="form-control" value="{{ request('max_amount') }}" step="0.01" min="0">
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('member.pera_aca') }}" class="btn btn-secondary ml-2">Clear</a>
            </div>
        </div>
    </form>

    <!-- Allowance Listing Table -->
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
            @foreach($allowances as $allowance)
                <tr>
                    <td>{{ $allowance->id }}</td>
                    <td>{{ $allowance->amount }}</td>
                    <td>{{ \Carbon\Carbon::parse($allowance->month_year)->format('F Y') }}</td>
                    <td>{{ $allowance->description }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
