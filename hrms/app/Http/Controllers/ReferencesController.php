<?php

namespace App\Http\Controllers;

use App\Models\FamilyBackground;
use App\Models\Children;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReferencesController extends Controller
{
    public function index()
    {
        $familyBackground = FamilyBackground::where('applicant_id', Auth::id())->first();
        $children = Children::where('applicant_id', Auth::id())->get();

        return view('applicant.references2', compact('familyBackground', 'children'));
    }

    public function storeFamilyBackground(Request $request)
    {
        $data = $request->validate([
            'spouse_surname' => 'nullable|string|max:100',
            'spouse_first_name' => 'nullable|string|max:100',
            'spouse_middle_name' => 'nullable|string|max:100',
            'spouse_occupation' => 'nullable|string|max:100',
            'spouse_employer_name' => 'nullable|string|max:100',
            'spouse_business_address' => 'nullable|string|max:255',
            'spouse_telephone_no' => 'nullable|string|max:15',
            'father_surname' => 'nullable|string|max:100',
            'father_first_name' => 'nullable|string|max:100',
            'father_middle_name' => 'nullable|string|max:100',
            'mother_maiden_name' => 'nullable|string|max:255',
        ]);

        $data['applicant_id'] = Auth::id();
        FamilyBackground::updateOrCreate(['applicant_id' => Auth::id()], $data);

        return redirect()->back()->with('success', 'Family background updated successfully.');
    }

    public function storeChild(Request $request)
    {
        $data = $request->validate([
            'child_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
        ]);

        $data['applicant_id'] = Auth::id();
        Children::create($data);

        return redirect()->back()->with('success', 'Child added successfully.');
    }

    public function updateChild(Request $request, $id)
    {
        $child = Children::where('id', $id)->where('applicant_id', Auth::id())->firstOrFail();

        $data = $request->validate([
            'child_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
        ]);

        $child->update($data);

        return redirect()->back()->with('success', 'Child updated successfully.');
    }

    public function deleteChild($id)
    {
        $child = Children::where('id', $id)->where('applicant_id', Auth::id())->firstOrFail();
        $child->delete();

        return redirect()->back()->with('success', 'Child deleted successfully.');
    }
}
