<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Deduction;
use App\Models\LateDeduction;
use Illuminate\Http\Request;

class DeductionController extends Controller
{
    public function index()
    {
        $deductions = Deduction::all();
        $lateDeductions = LateDeduction::all(); // Fetch late deductions
        return view('admin.deductions', compact('deductions', 'lateDeductions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'deduction_name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Deduction::create($request->all());

        return redirect()->route('admin.deductions')->with('success', 'Deduction added successfully.');
    }

    public function storeLateDeduction(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'effective_month' => 'required|date',
        ]);
    
        // Extract year and month from the effective month
        $effectiveMonth = \Carbon\Carbon::parse($request->effective_month);
        $year = $effectiveMonth->year;
        $month = $effectiveMonth->month;
    
        // Check if a late deduction with the same month and year already exists
        $existingDeduction = LateDeduction::whereYear('effective_month', $year)
                                           ->whereMonth('effective_month', $month)
                                           ->first();
    
        if ($existingDeduction) {
            return redirect()->back()->with('error', 'A late deduction for this month and year already exists.');
        }
    
        // Create the new late deduction if no duplicate is found
        LateDeduction::create($request->all());
    
        return redirect()->route('admin.deductions')->with('success', 'Late deduction added successfully.');
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'deduction_name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $deduction = Deduction::findOrFail($id);
        $deduction->update($request->all());

        return redirect()->route('admin.deductions')->with('success', 'Deduction updated successfully.');
    }

    public function updateLateDeduction(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'effective_month' => 'required|date',
        ]);

        $lateDeduction = LateDeduction::findOrFail($id);
        $lateDeduction->update($request->all());

        return redirect()->route('admin.deductions')->with('success', 'Late deduction updated successfully.');
    }

    public function destroy($id)
    {
        $deduction = Deduction::findOrFail($id);
        $deduction->delete();

        return redirect()->route('admin.deductions')->with('success', 'Deduction deleted successfully.');
    }

    public function destroyLateDeduction($id)
    {
        $lateDeduction = LateDeduction::findOrFail($id);
        $lateDeduction->delete();

        return redirect()->route('admin.deductions')->with('success', 'Late deduction deleted successfully.');
    }
}
