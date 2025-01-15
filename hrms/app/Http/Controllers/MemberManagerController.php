<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Support\Facades\Storage;

class MemberManagerController extends Controller
{
    public function index(Request $request)
    {
        // Fetch search term
        $searchTerm = $request->input('search');
        
        // Fetch members based on search term and where is_verified is 1
        $members = Member::where('is_verified', 1)
            ->where(function ($query) use ($searchTerm) {
                $query->where('surname', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('given_name', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('middle_name', 'LIKE', "%{$searchTerm}%");
            })
            ->with(['position', 'department']) // Eager load relationships
            ->get();
        
        $positions = Position::all();
        $departments = Department::all();
        
        return view('admin.members', compact('members', 'positions', 'departments', 'searchTerm'));
    }
    
    
    
    

    // Store a newly created member
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'surname' => 'required|string|max:255',
            'given_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:members',
            'password' => 'required|string|min:8',
            'contact_number' => 'required|string|max:255',
            'fingerprint_id' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Hash the password
        $validatedData['password'] = Hash::make($validatedData['password']);
    
        // Set is_verified to 1 (true)
        $validatedData['is_verified'] = 1;
    
        // Handle the profile picture upload
        if ($request->hasFile('profile_picture')) {
            $filePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $validatedData['profile_picture'] = $filePath;
        }
    
        // Create the member record
        Member::create($validatedData);
    
        return redirect()->back()->with('success', 'Member added successfully');
    }
    

    // Update the specified member
    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);

        $validatedData = $request->validate([
            'surname' => 'required|string|max:255',
            'given_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:members,email,' . $member->id,
            'password' => 'nullable|string|min:8',
            'contact_number' => 'required|string|max:255',
            'fingerprint_id' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update password if provided
        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if it exists
            if ($member->profile_picture) {
                Storage::disk('public')->delete($member->profile_picture);
            }

            $filePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $validatedData['profile_picture'] = $filePath;
        }

        // Update the member record
        $member->update($validatedData);

        return redirect()->back()->with('success', 'Member updated successfully');
    }

    // Remove the specified member
    public function destroy($id)
    {
        $member = Member::findOrFail($id);

        // Delete the profile picture if it exists
        if ($member->profile_picture) {
            Storage::disk('public')->delete($member->profile_picture);
        }

        $member->delete();

        return redirect()->back()->with('success', 'Member deleted successfully');
    }
}
