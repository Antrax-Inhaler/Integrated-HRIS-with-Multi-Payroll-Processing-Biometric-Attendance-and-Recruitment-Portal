<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CivilServiceEligibility extends Model
{
    use HasFactory;

    protected $table = 'civil_service_eligibility'; // If the table name differs from the default

    protected $fillable = [
        'applicant_id',
        'career_service',
        'rating',
        'date_of_examination',
        'place_of_examination',
        'license_number',
        'license_validity',
    ];

    // Define the relationship with the Applicant (or User) model
    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}
