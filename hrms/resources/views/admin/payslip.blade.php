<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll Slip</title>
    <style>
        body {
            font-family: "Times New Roman", sans-serif;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            max-height: 900px;
        }
        td, th {
            padding: 5px;
            border: 1px solid black;
            text-align: right;
            vertical-align: top;
        }
        .header {
            text-align: left;
            font-weight: bold;
        }
        .title {
            font-weight: bold;
            text-align: left !important;
        }
        .green {
            color: green;
        }
        .red {
            color: red;
        }
        .underline {
        }
    </style>
</head>
<body>

    @foreach ($payrollData as $data)
    <table>

        @php
            $item = $data['item']; // Payroll item details
            $bonuses = $data['bonuses'];
            $deductions = $data['deductions'];

            // Determine how many rows to display (minimum 10 rows)
            $maxRows = max(8, max(count($bonuses), count($deductions)));
        @endphp

        <tr>
            <td colspan="6" class="header">DEPARTMENT OF AGRICULTURE(REGION IV-B MIMAROPA)</td>
        </tr>
        <tr>
            <td colspan="3" class="header">REGIONAL OFFICE</td>
            <td colspan="3" class="header" style="text-align: right;">Pay Slip</td>

        </tr>
        <tr>
            @php
    $surname = strtoupper($item->member->surname);
    $firstName = strtoupper($item->member->given_name);
    $middleInitial = $item->member->middle_name ? strtoupper(substr($item->member->middle_name, 0, 1)) . '.' : '';
@endphp

<td class="member-name title" colspan="3">
    {{ $firstName }}, {{ $surname }} {{ $middleInitial }}
</td>
            <td colspan="3" class="month-year"><b>{{ now()->format('F Y') }}</b></td>

        </tr>
        <tr>
            <td>Monthly Rate</td>
            <td>{{ number_format($item->basic_salary, 2) }}</td>
            <td>Lates</td>
            <td>{{ $item->late_count }}</td>
            <td class="green" >Gross</td>
            <td>{{ number_format($item->gross_salary, 2) }}</td>
        </tr>
        <tr>
            <td>Pera/Aca</td>
            <td>{{ number_format($item->pera_aca_total, 2) }}</td>
            <td>Amount</td>
            <td>{{ number_format($item->late_deduction, 2) }}</td>
            <td>Adjustment</td>
            <td>{{ number_format($item->adjustment_amount, 2) }}</td>
        </tr>
        <tr>
            <td>Add/Com</td>
            <td>{{ number_format($item->add_com_total, 2) }}</td>
            <td>Undertime</td>
            <td>{{ $item->undertime_hours }}</td>
            <td>Deductions</td>
            <td>{{ number_format($item->total_deductions, 2) }}</td>
        </tr>
        <tr>
            <td>Days</td>
            <td>-</td>
            <td>Amount</td>
            <td>{{ number_format($item->undertime_deduction, 2) }}</td>
            <td>Net Pay</td>
            <td>{{ number_format($item->net_salary, 2) }}</td>
        </tr>
        <tr>
            <td colspan="3" class="green underline" style="text-align: center;">Adjustments</td>
            <td colspan="3" class="red underline" style="text-align: center;">Deductions</td>
        </tr>

        @for ($i = 0; $i < $maxRows; $i++)
            <tr>
                <td class="bonus-name" colspan="2">
                    {{ $bonuses[$i]->bonus_name ?? '' }}
                </td>
                <td class="bonus-amount">
                    {{ isset($bonuses[$i]) ? number_format($bonuses[$i]->amount, 2) : '0.00' }}
                </td>
                <td class="deduction-name" colspan="2">
                    {{ $deductions[$i]->deduction_name ?? '' }}
                </td>
                <td class="deduction-amount">
                    {{ isset($deductions[$i]) ? number_format($deductions[$i]->amount, 2) : '0.00' }}
                </td>
            </tr>
        @endfor
    </table>
    <br>
    @endforeach
    
</body>
</html>
