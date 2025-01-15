<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Member extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'surname',
        'given_name',
        'middle_name',
        'profile_picture',
        'valid_id', // Add this line
        'email',
        'contact_number',
        'password',
        'position',
        'salary',
        'department',
        'balance_vacation',
        'balance_sick',
        'fingerprint_id',
        'is_verified',
    ];

    // Mutator for surname
    public function setSurnameAttribute($value)
    {
        $this->attributes['surname'] = ucwords(strtolower($value));
    }

    // Mutator for given_name
    public function setGivenNameAttribute($value)
    {
        $this->attributes['given_name'] = ucwords(strtolower($value));
    }

    // Mutator for middle_name
    public function setMiddleNameAttribute($value)
    {
        $this->attributes['middle_name'] = ucwords(strtolower($value));
    }
    public function deductions()
    {
        return $this->hasMany(MemberDeduction::class);
    }
    
    public function bonuses()
    {
        return $this->hasMany(MemberBonus::class);
    }
    
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
    public function position()
    {
        // Define relationship with the Position model (if the field holds position ID)
        return $this->belongsTo(Position::class, 'position'); // 'position' is the column in members table
    }
    
    public function department()
    {
        // Define relationship with the Department model (if the field holds department ID)
        return $this->belongsTo(Department::class, 'department'); // 'department' is the column in members table
    }
    
}
