<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;
    protected $table = 'job_applications';

    protected $fillable = [
        'job_listing_id',
        'applicant_id',
        'comment',
        'status',
    ];

    /**
     * Relationship: A job application belongs to a job listing.
     */
    public function jobListing()
    {
        return $this->belongsTo(JobListing::class);
    }

    /**
     * Relationship: A job application belongs to an applicant.
     */
    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
    public $timestamps = true;
}
