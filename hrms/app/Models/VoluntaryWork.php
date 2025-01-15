<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoluntaryWork extends Model
{
    use HasFactory;
    protected $table = 'voluntary_work';
    protected $fillable = [
        'applicant_id', 'organization_name', 'organization_address', 
        'position_nature_of_work', 'inclusive_dates_from', 
        'inclusive_dates_to', 'number_of_hours'
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}
