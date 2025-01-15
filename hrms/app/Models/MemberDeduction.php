<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberDeduction extends Model
{
    use HasFactory;

    protected $table = 'member_deductions';

    protected $fillable = [
        'member_id',
        'deduction_id',
        'type',
        'amount',
        'effective_date',
    ];

    public $timestamps = true;

    // Relationships
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function deduction()
    {
        return $this->belongsTo(Deduction::class);
    }
}
