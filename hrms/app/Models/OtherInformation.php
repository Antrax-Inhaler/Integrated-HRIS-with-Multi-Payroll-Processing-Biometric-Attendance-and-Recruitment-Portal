<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'applicant_id', 'type', 'description'
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}
