<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalInformation extends Model
{
    use HasFactory;

    // Define the table if necessary
    protected $table = 'personal_information';

    // Specify the fillable fields to allow mass assignment
    protected $fillable = [
        'applicant_id',
        'cs_id_no',
        'surname',
        'first_name',
        'middle_name',
        'name_extension',
        'date_of_birth',
        'place_of_birth',
        'sex',
        'civil_status',
        'citizenship',
        'dual_citizenship_country',
        'dual_citizenship_by',

        // Residential Address Fields
        'residential_house_no',
        'residential_street',
        'residential_subdivision',
        'residential_barangay',
        'residential_city_municipality',
        'residential_province',
        'residential_zip_code',

        // Permanent Address Fields
        'permanent_house_no',
        'permanent_street',
        'permanent_subdivision',
        'permanent_barangay',
        'permanent_city_municipality',
        'permanent_province',
        'permanent_zip_code',

        'telephone_no',
        'mobile_no',
        'email_address',

        // Additional Fields
        'height',
        'weight',
        'blood_type',
        'gsis_no',
        'pagibig_no',
        'philhealth_no',
        'sss_no',
        'tin_no',
        'agency_employee_no',
    ];

    // Define the relationship with the Applicant (User)
    public function applicant()
    {
        return $this->belongsTo(User::class, 'applicant_id');
    }
}
