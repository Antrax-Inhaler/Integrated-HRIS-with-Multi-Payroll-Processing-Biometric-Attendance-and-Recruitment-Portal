<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GovernmentIdDetail;

class GovernmentIdDetailController extends Controller
{
    /**
     * Store or update the government ID details.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeOrUpdate(Request $request)
    {
        // Validate the request data
        $request->validate([
            'applicant_id' => 'required|exists:applicants,id',
            'government_issued_id' => 'nullable|string|max:255',
            'id_license_passport_no' => 'nullable|string|max:255',
            'date_place_of_issuance' => 'nullable|string|max:255',
            'date_accomplished' => 'nullable|date',
            'right_thumbmark' => 'nullable|boolean',
            'person_administering_oath' => 'nullable|string|max:255',
        ]);

        // Check if the record already exists for the applicant
        $governmentIdDetail = GovernmentIdDetail::where('applicant_id', $request->applicant_id)->first();

        if ($governmentIdDetail) {
            // Update the existing record
            $governmentIdDetail->update($request->all());
        } else {
            // Create a new record
            GovernmentIdDetail::create($request->all());
        }

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Government ID Details saved successfully.');
    }
}
