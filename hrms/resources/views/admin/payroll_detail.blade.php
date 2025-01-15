@include('admin.sidenav')
<!-- Payroll Detail Page -->
<section class="home-section" style="width: calc(100% - 58px); overflow-x:scroll">
<h1>Payroll Details for {{ \Carbon\Carbon::parse($payroll->date_from)->format('F Y') }}</h1>
<br>
<style>
    .button-navigations{
        display: flex;
        justify-content: space-between;
    }
    .btn-warning{
        background-color: #FFC107;
    }
</style>
<!-- Payroll Table -->
<div class="button-navigations">
    <form action="{{ route('admin.payroll.recalculate', $payroll->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-warning">
            <i class="fas fa-sync-alt"></i> Recalculate Payroll
        </button>
    </form>
    <div class="left-buttons">
        <a href="{{ route('admin.payroll.print', $payroll->id) }}" target="_blank" class="btn btn-success">
            <i class="fas fa-print"></i> Print Payroll
        </a>
        <a href="{{ route('admin.payslip.printAll', $payroll->id) }}" target="_blank" class="btn btn-primary mb-3">
            <i class="fas fa-file-invoice"></i> Print Payslips
        </a>
    </div>
</div>
<br>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Member Name</th>
            <th>Basic Salary</th>
            <th>Total Hours</th>
            <th>Hourly Rate</th>
            <th>Gross Salary</th>
            <th>Add Com</th> <!-- New Column -->
            <th>Pera Aca</th>
            <th>Late Deduction</th> <!-- New Column -->
            <th>Late Count</th>  
            <th>Undertime Hours</th> <!-- New Column -->
            <th>Undertime Deduction</th> <!-- New Column -->
            <th>Deductions</th>
            <th>Net Salary</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($payroll->payrollItems as $item)
            <tr>
                <td>{{ $item->member->given_name }}, {{ $item->member->middle_name }},  {{ $item->member->surname }}</td>
                <td>{{ $item->basic_salary }}</td>
                <td>{{ $item->total_hours }}</td>
                <td>{{ $item->hourly_rate }}</td>
                <td>{{ $item->gross_salary }}</td>
                <td>{{ $item->add_com_total ?? '0.00' }}</td> <!-- Display Add Com -->
                <td>{{ $item->pera_aca_total ?? '0.00' }}</td> <!-- Display Pera Aca -->
                <td>{{ $item->late_deduction }}</td> <!-- Late Deduction Data -->
                <td>{{ $item->late_count }}</td>     <!-- Late Count Data -->
                <td>{{ $item->undertime_hours ?? '0.00' }}</td> <!-- Undertime Hours Data -->
                <td>{{ $item->undertime_deduction ?? '0.00' }}</td> <!-- Undertime Deduction Data -->
                <td>{{ $item->totalDeductions }}</td>
                <td>{{ $item->net_salary }}</td>
                <td>
                    <!-- Button to Trigger Modal -->
                    <button class="btn btn-primary" data-toggle="modal" data-target="#payslipModal{{ $item->id }}">
                        View Payslip
                    </button>

                    <!-- Payslip Modal -->
                    <div class="modal fade" id="payslipModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="payslipModalLabel{{ $item->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="payslipModalLabel{{ $item->id }}">Payslip for {{ $item->member->full_name }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @include('admin.payslip_detail_modal', ['payrollItem' => $item, 'attendances' => $item->attendances, 'deductions' => $item->deductions, 'bonuses' => $item->bonuses, 'totalHoursWorked' => $item->totalHoursWorked, 'totalDeductions' => $item->totalDeductions, 'totalBonuses' => $item->totalBonuses])
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>

</table>



</section>


</script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
