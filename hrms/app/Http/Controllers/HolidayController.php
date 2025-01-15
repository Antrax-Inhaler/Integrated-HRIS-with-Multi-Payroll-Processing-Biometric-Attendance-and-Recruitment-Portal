<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Holiday;

class HolidayController extends Controller
{
    // Display the holiday listings page
    public function index()
    {
        $holidays = Holiday::all();
        return view('admin.holidays', compact('holidays'));
    }

    // Store a new holiday
    public function store(Request $request)
    {
        $request->validate([
            'holiday_date' => 'required|date',
            'name' => 'required|string|max:255',
            'type' => 'required|in:regular,special_non_working',
        ]);

        Holiday::create($request->all());

        return redirect()->route('admin.holidays.index')->with('success', 'Holiday added successfully.');
    }

    // Update an existing holiday
    public function update(Request $request, $id)
    {
        $request->validate([
            'holiday_date' => 'required|date',
            'name' => 'required|string|max:255',
            'type' => 'required|in:regular,special_non_working',
        ]);

        $holiday = Holiday::findOrFail($id);
        $holiday->update($request->all());

        return redirect()->route('admin.holidays.index')->with('success', 'Holiday updated successfully.');
    }

    // Delete a holiday
    public function destroy($id)
    {
        $holiday = Holiday::findOrFail($id);
        $holiday->delete();

        return redirect()->route('admin.holidays.index')->with('success', 'Holiday deleted successfully.');
    }
}
