<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\MemberBonus; // We will call it "Adjustment" in the view
use Illuminate\Http\Request;

class AdjustmentController extends Controller
{
    // Show the list of adjustments
    public function index()
    {
        $adjustments = MemberBonus::all(); // Fetch all adjustments (from the member_bonuses table)
        $members = Member::all(); // Fetch members for the dropdown
        return view('admin.adjustment', compact('adjustments', 'members'));
    }

    // Store a new adjustment
    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required',
            'bonus_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric',
            'effective_date' => 'required|date',
        ]);

        MemberBonus::create($request->all());
        return redirect()->back()->with('success', 'Adjustment added successfully.');
    }

    // Update an existing adjustment
    public function update(Request $request, $id)
    {
        $request->validate([
            'member_id' => 'required',
            'bonus_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric',
            'effective_date' => 'required|date',
        ]);

        $adjustment = MemberBonus::find($id);
        $adjustment->update($request->all());

        return redirect()->back()->with('success', 'Adjustment updated successfully.');
    }

    // Delete an adjustment
    public function destroy($id)
    {
        $adjustment = MemberBonus::find($id);
        $adjustment->delete();

        return redirect()->back()->with('success', 'Adjustment deleted successfully.');
    }
}
