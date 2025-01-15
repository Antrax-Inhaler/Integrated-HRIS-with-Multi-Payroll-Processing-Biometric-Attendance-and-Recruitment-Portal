<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyBackground extends Model
{
    use HasFactory;

    protected $table = 'family_background';

    protected $fillable = [
        'applicant_id',
        'spouse_surname',
        'spouse_first_name',
        'spouse_middle_name',
        'spouse_suffix', // Added spouse suffix
        'spouse_occupation',
        'spouse_employer_name',
        'spouse_business_address',
        'spouse_telephone_no',
        'father_surname',
        'father_first_name',
        'father_middle_name',
        'father_suffix', // Added father suffix
        'mother_maiden_name',
        'mother_surname', // Added mother surname
        'mother_first_name', // Added mother first name
        'mother_middle_name' // Added mother middle name
    ];
    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}
