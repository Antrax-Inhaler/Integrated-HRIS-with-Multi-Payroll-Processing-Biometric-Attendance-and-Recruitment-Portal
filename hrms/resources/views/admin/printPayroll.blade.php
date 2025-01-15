<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payroll</title>
    <style>
        @page {
            margin: 20px;
            footer: html_pdfFooter; /* Define footer section */
            
        }
        .pagenum:before {
        content: counter(page);
    }
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 12in;
            margin: auto;
            padding: 20px;
            box-sizing: border-box;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 18px;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #333;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        
        .footer {
            text-align: center;
            font-size: 12px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>DEPARTMENT OF AGRICULTURE(REGION IV-B MIMAROPA) REGIONAL OFFICE</h1>
            <h2>Payroll for Permanent Employees</h2>
            <p>{{ \Carbon\Carbon::parse($payroll->date_from)->format('F d, Y') }} to {{ \Carbon\Carbon::parse($payroll->date_to)->format('F d, Y') }}</p>
        </div>

        <!-- Payroll Table -->
        <table>
            <thead>
                <tr>
                    <th>Member Name</th>
                    <th>Basic Salary</th>
                    <th>Total Hours</th>
                    <th>Hourly Rate</th>
                    <th>Gross Salary</th>
                    <th>Add Com</th>
                    <th>Pera Aca</th>
                    <th>Late Deduction</th>
                    <th>Late Count</th>  
                    <th>Undertime Hours</th>
                    <th>Undertime Deduction</th>
                    <th>Total Deductions</th>
                    <th>Net Salary</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalBasicSalary = $totalGrossSalary = $totalAddCom = $totalPeraAca = $totalLateDeduction = $totalUndertimeHours = $totalUndertimeDeduction = $totalDeductions = $totalNetSalary = 0;
                @endphp
                @foreach ($payroll->payrollItems as $item)
                    <tr>
                        <td>{{ $item->member->given_name }}, {{ $item->member->middle_name }}, {{ $item->member->surname }}</td>
                        <td>P{{ number_format($item->basic_salary, 2) }}</td>
                        <td>{{ $item->total_hours }}</td>
                        <td>P{{ number_format($item->hourly_rate, 2) }}</td>
                        <td>P{{ number_format($item->gross_salary, 2) }}</td>
                        <td>P{{ number_format($item->add_com_total ?? 0, 2) }}</td>
                        <td>P{{ number_format($item->pera_aca_total ?? 0, 2) }}</td>
                        <td>P{{ number_format($item->late_deduction, 2) }}</td>
                        <td>{{ $item->late_count }}</td>
                        <td>P{{ number_format($item->undertime_hours ?? 0, 2) }}</td>
                        <td>P{{ number_format($item->undertime_deduction ?? 0, 2) }}</td>
                        <td>P{{ number_format($item->deductions, 2) }}</td>
                        <td>P{{ number_format($item->net_salary, 2) }}</td>
                    </tr>
                    @php
                        $totalBasicSalary += $item->basic_salary;
                        $totalGrossSalary += $item->gross_salary;
                        $totalAddCom += $item->add_com_total ?? 0;
                        $totalPeraAca += $item->pera_aca_total ?? 0;
                        $totalLateDeduction += $item->late_deduction;
                        $totalUndertimeHours += $item->undertime_hours ?? 0;
                        $totalUndertimeDeduction += $item->undertime_deduction ?? 0;
                        $totalDeductions += $item->totalDeductions;
                        $totalNetSalary += $item->net_salary;
                    @endphp
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Total</th>
                    <th>{{ number_format($totalBasicSalary, 2) }}</th>
                    <th>-</th>
                    <th>-</th>
                    <th>P{{ number_format($totalGrossSalary, 2) }}</th>
                    <th>P{{ number_format($totalAddCom, 2) }}</th>
                    <th>P{{ number_format($totalPeraAca, 2) }}</th>
                    <th>P{{ number_format($totalLateDeduction, 2) }}</th>
                    <th>-</th>
                    <th>P{{ number_format($totalUndertimeHours, 2) }}</th>
                    <th>P{{ number_format($totalUndertimeDeduction, 2) }}</th>
                    <th>P{{ number_format($totalDeductions, 2) }}</th>
                    <th>P{{ number_format($totalNetSalary, 2) }}</th>
                </tr>
            </tfoot>
        </table>
        
    </div>

    <!-- Page Footer Section -->
    <htmlpagefooter name="pdfFooter">
        <div class="footer">
            <span class="pagenum"></span>
        </div>
    </htmlpagefooter>
</body>
</html>
