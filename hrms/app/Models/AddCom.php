<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddCom extends Model
{
    use HasFactory;

    // Specify the table name (if not following Laravel's naming convention)
    protected $table = 'add_com';

    // Mass assignable attributes
    protected $fillable = [
        'member_id',
        'amount',
        'month_year',
        'description',
    ];

    /**
     * Define the relationship with the Member model.
     */
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
}
