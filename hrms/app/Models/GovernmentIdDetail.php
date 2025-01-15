<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GovernmentIdDetail extends Model
{
    use HasFactory;

    // Define the table name (if different from model name)
    protected $table = 'government_id_details';

    // Fillable fields to allow mass assignment
    protected $fillable = [
        'applicant_id',
        'government_issued_id',
        'id_license_passport_no',
        'date_place_of_issuance',
        'date_accomplished',
        'right_thumbmark',
        'person_administering_oath',
    ];

    // Define the relationship with the Applicant model
    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}
