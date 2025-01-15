<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $table = 'leaves';

    protected $fillable = [
        'member_id',
        'vacation_leave',
        'mandatory_forced_leave',
        'sick_leave',
        'maternity_leave',
        'paternity_leave',
        'special_privilege_leave',
        'solo_parent_leave',
        'study_leave',
        'ten_day_vawc_leave',
        'rehabilitation_privilege',
        'special_leave_for_women',
        'special_emergency_calamity_leave',
        'adoption_leave',
        'others_type_of_leave',
        'within_philippines',
        'abroad',
        'abroad_specify',
        'in_hospital',
        'hospital_specify_illness',
        'outpatient',
        'outpatient_specify_illness',
        'special_leave_illness',
        'study_leave_completion_masters',
        'study_leave_bar_review',
        'monetization_of_leave_credits',
        'terminal_leave',
        'details_of_leave',
        'working_days_applied',
        'commutation',
        'inclusive_dates',
        'total_earned_sick',
        'total_earned_vacation',
        'less_this_application_vacation',
        'less_this_application_sick',
        'balance_vacation',
        'balance_sick',
        'authorize_officer_credits',
        'approval_status',
        'disapproval_reason',
        'authorize_officer_recommendation',
        'approved_days_with_pay',
        'approved_days_without_pay',
        'approved_others',
        'disapproved_due_to',
        'authorized_official',
    ];

    public $timestamps = true;

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
