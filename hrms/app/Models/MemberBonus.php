<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberBonus extends Model
{
    use HasFactory;

    protected $table = 'member_bonuses'; // Specify the table name

    protected $fillable = [
        'member_id',
        'bonus_name',
        'description',
        'amount',
        'effective_date',
    ];

    public $timestamps = true; // Enable timestamps

    // Define the relationship with the Member model
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
