@include('admin.sidenav')
<section class="home-section" style="width: calc(100% - 58px); overflow:scroll">
   <!-- Form to select month and calculate payroll -->

</head>
<body>

<!-- Button with Lordicon -->
<div class="payroll-button-container">
    <button class="payroll-round-button" id="payrollToggleButton">
        <lord-icon src="https://cdn.lordicon.com/mecwbjnp.json" 
                   trigger="hover" 
                   colors="primary:#9c27b0" 
                   style="width:50px;height:50px">
        </lord-icon>
    </button>
    <span class="payroll-hover-label">Create Job Order Hourly Payroll</span>
</div>

<!-- Card form (initially hidden) -->
<div class="payroll-card" id="payrollCard">
    <h1 class="payroll-header">Job Order Hourly</h1>
    <form action="{{ route('admin.payrollJO.store') }}" method="POST">
        @csrf
        <div class="payroll-form-group">
            <label class="payroll-label" for="dateFrom">Start Date:</label>
            <input type="date" id="dateFrom" name="dateFrom" class="payroll-input" required>
        </div>

        <div class="payroll-form-group">
            <label class="payroll-label" for="dateTo">End Date:</label>
            <input type="date" id="dateTo" name="dateTo" class="payroll-input" required>
        </div>

        <button type="submit" class="payroll-btn-compute">Compute Payroll</button>
    </form>
</div>

<script>
    // Toggle visibility of the card on button click
    document.getElementById('payrollToggleButton').addEventListener('click', function () {
        const card = document.getElementById('payrollCard');
        card.style.display = (card.style.display === 'none' || card.style.display === '') 
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
                <a href="{{ route('admin.payrollJO.show', $payroll->id) }}" class="btn btn-info">View Details</a>
                
                <!-- Update Status Form -->
                <form action="{{ route('admin.payrollJO.updateStatus', $payroll->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    <select name="status" onchange="this.form.submit()" class="form-control">
                        <option value="New" {{ $payroll->status == 'New' ? 'selected' : '' }}>New</option>
                        <option value="Computed" {{ $payroll->status == 'Computed' ? 'selected' : '' }}>Computed</option>
                        <option value="Paid" {{ $payroll->status == 'Paid' ? 'selected' : '' }}>Paid</option>
                    </select>
                </form>
    
                <!-- Delete Form -->
                <form action="{{ route('admin.payrollJO.destroy', $payroll->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this payroll?');">
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
<script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
<!-- Include necessary scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
