<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    use HasFactory;
    protected $table = 'bonuses';

    protected $fillable = [
        'bonus_name',
        'description',
        'amount',
    ];

    public $timestamps = true;
}
