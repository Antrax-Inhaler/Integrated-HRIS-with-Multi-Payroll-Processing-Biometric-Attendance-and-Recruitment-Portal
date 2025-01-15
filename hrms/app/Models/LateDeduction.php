<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LateDeduction extends Model
{
    use HasFactory;

    // Define the table name (optional if it follows Laravel conventions)
    protected $table = 'late_deductions';

    // Specify the fillable fields for mass assignment
    protected $fillable = ['amount', 'effective_month'];

    /**
     * Mutator: Format effective_month as 'Y-m' (Year-Month).
     */
    public function setEffectiveMonthAttribute($value)
    {
        $this->attributes['effective_month'] = $value . '-01'; // Store as YYYY-MM-01
    }

    /**
     * Accessor: Get only the Year-Month part.
     */
    public function getEffectiveMonthAttribute($value)
    {
        return date('Y-m', strtotime($value)); // Return 'YYYY-MM'
    }
}
