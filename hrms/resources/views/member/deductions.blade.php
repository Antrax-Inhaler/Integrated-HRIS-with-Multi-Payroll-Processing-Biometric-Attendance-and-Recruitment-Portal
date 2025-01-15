@include('member.sidenav')

<section class="home-section" style="width: calc(100% - 58px); overflow: scroll">
    <h2>Member Deductions</h2>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('member.deductions') }}" class="mb-4">
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
                <label for="deduction_name">Deduction Name</label>
                <input type="text" name="deduction_name" id="deduction_name" class="form-control" placeholder="Search deduction name" value="{{ request('deduction_name') }}">
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('member.deductions') }}" class="btn btn-secondary ml-2">Clear</a>
            </div>
        </div>
    </form>

    <!-- Deductions Listing Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Deduction Name</th>
                <th>Type</th>
                <th>Amount</th>
                <th>Effective Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($deductions as $deduction)
                <tr>
                    <td>{{ $deduction->id }}</td>
                    <td>{{ $deduction->deduction_name }}</td>
                    <td>
                        @if($deduction->type == 1) Monthly
                        @elseif($deduction->type == 2) Semi-Monthly
                        @elseif($deduction->type == 3) Once
                        @endif
                    </td>
                    <td>{{ $deduction->amount }}</td>
                    <td>{{ $deduction->effective_date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
