<?php

namespace App\Http\Controllers;
use App\Models\MemberBonus; // Assuming you have a Member model
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class MemberBonusController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id(); // Get the ID of the currently logged-in user
    
        // Retrieve filter inputs
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $bonusName = $request->input('bonus_name');
    
        // Build query with optional filters
        $bonusesQuery = MemberBonus::where('member_id', $userId);
    
        if ($startDate) {
            $bonusesQuery->whereDate('effective_date', '>=', $startDate);
        }
    
        if ($endDate) {
            $bonusesQuery->whereDate('effective_date', '<=', $endDate);
        }
    
        if ($bonusName) {
            $bonusesQuery->where('bonus_name', 'like', "%{$bonusName}%");
        }
    
        $bonuses = $bonusesQuery->orderBy('effective_date', 'desc')->get();
    
        return view('member.bonuses', compact('bonuses', 'startDate', 'endDate', 'bonusName'));
    }
    
}
