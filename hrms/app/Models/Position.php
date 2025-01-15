<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;
    protected $table = 'positions';

    protected $fillable = [
        'position_name',
    ];

    public $timestamps = true;
    public function members()
    {
        return $this->hasMany(Member::class, 'position', 'id');
    }
}
