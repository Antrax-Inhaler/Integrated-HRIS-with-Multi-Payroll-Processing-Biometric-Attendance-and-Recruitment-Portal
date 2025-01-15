<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    use HasFactory;

    protected $table = 'travel';

    protected $fillable = [
        'member_id',
        'official_station',
        'departure_date',
        'return_date',
        'destination',
        'specific_purpose',
        'objectives',
        'per_diem_expenses',
        'assistant_or_laborers_allowed',
        'appropriation_to_which_travel',
        'should_be_charged',
        'remarks_or_special_instructions',
        'recommending_approval',
        'approved_by',
        'inclusive_dates',
        'place_signed',
        'certifying_officers',
        'immediate_supervisor',
        'supervisor_designation',
        'document_number',
        'revision_number',
        'issued_date',
        'additional_date',
        'travel_number',
        'status', 
    ];

    public $timestamps = true;

    // Define the relationship to the Member model
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
