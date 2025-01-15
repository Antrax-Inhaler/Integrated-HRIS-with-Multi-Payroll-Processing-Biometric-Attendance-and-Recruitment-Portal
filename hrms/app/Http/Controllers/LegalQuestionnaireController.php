<?php

namespace App\Http\Controllers;

use App\Models\LegalQuestionnaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LegalQuestionnaireController extends Controller
{
    public function index()
    {
        $questionnaires = LegalQuestionnaire::where('applicant_id', Auth::id())->get();
        return view('applicant.legalquestionnaire', compact('questionnaires'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'related_to_authority_within_third_degree' => 'boolean|nullable',
            'related_to_authority_within_fourth_degree' => 'boolean|nullable',
            'relation_details' => 'string|nullable',
            'relation_details_fourth_degree'  => 'string|nullable',
            'found_guilty_of_offense' => 'boolean|nullable',
            'offense_details' => 'string|nullable',
            'criminally_charged' => 'boolean|nullable',
            'criminal_charge_details' => 'string|nullable',
            'criminal_charge_date' => 'date|nullable',
            'criminal_charge_status' => 'string|nullable',
            'convicted_of_crime' => 'boolean|nullable',
            'conviction_details' => 'string|nullable',
            'separated_from_service' => 'boolean|nullable',
            'separation_details' => 'string|nullable',
            'election_candidate' => 'boolean|nullable',
            'election_details' => 'string|nullable',
            'resigned_for_campaign' => 'boolean|nullable',
            'resignation_details' => 'string|nullable',
            'immigrant_status' => 'boolean|nullable',
            'immigrant_country' => 'string|nullable',
            'indigenous_group_member' => 'boolean|nullable',
            'indigenous_group_details' => 'string|nullable',
            'person_with_disability' => 'boolean|nullable',
            'disability_id_number' => 'string|nullable',
            'solo_parent' => 'boolean|nullable',
            'solo_parent_id_number' => 'string|nullable',
            'government_id_type' => 'string|nullable',
            'government_id_number' => 'string|nullable',
            'id_issuance_date' => 'date|nullable',
            'id_issuance_place' => 'string|nullable',
            'signature' => 'string|nullable',
            'date_accomplished' => 'date|nullable',
            'right_thumbmark' => 'nullable',
            'date_sworn' => 'date|nullable',
            'person_administering_oath' => 'string|nullable',
        ]);

        $data['applicant_id'] = Auth::id();
        LegalQuestionnaire::create($data);

        return redirect()->route('applicant.legal-questionnaire');
    }

    public function update(Request $request, $id)
    {
        $questionnaire = LegalQuestionnaire::where('applicant_id', Auth::id())->findOrFail($id);

        $data = $request->validate([
            'related_to_authority_within_third_degree' => 'boolean|nullable',
            'related_to_authority_within_fourth_degree' => 'boolean|nullable',
            'relation_details' => 'string|nullable',
            'relation_details_fourth_degree'  => 'string|nullable',
            'found_guilty_of_offense' => 'boolean|nullable',
            'offense_details' => 'string|nullable',
            'criminally_charged' => 'boolean|nullable',
            'criminal_charge_details' => 'string|nullable',
            'criminal_charge_date' => 'date|nullable',
            'criminal_charge_status' => 'string|nullable',
            'convicted_of_crime' => 'boolean|nullable',
            'conviction_details' => 'string|nullable',
            'separated_from_service' => 'boolean|nullable',
            'separation_details' => 'string|nullable',
            'election_candidate' => 'boolean|nullable',
            'election_details' => 'string|nullable',
            'resigned_for_campaign' => 'boolean|nullable',
            'resignation_details' => 'string|nullable',
            'immigrant_status' => 'boolean|nullable',
            'immigrant_country' => 'string|nullable',
            'indigenous_group_member' => 'boolean|nullable',
            'indigenous_group_details' => 'string|nullable',
            'person_with_disability' => 'boolean|nullable',
            'disability_id_number' => 'string|nullable',
            'solo_parent' => 'boolean|nullable',
            'solo_parent_id_number' => 'string|nullable',
            'government_id_type' => 'string|nullable',
            'government_id_number' => 'string|nullable',
            'id_issuance_date' => 'date|nullable',
            'id_issuance_place' => 'string|nullable',
            'signature' => 'string|nullable',
            'date_accomplished' => 'date|nullable',
            'right_thumbmark' => 'nullable',
            'date_sworn' => 'date|nullable',
            'person_administering_oath' => 'string|nullable',
        ]);

        $questionnaire->update($data);

        return redirect()->route('applicant.legal-questionnaire');
    }

    public function destroy($id)
    {
        $questionnaire = LegalQuestionnaire::where('applicant_id', Auth::id())->findOrFail($id);
        $questionnaire->delete();

        return redirect()->route('applicant.legal-questionnaire');
    }
}
