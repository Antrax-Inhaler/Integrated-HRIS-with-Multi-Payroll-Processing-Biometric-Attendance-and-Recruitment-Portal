<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MemberBonus;
use App\Models\Member;

class IssueBonusController extends Controller
{
    // Display the form to issue a bonus
    public function create()
    {
        $members = Member::all();
        $upcomingBonuses = MemberBonus::where('effective_date', '>', now())->get();
        $pastBonuses = MemberBonus::where('effective_date', '<=', now())->get();

        return view('admin.payroll.issue-bonus', compact('members', 'upcomingBonuses', 'pastBonuses'));
    }

    // Store the issued bonus
    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'bonus_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0',
            'effective_date' => 'required|date',
        ]);

        MemberBonus::create($request->all());

        return redirect()->back()->with('success', 'Bonus issued successfully!');
    }

    // Display the form for editing the specified bonus
    public function edit($id)
    {
        $bonus = MemberBonus::findOrFail($id);
        $members = Member::all();
        return response()->json([
            'bonus' => $bonus,
            'members' => $members,
        ]);
    }

    // Update the specified bonus in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'bonus_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0',
            'effective_date' => 'required|date',
        ]);

        $bonus = MemberBonus::findOrFail($id);
        $bonus->update($request->all());

        return redirect()->route('bonus.create')->with('success', 'Bonus updated successfully!');
    }

    // Delete the specified bonus
    public function destroy($id)
    {
        $bonus = MemberBonus::findOrFail($id);
        $bonus->delete();

        return redirect()->route('bonus.create')->with('success', 'Bonus deleted successfully!');
    }
}
