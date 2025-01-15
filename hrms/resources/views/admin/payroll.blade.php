@include('admin.sidenav')
<section class="home-section" style="width: calc(100% - 58px); overflow:scroll">
   <!-- Form to select month and calculate payroll -->
   <div class="payroll-button-container">
    <button class="payroll-round-button" id="togglePayrollFormButton">
        <lord-icon src="https://cdn.lordicon.com/mecwbjnp.json" 
                   trigger="hover" 
                   colors="primary:#9c27b0" 
                   style="width:50px;height:50px">
        </lord-icon>
    </button>
    <span class="payroll-hover-label">Create Regular Payroll</span>
</div>

<!-- Payroll Regular Form (Initially Hidden) -->
<div class="payroll-card" id="payrollRegularCard">
    <h1 class="payroll-header">Regular Payroll 
        <!-- Info Icon with Tooltip -->
    </h1>
    <form action="{{ route('admin.payroll.store') }}" method="POST">
        @csrf
        <div class="payroll-form-group">
            <label class="payroll-label" for="month">Select Month:</label>
            <input type="month" id="month" name="month" class="payroll-input" required>
        </div>
        <button type="submit" class="payroll-btn-compute">Compute Payroll</button>
    </form>
    
    <!-- Button to trigger modal for detailed explanation -->
    <button type="button" class="btn btn-link" data-toggle="modal" data-target="#payrollInfoModal">How Payroll is Computed</button>
</div>
<br>

<!-- Payroll Explanation Modal -->
<div class="modal fade" id="payrollInfoModal" tabindex="-1" role="dialog" aria-labelledby="payrollInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="payrollInfoModalLabel">Payroll Calculation Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body payroll-breakdown">
                <h5>Payroll Calculation Breakdown</h5>
                
                <p><strong>Payroll Reference:</strong> A unique reference number is generated for each payroll run based on the date and time in the format: <code>PAY-YYYY-MM-DD-HH-MM-SS</code>. This reference helps in identifying the payroll record for the specific month.</p>
                
                <h6>Payroll Period</h6>
                <p>
                    <strong>Start Date:</strong> The first day of the selected month, calculated by setting the date to the beginning of the month.<br>
                    <strong>End Date:</strong> The last day of the selected month, calculated by setting the date to the end of the month. These dates frame the period for which payroll is computed.
                </p>
            
                <h6>Employee Attendance Calculation</h6>
                <p>Each permanent employee's attendance is retrieved for the payroll period, excluding Sundays. For each day:</p>
                <ul>
                    <li><strong>AM Hours:</strong> Hours worked between AM IN and AM OUT are calculated. If AM IN is after 8:00 AM, a late penalty is added.</li>
                    <li><strong>PM Hours:</strong> Hours worked between PM IN and PM OUT are calculated.</li>
                </ul>
            
                <h6>Total Hours Calculation</h6>
                <p>The total hours worked are the sum of AM and PM hours. Days with less than 8 hours logged are counted towards <strong>undertime</strong>, while extra hours on holidays are calculated as <strong>holiday pay</strong>.</p>
            
                <h6>Working Days and Hourly Rate</h6>
                <p>Working days are dynamically calculated based on weekdays within the payroll period. Using the employee's salary and working days, the <strong>hourly rate</strong> is determined as: <code>hourlyRate = salary / (workingDays * 8)</code>.</p>
            
                <h6>Gross Salary</h6>
                <p>Gross salary includes regular wages based on total hours worked, holiday pay, and any monthly allowances (e.g., <strong>additional compensation</strong> and <strong>ACA</strong> allowances).</p>
            
                <h6>Deductions</h6>
                <p>Specific deductions apply per employee, including penalties for lateness and undertime deductions. The <strong>late deduction</strong> is calculated by multiplying the late count by a penalty rate.</p>
            
                <h6>Bonuses</h6>
                <p>Eligible bonuses are added based on the employee's bonus records for the month.</p>
            
                <h6>Net Salary</h6>
                <p>The final <strong>net salary</strong> is calculated as: <code>netSalary = grossSalary + bonuses - totalDeductions</code>.</p>
            
                <p>All these calculations are saved in a <strong>payroll item</strong> record, which includes hourly rates, totals for regular and holiday hours, deductions, bonuses, and the final net salary for each employee.</p>
            </div>
            
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
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
<script>
    // Enable Bootstrap tooltip
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });

    // Toggle visibility of the regular payroll form
    document.getElementById('togglePayrollFormButton').addEventListener('click', function () {
        const regularCard = document.getElementById('payrollRegularCard');
        regularCard.style.display = (regularCard.style.display === 'none' || regularCard.style.display === '') 
                                    ? 'block' : 'none';
    });
</script>

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
                <a href="{{ route('admin.payroll.show', $payroll->id) }}" class="btn btn-info">View Details</a>
                
                <!-- Update Status Form -->
                <form action="{{ route('admin.payroll.updateStatus', $payroll->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    <select name="status" onchange="this.form.submit()" class="form-control">
                        <option value="New" {{ $payroll->status == 'New' ? 'selected' : '' }}>New</option>
                        <option value="Computed" {{ $payroll->status == 'Computed' ? 'selected' : '' }}>Computed</option>
                        <option value="Paid" {{ $payroll->status == 'Paid' ? 'selected' : '' }}>Paid</option>
                    </select>
                </form>

                <!-- Delete Form -->
                <form action="{{ route('admin.payroll.destroy', $payroll->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this payroll?');">
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
</section>

<!-- Include necessary scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    // Toggle visibility of the regular payroll form
    document.getElementById('togglePayrollFormButton').addEventListener('click', function () {
        const regularCard = document.getElementById('payrollRegularCard');
        regularCard.style.display = (regularCard.style.display === 'none' || regularCard.style.display === '') 
                                    ? 'block' : 'none';
    });
</script>

