<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Position;

class PositionController extends Controller
{
    // Display a listing of positions
    public function index()
    {
        $positions = Position::all();
        return view('admin.positions', compact('positions'));
    }

    // Store a new position
    public function store(Request $request)
    {
        $request->validate([
            'position_name' => 'required|string|max:255',
        ]);

        Position::create($request->all());
        return redirect()->route('admin.positions.index')->with('success', 'Position added successfully.');
    }

    // Update an existing position
    public function update(Request $request, $id)
    {
        $request->validate([
            'position_name' => 'required|string|max:255',
        ]);

        $position = Position::findOrFail($id);
        $position->update($request->all());
        return redirect()->route('admin.positions.index')->with('success', 'Position updated successfully.');
    }

    // Delete a position
    public function destroy($id)
    {
        $position = Position::findOrFail($id);
        $position->delete();
        return redirect()->route('admin.positions.index')->with('success', 'Position deleted successfully.');
    }
}
