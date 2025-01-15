<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
    use HasFactory;
    protected $table = 'work_experience';
    protected $fillable = [
        'applicant_id', 
        'position_title', 
        'department', 
        'monthly_salary', 
        'salary_grade_step', 
        'status_of_appointment', 
        'government_service', 
        'inclusive_dates_from', 
        'inclusive_dates_to',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}
