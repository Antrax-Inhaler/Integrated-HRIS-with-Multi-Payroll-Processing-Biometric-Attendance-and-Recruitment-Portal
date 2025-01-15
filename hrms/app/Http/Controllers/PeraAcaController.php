<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeraAca;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; 

class PeraAcaController extends Controller
{
    // Display the allowance listings page
    public function index()
    {
        $allowances = DB::table('add_com')
        ->join('members', 'add_com.member_id', '=', 'members.id')
        ->select('add_com.*', DB::raw("CONCAT(members.surname, ', ', members.given_name, ' ', COALESCE(members.middle_name, '')) as member_name"))
        ->get();
    
        $members = DB::table('members')
        ->select('id', 'surname', 'given_name', 'middle_name')
        ->get();
    
    return view('admin.pera_aca', compact('allowances', 'members'));
    }

    // Store a new allowance record
    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|integer',
            'amount' => 'required|numeric',
            'month_year' => 'required|date',
            'description' => 'nullable|string|max:255',
        ]);

        PeraAca::create($request->all());

        return redirect()->route('admin.pera_aca.index')->with('success', 'Allowance added successfully.');
    }

    // Update an existing allowance record
    public function update(Request $request, $id)
    {
        $request->validate([
            'member_id' => 'required|integer',
            'amount' => 'required|numeric',
            'month_year' => 'required|date',
            'description' => 'nullable|string|max:255',
        ]);

        $allowance = PeraAca::findOrFail($id);
        $allowance->update($request->all());

        return redirect()->route('admin.pera_aca.index')->with('success', 'Allowance updated successfully.');
    }

    // Delete an allowance record
    public function destroy($id)
    {
        $allowance = PeraAca::findOrFail($id);
        $allowance->delete();

        return redirect()->route('admin.pera_aca.index')->with('success', 'Allowance deleted successfully.');
    }
    public function display(Request $request)
    {
        $userId = Auth::id(); // Get the ID of the currently logged-in user
    
        // Retrieve filter inputs
        $monthYear = $request->input('month_year');
        $minAmount = $request->input('min_amount');
        $maxAmount = $request->input('max_amount');
    
        // Build query with optional filters
        $allowancesQuery = PeraAca::where('member_id', $userId);
    
        if ($monthYear) {
            $allowancesQuery->where('month_year', $monthYear);
        }
    
        if ($minAmount) {
            $allowancesQuery->where('amount', '>=', $minAmount);
        }
    
        if ($maxAmount) {
            $allowancesQuery->where('amount', '<=', $maxAmount);
        }
    
        $allowances = $allowancesQuery->orderBy('month_year', 'desc')->get();
    
        return view('member.pera_aca', compact('allowances', 'monthYear', 'minAmount', 'maxAmount'));
    }
    
}
