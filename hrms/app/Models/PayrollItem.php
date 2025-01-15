<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollItem extends Model
{
    use HasFactory;
    protected $table = 'payroll_items';

    protected $fillable = [
        'payroll_id',
        'member_id',
        'basic_salary',
        'gross_salary',
        'deductions',
        'late_deduction',
        'late_hours',
        'late_count',
        'total_hours',
        'net_salary',
        'hourly_rate',
        'add_com_total',
        'pera_aca_total',
        'undertime_hours',
        'undertime_deduction',
    ];

    public $timestamps = true;
    public function deduction()
    {
        return $this->belongsTo(Deduction::class);
    }


public function member()
{
    return $this->belongsTo(Member::class, 'member_id');
}
public function payroll()
{
    return $this->belongsTo(Payroll::class, 'payroll_id');
}

}
