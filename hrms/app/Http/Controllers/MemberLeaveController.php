<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth for authentication

class MemberLeaveController extends Controller
{
    public function index()
    {
        // Fetch leaves for the currently logged-in member
        $leaves = Leave::where('member_id', Auth::id())->get();
        
        // Return the view with leaves data
        return view('member.leave', compact('leaves'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string',
        ]);

        // Create leave entry for the currently logged-in member
        Leave::create([
            'member_id' => Auth::id(), // Set member_id to the current logged-in user ID
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,
            'status' => 'Pending', // Default status
        ]);

        return redirect()->route('member.leave.index')->with('success', 'Leave request added successfully.');
    }
    
    public function update(Request $request, Leave $leave)
    {
        // Ensure only the owner of the leave can update
        if ($leave->member_id != Auth::id()) {
            return redirect()->route('member.leave.index')->with('error', 'Unauthorized action.');
        }

        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string',
        ]);

        $leave->update($request->only(['start_date', 'end_date', 'reason']));

        return redirect()->route('member.leave.index')->with('success', 'Leave request updated successfully.');
    }

    public function destroy(Leave $leave)
    {
        // Ensure only the owner of the leave can delete
        if ($leave->member_id != Auth::id()) {
            return redirect()->route('member.leave.index')->with('error', 'Unauthorized action.');
        }

        $leave->delete();

        return redirect()->route('member.leave.index')->with('success', 'Leave request deleted successfully.');
    }
}
