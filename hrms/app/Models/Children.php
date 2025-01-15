<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Children extends Model
{
    use HasFactory;

    protected $table = 'children';

    protected $fillable = [
        'applicant_id',
        'child_name',
        'date_of_birth'
    ];
    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}
