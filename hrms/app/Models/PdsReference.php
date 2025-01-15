<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PdsReference extends Model
{
    use HasFactory;

    protected $table = 'pdsreferences';  // Explicitly mention the table name if it's different from the model name

    protected $fillable = [
        'applicant_id', 'reference_name', 'reference_address', 'reference_telephone'
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}
