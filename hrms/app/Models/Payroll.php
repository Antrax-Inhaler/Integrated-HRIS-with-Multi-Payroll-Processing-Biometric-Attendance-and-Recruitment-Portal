<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;
    protected $table = 'payroll';

    protected $fillable = [
        'ref_no',
        'date_from',
        'date_to',
        'type',
        'status',
    ];

    public $timestamps = true;

    // In Payroll.php (Model)
public function payrollItems()
{
    return $this->hasMany(PayrollItem::class, 'payroll_id');
}
public function items()
{
    return $this->hasMany(PayrollItem::class, 'payroll_id');
}
}
