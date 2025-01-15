<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'system_name',
        'main_color',
        'background_color',
        'text_color',
        'logo',
        'topbar_bg_color',
        'sidebar_bg_color',
        'font_style',
    ];
}
