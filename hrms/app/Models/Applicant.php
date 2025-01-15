<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Applicant extends Authenticatable
{
    use Notifiable;

    // Define the table name if it is not the default 'applicants'
    protected $table = 'applicants';

    // Fillable attributes for mass assignment
    protected $fillable = [
        'name',
        'email',
        'contact_number',
        'password',
        // add other columns as needed
    ];

    // Hide attributes from array/json serialization
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Cast attributes to native types
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Additional methods or relationships can be defined here
}
