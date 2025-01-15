<?php

namespace App\Http\Controllers;
use App\Models\Notification;

use Illuminate\Http\Request;
use App\Models\Member;

class VerifyMemberController extends Controller
{
    // Show the list of members pending verification
    public function index()
    {
        $pendingMembers = Member::where('is_verified', false)->get();
        return view('admin.verify-member', compact('pendingMembers'));
    }

    // Verify a specific member
    public function verifyMember($id)
    {
        $member = Member::find($id);
    
        if ($member) {
            $member->is_verified = true;
            $member->save();
    
            // Create a notification for the member about their verification
            Notification::create([
                'user_id' => $member->id,
                'user_type' => 'member', // Set user type as member
                'type' => 'member_verification', // Type for member verification
                'item_id' => $member->id, // Use member ID as item ID
                'message' => 'Your account has been verified successfully.',
                'admin_message' => 'Member ID: ' . $member->id . ' has been verified.',
                'is_read' => 0, // Unread by member
                'is_read_admin' => 0, // Unread by admin
            ]);
    
            return redirect()->route('admin.verify-member.index')->with('success', 'Member verified successfully.');
        } else {
            return redirect()->route('admin.verify-member.index')->with('error', 'Member not found.');
        }
    }
    
    public function rejectMember($id)
{
    $member = Member::find($id);

    if ($member) {
        // Create a notification for the member about their rejection
        Notification::create([
            'user_id' => $member->id,
            'user_type' => 'member', // Set user type as member
            'type' => 'member', // Type for member rejection
            'item_id' => $member->id, // Use member ID as item ID
            'message' => 'Your account has been rejected and removed from the system.',
            'admin_message' => 'Member ID: ' . $member->id . ' has been rejected and deleted.',
            'is_read' => 0, // Unread by member
            'is_read_admin' => 0, // Unread by admin
        ]);

        $member->delete();
        return redirect()->route('admin.verify-member.index')->with('success', 'Member rejected and deleted successfully.');
    } else {
        return redirect()->route('admin.verify-member.index')->with('error', 'Member not found.');
    }
}

    // View full details of a specific member
    public function viewMember($id)
    {
        $member = Member::find($id);

        if ($member) {
            return view('admin.view-member', compact('member'));
        } else {
            return redirect()->route('admin.verify-member.index')->with('error', 'Member not found.');
        }
    }
}
