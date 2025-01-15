<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bonus;

class BonusController extends Controller
{
    /**
     * Display a listing of the bonuses.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $bonuses = Bonus::all();
        return view('admin.bonuses', compact('bonuses'));
    }

    /**
     * Show the form for creating a new bonus.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.create-bonus');
    }

    /**
     * Store a newly created bonus in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'bonus_name' => 'required|string|max:255',
            'description' => 'required|string',
            'amount' => 'required|numeric|min:0', // Validate amount field
        ]);

        Bonus::create($request->all());

        return redirect()->route('admin.bonuses.index')->with('success', 'Bonus added successfully.');
    }

    /**
     * Show the form for editing the specified bonus.
     *
     * @param  \App\Models\Bonus  $bonus
     * @return \Illuminate\View\View
     */
    public function edit(Bonus $bonus)
    {
        return view('admin.edit-bonus', compact('bonus'));
    }

    /**
     * Update the specified bonus in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  \App\Models\Bonus  $bonus
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Bonus $bonus)
    {
        $request->validate([
            'bonus_name' => 'required|string|max:255',
            'description' => 'required|string',
            'amount' => 'required|numeric|min:0', // Validate amount field
        ]);

        $bonus->update($request->all());

        return redirect()->route('admin.bonuses.index')->with('success', 'Bonus updated successfully.');
    }

    /**
     * Remove the specified bonus from storage.
     *
     * @param  \App\Models\Bonus  $bonus
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Bonus $bonus)
    {
        $bonus->delete();
        return redirect()->route('admin.bonuses.index')->with('success', 'Bonus deleted successfully.');
    }
}
