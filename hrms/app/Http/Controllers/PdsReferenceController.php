<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PdsReference;
use Illuminate\Support\Facades\Auth;

class PdsReferenceController extends Controller
{
    // Display the form and list of references
    public function index(Request $request)
    {
        // Retrieve all reference entries for the logged-in applicant
        $pdsReferences = PdsReference::where('applicant_id', Auth::id())->get();

        // If 'edit' is set, get the specific reference entry
        $editReference = null;
        if ($request->has('edit')) {
            $editReference = PdsReference::where('applicant_id', Auth::id())
                ->where('id', $request->edit)
                ->firstOrFail();
        }

        // Return the view with the entries and the edit entry if exists
        return view('applicant.references', compact('pdsReferences', 'editReference'));
    }

    // Store a new reference entry
    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'reference_name' => 'required|string|max:255',
            'reference_address' => 'required|string|max:255',
            'reference_telephone' => 'required|string|max:50',
        ]);

        // Create the reference entry
        PdsReference::create([
            'applicant_id' => Auth::id(),
            'reference_name' => $request->reference_name,
            'reference_address' => $request->reference_address,
            'reference_telephone' => $request->reference_telephone,
        ]);

        return redirect()->route('applicant.references');
    }

    // Update an existing reference entry
    public function update(Request $request, $id)
    {
        // Validate the input
        $request->validate([
            'reference_name' => 'required|string|max:255',
            'reference_address' => 'required|string|max:255',
            'reference_telephone' => 'required|string|max:50',
        ]);

        // Find the reference entry by ID and update it
        $pdsReference = PdsReference::where('applicant_id', Auth::id())->where('id', $id)->firstOrFail();
        $pdsReference->update($request->all());

        return redirect()->route('applicant.references');
    }

    // Delete a reference entry
    public function destroy($id)
    {
        // Find the reference entry by ID and delete it
        $pdsReference = PdsReference::where('applicant_id', Auth::id())->where('id', $id)->firstOrFail();
        $pdsReference->delete();

        return redirect()->route('applicant.references');
    }
}
