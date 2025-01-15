<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobListing extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_title',
        'department',
        'job_type',
        'salary_range',
        'experience_level',
        'education_requirement',
        'job_description',
        'key_responsibilities',
        'required_skills',
        'application_deadline',
        'posted_date',
    ];

    // Automatically cast these attributes to date instances
    protected $casts = [
        'application_deadline' => 'date',
        'posted_date' => 'date',
    ];
}
