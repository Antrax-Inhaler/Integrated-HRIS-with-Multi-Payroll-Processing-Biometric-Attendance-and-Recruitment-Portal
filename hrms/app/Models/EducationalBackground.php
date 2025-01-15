<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalBackground extends Model
{
    use HasFactory;

    protected $table = 'educational_background';

    protected $fillable = [
        'applicant_id',
        'level',
        'school_name',
        'period_of_attendance_from',
        'period_of_attendance_to',
        'course_name',
        'year_graduated',
        'highest_level_units_earned',
        'honors_received',
    ];

    // Define the relationship with Applicant model
    public function applicant()
    {
        return $this->belongsTo(Applicant::class, 'applicant_id');
    }
}
