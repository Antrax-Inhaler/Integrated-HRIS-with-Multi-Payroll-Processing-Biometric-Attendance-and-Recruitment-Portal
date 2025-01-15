<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LegalQuestionnaire extends Model
{
    use HasFactory;

    protected $table = 'legal_questionnaire';

    protected $fillable = [
        'applicant_id',
        'related_to_authority_within_third_degree',
        'related_to_authority_within_fourth_degree',
        'relation_details',
        'relation_details_fourth_degree',
        'found_guilty_of_offense',
        'offense_details',
        'criminally_charged',
        'criminal_charge_details',
        'criminal_charge_date',
        'criminal_charge_status',
        'convicted_of_crime',
        'conviction_details',
        'separated_from_service',
        'separation_details',
        'election_candidate',
        'election_details',
        'resigned_for_campaign',
        'resignation_details',
        'immigrant_status',
        'immigrant_country',
        'indigenous_group_member',
        'indigenous_group_details',
        'person_with_disability',
        'disability_id_number',
        'solo_parent',
        'solo_parent_id_number',
        'government_id_type',
        'government_id_number',
        'id_issuance_date',
        'id_issuance_place',
        'signature',
        'date_accomplished',
        'right_thumbmark',
        'date_sworn',
        'person_administering_oath',
    ];
    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}
