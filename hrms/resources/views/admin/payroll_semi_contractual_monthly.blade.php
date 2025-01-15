@include('admin.sidenav')
<section class="home-section" style="width: calc(100% - 58px); overflow:scroll">
   <!-- Form to select month and calculate payroll -->
  <!-- Button with Lordicon -->
<div class="payroll-button-container">
    <button class="payroll-round-button" id="togglePayrollCSFormButton">
        <lord-icon src="https://cdn.lordicon.com/mecwbjnp.json" 
                   trigger="hover" 
                   colors="primary:#9c27b0" 
                   style="width:50px;height:50px">
        </lord-icon>
    </button>
    <span class="payroll-hover-label">Create Contractual Payroll</span>
</div>

<!-- Payroll Contractual Form (Initially Hidden) -->
<div class="payroll-card" id="payrollCSCard">
    <h1 class="payroll-header">Contractual Payroll (Semi-Monthy)</h1>
    <form action="{{ route('admin.payrollCS.store') }}" method="POST">
        @csrf
        <div class="payroll-form-group">
            <label class="payroll-label" for="month">Select Month:</label>
            <input type="month" id="month" name="month" class="payroll-input" required>
        </div>

        <div class="payroll-form-group">
            <label class="payroll-label" for="pay_period">Select Pay Period:</label>
            <select id="pay_period" name="pay_period" class="payroll-input" required>
                <option value="first">First Pay Period (1-15)</option>
                <option value="second">Second Pay Period (16-End)</option>
            </select>
        </div>

        <button type="submit" class="payroll-btn-compute">Compute Payroll</button>
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#payrollBreakdownModal">
            View Payroll Breakdown
        </button>
        
    </form>
</div>

<script>
    // Toggle visibility of the contractual payroll form
    document.getElementById('togglePayrollCSFormButton').addEventListener('click', function () {
        const csCard = document.getElementById('payrollCSCard');
        csCard.style.display = (csCard.style.display === 'none' || csCard.style.display === '') 
                                ? 'block' : 'none';
    });
</script>

<br>
   <table class="table table-bordered">
    <thead>
        <tr>
            <th>Reference No</th>
            <th>Date From</th>
            <th>Date To</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($payrolls as $payroll)
        <tr>
            <td>{{ $payroll->ref_no }}</td>
            <td>{{ \Carbon\Carbon::parse($payroll->date_from)->format('M d, Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($payroll->date_to)->format('M d, Y') }}</td>
            <td>{{ $payroll->status }}</td>
            <td>
                <a href="{{ route('admin.payrollCS.show', $payroll->id) }}" class="btn btn-info">View Details</a>
                
                <!-- Update Status Form -->
                <form action="{{ route('admin.payrollCS.updateStatus', $payroll->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    <select name="status" onchange="this.form.submit()" class="form-control">
                        <option value="New" {{ $payroll->status == 'New' ? 'selected' : '' }}>New</option>
                        <option value="Computed" {{ $payroll->status == 'Computed' ? 'selected' : '' }}>Computed</option>
                        <option value="Paid" {{ $payroll->status == 'Paid' ? 'selected' : '' }}>Paid</option>
                    </select>
                </form>
    
                <!-- Delete Form -->
                <form action="{{ route('admin.payrollCS.destroy', $payroll->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this payroll?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5" class="text-center">No payroll records available.</td>
        </tr>
    @endforelse
    
    </tbody>
</table>
<div class="modal fade" id="payrollBreakdownModal" tabindex="-1" aria-labelledby="payrollBreakdownModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="payrollBreakdownModalLabel">Payroll Calculation Breakdown</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body payroll-breakdown">
                <p><strong>Payroll Reference:</strong> A unique reference is created for each payroll period using the format <code>PAY-YYYY-MM-DD-HH-MM-SS</code>, ensuring traceability for the payroll record.</p>
                
                <h6>Payroll Period</h6>
                <p>
                    <strong>Start Date:</strong> Based on the pay period, either the 1st or 16th of the month.<br>
                    <strong>End Date:</strong> Either the 15th or the last day of the month. This defines the payroll period for processing.
                </p>

                <h6>Attendance Tracking</h6>
                <p>Each contractual-semi employee's attendance is evaluated for all weekdays in the selected period, excluding Sundays. Attendance logs are analyzed as follows:</p>
                <ul>
                    <li><strong>AM Hours:</strong> Calculated from AM IN to AM OUT. If an employee logs in after 8:00 AM, it is marked as a late arrival.</li>
                    <li><strong>PM Hours:</strong> Calculated from PM IN to PM OUT.</li>
                </ul>

                <h6>Total Hours Calculation</h6>
                <p>The total hours worked during AM and PM shifts are aggregated. Days with fewer than 8 logged hours are flagged for <strong>undertime</strong>, and extra hours on holidays qualify as <strong>holiday pay</strong>.</p>

                <h6>Working Days and Hourly Rate</h6>
                <p>The total working days for the period are calculated by excluding Sundays and holidays. Using the employee’s salary, the <strong>hourly rate</strong> is determined by: <code>hourlyRate = salary / (workingDays * 8)</code>.</p>

                <h6>Gross Salary</h6>
                <p>Gross salary comprises regular pay for hours worked, holiday pay, and allowances such as <strong>additional compensation</strong> and <strong>ACA</strong> allowances, if applicable.</p>

                <h6>Deductions</h6>
                <p>Deductions are calculated per employee, including penalties for lateness and undertime. The <strong>late deduction</strong> is calculated as the number of late occurrences multiplied by a set penalty rate.</p>

                <h6>Bonuses</h6>
                <p>Any eligible monthly bonuses are retrieved and added to the gross salary.</p>

                <h6>Net Salary</h6>
                <p>The final <strong>net salary</strong> is calculated as: <code>netSalary = grossSalary + bonuses - totalDeductions</code>.</p>

                <p>All these calculations are recorded in a <strong>payroll item</strong> entry, capturing each employee’s hourly rate, total hours, deductions, bonuses, and the computed net salary.</p>
            </div>
        </div>
    </div>
</div>
</section>

<!-- Include necessary scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style>
    .payroll-breakdown {
        font-family: Arial, sans-serif;
        color: #333;
        padding: 20px;
        line-height: 1.6;
        background-color: #f9f9f9;
        border-radius: 8px;
    }
    
    .payroll-breakdown h5 {
        font-size: 1.25rem;
        color: #007bff;
        border-bottom: 2px solid #007bff;
        padding-bottom: 8px;
        margin-bottom: 12px;
    }
    
    .payroll-breakdown h6 {
        font-size: 1rem;
        color: #333;
        margin-top: 15px;
        font-weight: 600;
    }
    
    .payroll-breakdown p {
        margin-bottom: 10px;
        font-size: 0.95rem;
        color: #555;
    }
    
    .payroll-breakdown strong {
        color: #007bff;
    }
    
    .payroll-breakdown ul {
        list-style-type: disc;
        margin-left: 20px;
    }
    
    .payroll-breakdown li {
        margin-bottom: 5px;
    }
    
    .payroll-breakdown code {
        background-color: #e9ecef;
        padding: 2px 5px;
        font-size: 0.9rem;
        border-radius: 4px;
        color: #d63384;
    }
    
    .payroll-breakdown p:last-of-type {
        margin-top: 15px;
        font-style: italic;
    }
    </style>