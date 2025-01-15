<div>
    <h5>Member: {{ $payrollItem->member->given_name }} {{ $payrollItem->member->middle_name }} {{ $payrollItem->member->surname }}</h5>
    <p>Basic Salary: {{ $payrollItem->basic_salary }}</p>
    <p>Gross Salary: {{ $payrollItem->gross_salary }}</p>
    <p>Deductions: {{ $totalDeductions }}</p>
    <p>Bonuses: {{ $totalBonuses }}</p>
    <p>Net Salary: {{ $payrollItem->net_salary }}</p>
    
    <hr>
    
    <h6>Attendance Details</h6>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date</th>
                <th>AM IN</th>
                <th>AM OUT</th>
                <th>PM IN</th>
                <th>PM OUT</th>
                <th>Total Hours</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payroll->payrollItems as $item)
                @foreach($item->groupedAttendances as $attendance)
                    <tr>
                        <td>{{ $attendance['date'] }}</td>
                        <td>{{ $attendance['am_in'] ?? 'N/A' }}</td>
                        <td>{{ $attendance['am_out'] ?? 'N/A' }}</td>
                        <td>{{ $attendance['pm_in'] ?? 'N/A' }}</td>
                        <td>{{ $attendance['pm_out'] ?? 'N/A' }}</td>
                        <td>{{ $attendance['total_hours'] }} hours</td>
                    </tr>
                @endforeach
            @endforeach
            <tr>
                <td>Total Hours: <p>{{ $payrollItem->total_hours }}</p></td>
            </tr>
        </tbody>
    </table>
    
    
    
    
    <hr>
    
    <h6>Deductions</h6>
    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($deductions as $deduction)
                <tr>
                    <td>{{ $deduction->description }}</td>
                    <td>{{ $deduction->amount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <h6>Total Deductions: {{ $totalDeductions }}</h6>
    
    <hr>
    
    <h6>Bonuses</h6>
    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bonuses as $bonus)
                <tr>
                    <td>{{ $bonus->description }}</td>
                    <td>{{ $bonus->amount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <h6>Total Bonuses: {{ $totalBonuses }}</h6>
</div>
