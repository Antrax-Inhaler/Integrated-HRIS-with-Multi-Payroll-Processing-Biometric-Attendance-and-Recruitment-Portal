<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MemberDeduction;
use App\Models\Member;
use App\Models\Deduction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth for authentication

class MemberDeductionController extends Controller
{
    public function index()
    {
        $deductions = MemberDeduction::with(['member', 'deduction'])->get();
        $members = Member::all();
        $deductionsList = Deduction::all();

        return view('admin.member-deduction', compact('deductions', 'members', 'deductionsList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'deduction_id' => 'required|exists:deductions,id',
            'type' => 'required|integer',
            'amount' => 'required|numeric',
            'effective_date' => 'nullable|date',
        ]);

        MemberDeduction::create($request->all());

        return redirect()->route('admin.member-deductions.index')->with('success', 'Deduction added successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'deduction_id' => 'required|exists:deductions,id',
            'type' => 'required|integer',
            'amount' => 'required|numeric',
            'effective_date' => 'nullable|date',
        ]);

        $deduction = MemberDeduction::findOrFail($id);
        $deduction->update($request->all());

        return redirect()->route('admin.member-deductions.index')->with('success', 'Deduction updated successfully.');
    }

    public function destroy($id)
    {
        $deduction = MemberDeduction::findOrFail($id);
        $deduction->delete();

        return redirect()->route('admin.member-deductions.index')->with('success', 'Deduction deleted successfully.');
    }
    public function show(Request $request)
    {
        $userId = Auth::id(); // Get the ID of the currently logged-in user
    
        // Retrieve filter inputs
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $deductionName = $request->input('deduction_name');
    
        // Build query with optional filters
        $deductionsQuery = MemberDeduction::where('member_id', $userId);
    
        if ($startDate) {
            $deductionsQuery->whereDate('effective_date', '>=', $startDate);
        }
    
        if ($endDate) {
            $deductionsQuery->whereDate('effective_date', '<=', $endDate);
        }
    
        if ($deductionName) {
            $deductionsQuery->where('deduction_name', 'like', "%{$deductionName}%");
        }
    
        $deductions = $deductionsQuery->orderBy('effective_date', 'desc')->get();
    
        return view('member.deductions', compact('deductions', 'startDate', 'endDate', 'deductionName'));
    }
    
}
