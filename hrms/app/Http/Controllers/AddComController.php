<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AddCom;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;
class AddComController extends Controller
{
    public function display(Request $request)
    {
        $userId = Auth::id(); // Get the ID of the currently logged-in user
    
        // Retrieve filter inputs
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $description = $request->input('description');
    
        // Build query with optional filters
        $commissionsQuery = AddCom::where('member_id', $userId);
    
        if ($startDate) {
            $commissionsQuery->whereDate('month_year', '>=', $startDate);
        }
    
        if ($endDate) {
            $commissionsQuery->whereDate('month_year', '<=', $endDate);
        }
    
        if ($description) {
            $commissionsQuery->where('description', 'like', "%{$description}%");
        }
    
        $commissions = $commissionsQuery->orderBy('month_year', 'desc')->get();
    
        return view('member.add_com', compact('commissions', 'startDate', 'endDate', 'description'));
    }
    
    // Display the allowances page
    public function index()
    {
        $addComs = AddCom::all();
        $members = Member::all();
        return view('admin.add_com', compact('addComs', 'members'));
    }

    // Store a new record
    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'amount' => 'required|numeric',
            'month_year' => 'required|date',
            'description' => 'required|string|max:255',
        ]);

        AddCom::create($request->all());

        return redirect()->route('admin.add_com.index')->with('success', 'Record added successfully.');
    }

    // Update an existing record
    public function update(Request $request, $id)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'amount' => 'required|numeric',
            'month_year' => 'required|date',
            'description' => 'required|string|max:255',
        ]);

        $addCom = AddCom::findOrFail($id);
        $addCom->update($request->all());

        return redirect()->route('admin.add_com.index')->with('success', 'Record updated successfully.');
    }

    // Delete a record
    public function destroy($id)
    {
        $addCom = AddCom::findOrFail($id);
        $addCom->delete();

        return redirect()->route('admin.add_com.index')->with('success', 'Record deleted successfully.');
    }
}
