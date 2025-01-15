<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningDevelopment extends Model
{
    use HasFactory;
    protected $table = 'learning_development';

    protected $fillable = [
        'applicant_id', 'title_of_program', 'type_of_ld', 'conducted_by',
        'inclusive_dates_from', 'inclusive_dates_to', 'number_of_hours'
    ];
    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }


}
