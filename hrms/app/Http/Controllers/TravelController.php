<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Travel;
use App\Models\Member;
use App\Models\Notification;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TravelController extends Controller
{
    // Admin function to display all travel applications
    public function index()
    {
        $travels = Travel::with('member')->get();
        $members = Member::all();
        return view('admin.travel', compact('travels', 'members'));
    }

    // Admin function to store a travel application
    public function store(Request $request) 
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'departure_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:departure_date',
            'destination' => 'required|string|max:255',
            'specific_purpose' => 'nullable|string',
            'objectives' => 'nullable|string',
            'per_diem_expenses' => 'nullable|numeric',
            'assistant_or_laborers_allowed' => 'nullable|boolean',
            'appropriation_to_which_travel' => 'nullable|string|max:255',
            'should_be_charged' => 'nullable|string|max:255',
            'remarks_or_special_instructions' => 'nullable|string',
            'recommending_approval' => 'nullable|string|max:255',
            'approved_by' => 'nullable|string|max:255',
            'inclusive_dates' => 'nullable|string',
            'place_signed' => 'nullable|string|max:255',
            'certifying_officers' => 'nullable|string|max:255',
            'immediate_supervisor' => 'nullable|string|max:255',
            'supervisor_designation' => 'nullable|string|max:255',
            'document_number' => 'nullable|string|max:50',
            'revision_number' => 'nullable|integer',
            'issued_date' => 'nullable|date',
            'travel_number' => 'nullable|integer',
            'additional_date' => 'nullable|date',
            'status' => 'nullable|in:Pending,Approved,Disapproved', // Added status validation
        ]);
    
        // Create the travel application
        $travel = Travel::create($request->all());
    
        // Get the current date and time
        $currentDateTime = now()->toDateTimeString();
    
        // Create a notification for the admin about the new travel application
        Notification::create([
            'user_id' => $travel->member_id, // Assuming the currently authenticated user is an admin
            'user_type' => 'member', // Specify user type as admin
            'type' => 'travel', // Specific type for travel application notifications
            'item_id' => $travel->id, // Use the travel application ID as item ID
            'message' => 'A new travel application has been created for member ID: ' . $request->member_id . ' on ' . $currentDateTime . '.',
            'admin_message' => 'New travel application submitted by member ID: ' . $request->member_id . ' on ' . $currentDateTime . '.',
            'is_read' => 0, // Default to unread
            'is_read_admin' => 0, // Default to unread for admin
        ]);
    
        return redirect()->route('admin.travel.index')->with('success', 'Travel application created successfully.');
    }
    
    // Admin function to update travel application status
    public function update(Request $request, $id)
    {
        $travel = Travel::findOrFail($id);
    
        $request->validate([
            'status' => 'required|in:Pending,Approved,Disapproved',
        ]);
    
        // Update the travel status
        $travel->update($request->all());
    
        // Get the current date and time
        $currentDateTime = now()->toDateTimeString();
    
        // Create a notification for the member about the status update
        Notification::create([
            'user_id' => $travel->member_id, // Assuming the member's ID is stored in the travel record
            'user_type' => 'member', // Specify user type as member
            'type' => 'travel', // Specific type for travel status updates
            'item_id' => $travel->id, // Use the travel application ID as item ID
            'message' => 'Your travel application status has been updated to: ' . $request->status . ' on ' . $currentDateTime . '.',
            'admin_message' => 'Member ID: ' . $travel->member_id . ' travel status updated to ' . $request->status . ' on ' . $currentDateTime . '.',
            'is_read' => 0, // Default to unread
            'is_read_admin' => 0, // Default to unread for admin
        ]);
    
        return redirect()->route('admin.travel.index')->with('success', 'Travel status updated successfully.');
    }
    

    // Admin function to delete a travel application
    public function destroy($id)
    {
        $travel = Travel::findOrFail($id);
        $travel->delete();

        return redirect()->route('admin.travel.index')->with('success', 'Travel application deleted successfully.');
    }

    // Member function to display travel application form
    public function index2()
    {
        $travels = Travel::where('member_id', Auth::id())->get(); // 
        return view('member.travel', compact('travels'));
    }
    public function destroy2($id)
    {
        $travels = Travel::findOrFail($id);
        $travels->delete();

        return redirect()->route('member.travel.index')->with('success', 'Travel application deleted successfully.');
    }

    // Member function to store travel application
    public function store2(Request $request)
    {
        $request->validate([
            'departure_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:departure_date',
            'destination' => 'required|string|max:255',
            'specific_purpose' => 'nullable|string',
            'objectives' => 'nullable|string',
            'per_diem_expenses' => 'nullable|numeric',
            'assistant_or_laborers_allowed' => 'nullable|boolean',
            'appropriation_to_which_travel' => 'nullable|string|max:255',
            'should_be_charged' => 'nullable|string|max:255',
            'remarks_or_special_instructions' => 'nullable|string',
            'recommending_approval' => 'nullable|string|max:255',
            'approved_by' => 'nullable|string|max:255',
            'inclusive_dates' => 'nullable|string',
            'place_signed' => 'nullable|string|max:255',
            'certifying_officers' => 'nullable|string|max:255',
            'immediate_supervisor' => 'nullable|string|max:255',
            'supervisor_designation' => 'nullable|string|max:255',
            'document_number' => 'nullable|string|max:50',
            'revision_number' => 'nullable|integer',
            'issued_date' => 'nullable|date',
            'travel_number' => 'nullable|integer',
            'additional_date' => 'nullable|date',
            
            'status' => 'nullable|in:Pending,Approved,Disapproved', // Status validation
        ]);
    
        // Create a new travel application
        $travel = new Travel();
        $travel->member_id = Auth::id(); // Automatically set the member_id to the current logged-in member
        $travel->official_station = $request->official_station;
        $travel->departure_date = $request->departure_date;
        $travel->return_date = $request->return_date;
        $travel->destination = $request->destination;
        $travel->specific_purpose = $request->specific_purpose;
        $travel->objectives = $request->objectives;
        $travel->per_diem_expenses = $request->per_diem_expenses;
        $travel->assistant_or_laborers_allowed = $request->assistant_or_laborers_allowed;
        $travel->appropriation_to_which_travel = $request->appropriation_to_which_travel;
        $travel->should_be_charged = $request->should_be_charged;
        $travel->remarks_or_special_instructions = $request->remarks_or_special_instructions;
        $travel->recommending_approval = $request->recommending_approval;
        $travel->approved_by = $request->approved_by;
        $travel->inclusive_dates = $request->inclusive_dates;
        $travel->place_signed = $request->place_signed;
        $travel->certifying_officers = $request->certifying_officers;
        $travel->immediate_supervisor = $request->immediate_supervisor;
        $travel->supervisor_designation = $request->supervisor_designation;
        $travel->document_number = $request->document_number;
        $travel->revision_number = $request->revision_number;
        $travel->additional_date = $request->additional_date;
        $travel->travel_number = $request->travel_number;
        $travel->issued_date = $request->issued_date;
        $travel->status = $request->status ?? 'Pending'; 
    
        $travel->save();

        $currentDateTime = now()->toDateTimeString();

    // Create a notification for the member about their travel application submission
    Notification::create([
        'user_id' => $travel->member_id,
        'user_type' => 'member', // Specify user type as member
        'type' => 'travel', // Type for travel application submission
        'item_id' => $travel->id, // Use the travel application ID as item ID
        'message' => 'Your travel application has been submitted successfully on ' . $currentDateTime . '.',
        'admin_message' => 'Member ID: ' . $travel->member_id . ' has submitted a new travel application on ' . $currentDateTime . '.',
        'is_read' => 0, // Default to unread
        'is_read_admin' => 0, // Default to unread for admin
    ]);
        return redirect()->route('member.travel.index')->with('success', 'Travel application submitted successfully.');
    }
    
}
