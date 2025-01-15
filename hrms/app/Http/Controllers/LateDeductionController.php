<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LateDeduction;
use Illuminate\Http\Request;

class LateDeductionController extends Controller
{
    public function index()
    {
        $deductions = LateDeduction::all();
        return view('admin.deductions', compact('deductions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'effective_month' => 'required|date',
        ]);

        LateDeduction::create([
            'amount' => $request->amount,
            'effective_month' => $request->effective_month,
        ]);

        return redirect()->route('admin.deductions')->with('success', 'Deduction added successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'effective_month' => 'required|date',
        ]);

        $deduction = LateDeduction::findOrFail($id);
        $deduction->update([
            'amount' => $request->amount,
            'effective_month' => $request->effective_month,
        ]);

        return redirect()->route('admin.deductions')->with('success', 'Deduction updated successfully.');
    }

    public function destroy($id)
    {
        $deduction = LateDeduction::findOrFail($id);
        $deduction->delete();

        return redirect()->route('admin.deductions')->with('success', 'Deduction deleted successfully.');
    }
}
