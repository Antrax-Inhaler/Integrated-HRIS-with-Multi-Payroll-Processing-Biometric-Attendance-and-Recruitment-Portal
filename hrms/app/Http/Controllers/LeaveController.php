<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\Member; // Assuming you have a Member model
use App\Models\Notification; // Assuming you have a Member model

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LeaveController extends Controller
{
    public function index()
    {
        $leaves = Leave::where('member_id', Auth::id())->get();

        $members = Member::all(); // Fetch all members for the dropdown in the modal
        
        return view('member.leave', compact('leaves', 'members'));
    }

public function store(Request $request)
{
    $request->validate([
        'working_days_applied' => 'nullable|integer',
        'commutation' => 'nullable|in:Not Requested,Requested',
        'inclusive_dates' => 'nullable|string',
        'vacation_leave' => 'nullable|boolean',
        'mandatory_forced_leave' => 'nullable|boolean',
        'sick_leave' => 'nullable|boolean',
        'maternity_leave' => 'nullable|boolean',
        'paternity_leave' => 'nullable|boolean',
        'special_privilege_leave' => 'nullable|boolean',
        'solo_parent_leave' => 'nullable|boolean',
        'study_leave' => 'nullable|boolean',
        'ten_day_vawc_leave' => 'nullable|boolean',
        'rehabilitation_privilege' => 'nullable|boolean',
        'special_leave_for_women' => 'nullable|boolean',
        'special_emergency_calamity_leave' => 'nullable|boolean',
        'adoption_leave' => 'nullable|boolean',
        'others_type_of_leave' => 'nullable|string',
        'within_philippines' => 'nullable|boolean',
        'abroad' => 'nullable|boolean',
        'abroad_specify' => 'nullable|string',
        'in_hospital' => 'nullable|boolean',
        'hospital_specify_illness' => 'nullable|string',
        'outpatient' => 'nullable|boolean',
        'outpatient_specify_illness' => 'nullable|string',
        'special_leave_illness' => 'nullable|string',
        'study_leave_completion_masters' => 'nullable|boolean',
        'study_leave_bar_review' => 'nullable|boolean',
        'monetization_of_leave_credits' => 'nullable|boolean',
        'terminal_leave' => 'nullable|boolean',
        'total_earned_sick' => 'nullable|numeric',
        'total_earned_vacation' => 'nullable|numeric',
        'less_this_application_vacation' => 'nullable|numeric',
        'less_this_application_sick' => 'nullable|numeric',
        'balance_vacation' => 'nullable|numeric',
        'balance_sick' => 'nullable|numeric',
        'authorize_officer_credits' => 'nullable|string',
        'approval_status' => 'nullable|in:For approval,For disapproval',
        'disapproval_reason' => 'nullable|string',
        'authorize_officer_recommendation' => 'nullable|string',
        'approved_days_with_pay' => 'nullable|integer',
        'approved_days_without_pay' => 'nullable|integer',
        'approved_others' => 'nullable|string',
        'disapproved_due_to' => 'nullable|string',
        'authorized_official' => 'nullable|string',
        'status' => 'nullable|in:Pending,Approved,Disapproved',
    ]);

    // Create a new leave application
    $leaves = new Leave();
    $leaves->member_id = Auth::id(); // Automatically set the member_id to the current logged-in member
    $leaves->working_days_applied = $request->working_days_applied;
    $leaves->commutation = $request->commutation;
    $leaves->inclusive_dates = $request->inclusive_dates;
    $leaves->vacation_leave = $request->vacation_leave;
    $leaves->mandatory_forced_leave = $request->mandatory_forced_leave;
    $leaves->sick_leave = $request->sick_leave;
    $leaves->maternity_leave = $request->maternity_leave;
    $leaves->paternity_leave = $request->paternity_leave;
    $leaves->special_privilege_leave = $request->special_privilege_leave;
    $leaves->solo_parent_leave = $request->solo_parent_leave;
    $leaves->study_leave = $request->study_leave;
    $leaves->ten_day_vawc_leave = $request->ten_day_vawc_leave;
    $leaves->rehabilitation_privilege = $request->rehabilitation_privilege;
    $leaves->special_leave_for_women = $request->special_leave_for_women;
    $leaves->special_emergency_calamity_leave = $request->special_emergency_calamity_leave;
    $leaves->adoption_leave = $request->adoption_leave;
    $leaves->others_type_of_leave = $request->others_type_of_leave;
    $leaves->within_philippines = $request->within_philippines;
    $leaves->abroad = $request->abroad;
    $leaves->abroad_specify = $request->abroad_specify;
    $leaves->in_hospital = $request->in_hospital;
    $leaves->hospital_specify_illness = $request->hospital_specify_illness;
    $leaves->outpatient = $request->outpatient;
    $leaves->outpatient_specify_illness = $request->outpatient_specify_illness;
    $leaves->special_leave_illness = $request->special_leave_illness;
    $leaves->study_leave_completion_masters = $request->study_leave_completion_masters;
    $leaves->study_leave_bar_review = $request->study_leave_bar_review;
    $leaves->monetization_of_leave_credits = $request->monetization_of_leave_credits;
    $leaves->terminal_leave = $request->terminal_leave;
    $leaves->total_earned_sick = $request->total_earned_sick;
    $leaves->total_earned_vacation = $request->total_earned_vacation;
    $leaves->less_this_application_vacation = $request->less_this_application_vacation;
    $leaves->less_this_application_sick = $request->less_this_application_sick;
    $leaves->balance_vacation = $request->balance_vacation;
    $leaves->balance_sick = $request->balance_sick;
    $leaves->authorize_officer_credits = $request->authorize_officer_credits;
    $leaves->approval_status = $request->approval_status;
    $leaves->disapproval_reason = $request->disapproval_reason;
    $leaves->authorize_officer_recommendation = $request->authorize_officer_recommendation;
    $leaves->approved_days_with_pay = $request->approved_days_with_pay;
    $leaves->approved_days_without_pay = $request->approved_days_without_pay;
    $leaves->approved_others = $request->approved_others;
    $leaves->disapproved_due_to = $request->disapproved_due_to;
    $leaves->authorized_official = $request->authorized_official;
    $leaves->status = $request->status ?? 'Pending'; // Default status

    $leaves->save();

    Notification::create([
        'user_id' => 1, // Assuming '1' is the admin user_id
        'user_type' => 'admin',
        'type' => 'leaves', // Type set as 'leaves'
        'item_id' => $leaves->id, // ID of the leave application
        'message' => 'A new leave request has been submitted by member ID: ' . Auth::id(),
        'admin_message' => 'A new leave request has been submitted and needs review.',
        'is_read' => 0,
        'is_read_admin' => 0,
    ]);
    return redirect()->route('member.leaves.index')->with('success', 'Leave request submitted successfully.');
}

    public function update(Request $request, Leave $leave)
    {
        $request->validate([
            'working_days_applied' => 'required|integer',
            'commutation' => 'required|in:Not Requested,Requested',
            'inclusive_dates' => 'required|string',
            'vacation_leave' => 'nullable|boolean',
            'mandatory_forced_leave' => 'nullable|boolean',
            'sick_leave' => 'nullable|boolean',
            'maternity_leave' => 'nullable|boolean',
            'paternity_leave' => 'nullable|boolean',
            'special_privilege_leave' => 'nullable|boolean',
            'solo_parent_leave' => 'nullable|boolean',
            'study_leave' => 'nullable|boolean',
            'ten_day_vawc_leave' => 'nullable|boolean',
            'rehabilitation_privilege' => 'nullable|boolean',
            'special_leave_for_women' => 'nullable|boolean',
            'special_emergency_calamity_leave' => 'nullable|boolean',
            'adoption_leave' => 'nullable|boolean',
            'others_type_of_leave' => 'nullable|string',
            'within_philippines' => 'nullable|boolean',
            'abroad' => 'nullable|boolean',
            'abroad_specify' => 'nullable|string',
            'in_hospital' => 'nullable|boolean',
            'hospital_specify_illness' => 'nullable|string',
            'outpatient' => 'nullable|boolean',
            'outpatient_specify_illness' => 'nullable|string',
            'special_leave_illness' => 'nullable|string',
            'study_leave_completion_masters' => 'nullable|boolean',
            'study_leave_bar_review' => 'nullable|boolean',
            'monetization_of_leave_credits' => 'nullable|boolean',
            'terminal_leave' => 'nullable|boolean',
            'total_earned_sick' => 'nullable|numeric',
            'total_earned_vacation' => 'nullable|numeric',
            'less_this_application_vacation' => 'nullable|numeric',
            'less_this_application_sick' => 'nullable|numeric',
            'balance_vacation' => 'nullable|numeric',
            'balance_sick' => 'nullable|numeric',
            'authorize_officer_credits' => 'nullable|string',
            'approval_status' => 'nuble|in:For approval,For disapproval',
            'disapproval_reason' => 'nullable|string',
            'authorize_officer_recommendation' => 'nullable|string',
            'approved_days_with_pay' => 'nullable|integer',
            'approved_days_without_pay' => 'nullable|integer',
            'approved_others' => 'nullable|string',
            'disapproved_due_to' => 'nullable|string',
            'authorized_official' => 'nullable|string',
            'status' => 'nullable|in:Pending,Approved,Disapproved',
        ]);
        $data = $request->all();
        $data['member_id'] = Auth::id();
    
        $leave->update($data);
    
        return redirect()->route('member.leaves.index')->with('success', 'Leave request updated successfully.');
    }

    public function destroy(Leave $leave)
    {
        $leave->delete();
        return redirect()->route('member.leaves.index')->with('success', 'Leave request deleted successfully.');
    }
    public function admin()
    {
        // Eager load 'member' relationship to avoid N+1 query problem
        $leaves = Leave::with('member')->get();
        $members = Member::all(); // Fetch all members for dropdown in modal
        return view('admin.leave', compact('leaves', 'members'));
    }
    

    public function store_admin(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'working_days_applied' => 'nullable|integer',
            'commutation' => 'nullable|in:Not Requested,Requested',
            'inclusive_dates' => 'nullable|string',
            'vacation_leave' => 'nullable|boolean',
            'mandatory_forced_leave' => 'nullable|boolean',
            'sick_leave' => 'nullable|boolean',
            'maternity_leave' => 'nullable|boolean',
            'paternity_leave' => 'nullable|boolean',
            'special_privilege_leave' => 'nullable|boolean',
            'solo_parent_leave' => 'nullable|boolean',
            'study_leave' => 'nullable|boolean',
            'ten_day_vawc_leave' => 'nullable|boolean',
            'rehabilitation_privilege' => 'nullable|boolean',
            'special_leave_for_women' => 'nullable|boolean',
            'special_emergency_calamity_leave' => 'nullable|boolean',
            'adoption_leave' => 'nullable|boolean',
            'others_type_of_leave' => 'nullable|string',
            'within_philippines' => 'nullable|boolean',
            'abroad' => 'nullable|boolean',
            'abroad_specify' => 'nullable|string',
            'in_hospital' => 'nullable|boolean',
            'hospital_specify_illness' => 'nullable|string',
            'outpatient' => 'nullable|boolean',
            'outpatient_specify_illness' => 'nullable|string',
            'special_leave_illness' => 'nullable|string',
            'study_leave_completion_masters' => 'nullable|boolean',
            'study_leave_bar_review' => 'nullable|boolean',
            'monetization_of_leave_credits' => 'nullable|boolean',
            'terminal_leave' => 'nullable|boolean',
            'total_earned_sick' => 'nullable|numeric',
            'total_earned_vacation' => 'nullable|numeric',
            'less_this_application_vacation' => 'nullable|numeric',
            'less_this_application_sick' => 'nullable|numeric',
            'balance_vacation' => 'nullable|numeric',
            'balance_sick' => 'nullable|numeric',
            'authorize_officer_credits' => 'nullable|string',
            'approval_status' => 'nullable|in:For approval,For disapproval',
            'disapproval_reason' => 'nullable|string',
            'authorize_officer_recommendation' => 'nullable|string',
            'approved_days_with_pay' => 'nullable|integer',
            'approved_days_without_pay' => 'nullable|integer',
            'approved_others' => 'nullable|string',
            'disapproved_due_to' => 'nullable|string',
            'authorized_official' => 'nullable|string',
            'status' => 'nullable|in:Pending,Approved,Disapproved',
        ]);

        Leave::create($request->all());

        return redirect()->route('admin.leaves.index')->with('success', 'Leave request added successfully.');
    }

    public function update_admin(Request $request, Leave $leave)
    {
        
        $request->validate([
            'member_id' => 'nullable|exists:members,id',
            'working_days_applied' => 'nullable|integer',
            'commutation' => 'nullable|in:Not Requested,Requested',
            'inclusive_dates' => 'nullable|string',
            'vacation_leave' => 'nullable|boolean',
            'mandatory_forced_leave' => 'nullable|boolean',
            'sick_leave' => 'nullable|boolean',
            'maternity_leave' => 'nullable|boolean',
            'paternity_leave' => 'nullable|boolean',
            'special_privilege_leave' => 'nullable|boolean',
            'solo_parent_leave' => 'nullable|boolean',
            'study_leave' => 'nullable|boolean',
            'ten_day_vawc_leave' => 'nullable|boolean',
            'rehabilitation_privilege' => 'nullable|boolean',
            'special_leave_for_women' => 'nullable|boolean',
            'special_emergency_calamity_leave' => 'nullable|boolean',
            'adoption_leave' => 'nullable|boolean',
            'others_type_of_leave' => 'nullable|string',
            'within_philippines' => 'nullable|boolean',
            'abroad' => 'nullable|boolean',
            'abroad_specify' => 'nullable|string',
            'in_hospital' => 'nullable|boolean',
            'hospital_specify_illness' => 'nullable|string',
            'outpatient' => 'nullable|boolean',
            'outpatient_specify_illness' => 'nullable|string',
            'special_leave_illness' => 'nullable|string',
            'study_leave_completion_masters' => 'nullable|boolean',
            'study_leave_bar_review' => 'nullable|boolean',
            'monetization_of_leave_credits' => 'nullable|boolean',
            'terminal_leave' => 'nullable|boolean',
            'total_earned_sick' => 'nullable|numeric',
            'total_earned_vacation' => 'nullable|numeric',
            'less_this_application_vacation' => 'nullable|numeric',
            'less_this_application_sick' => 'nullable|numeric',
            'balance_vacation' => 'nullable|numeric',
            'balance_sick' => 'nullable|numeric',
            'authorize_officer_credits' => 'nullable|string',
            'approval_status' => 'nullable|in:For approval,For disapproval',
            'disapproval_reason' => 'nullable|string',
            'authorize_officer_recommendation' => 'nullable|string',
            'approved_days_with_pay' => 'nullable|integer',
            'approved_days_without_pay' => 'nullable|integer',
            'approved_others' => 'nullable|string',
            'disapproved_due_to' => 'nullable|string',
            'authorized_official' => 'nullable|string',
            'status' => 'nullable|in:Pending,Approved,Disapproved',
        ]);

        $leave->update($request->all());
        Notification::create([
            'user_id' => $leave->member_id, // Use the member ID from the leave
            'user_type' => 'member',
            'type' => 'leaves', // Notification type for leaves
            'item_id' => $leave->id, // Leave ID as the item identifier
            'message' => 'Your leave application has been updated by the administrator',
            'is_read' => false,
            'is_admin_read' => false,
        ]);
        return redirect()->route('admin.leaves.index')->with('success', 'Leave request updated successfully.');
    }

    public function destroy_admin(Leave $leave)
    {
        $leave->delete();
        return redirect()->route('admin.leaves.index')->with('success', 'Leave request deleted successfully.');
    }
    public function edit($id)
{
    $leave = Leave::findOrFail($id);
    
    // Fetch the member using the member_id from the leave application
    $member = Member::find($leave->member_id);

    // Pass the leave and member data to the view
    return view('admin.leave', compact('leave', 'member'));
}
}