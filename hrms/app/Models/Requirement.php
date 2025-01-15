<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    use HasFactory;
    protected $table = 'requirements';

    protected $fillable = [
        'job_listing_id', // Foreign key to job listing
        'requirement_name', // Name of the requirement
        'file_path', // Path to the file associated with the requirement
    ];

    // Define the relationship with the JobListing model
    public function jobListing()
    {
        return $this->belongsTo(JobListing::class, 'job_listing_id');
    }
    public $timestamps = true;
}
