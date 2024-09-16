<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingTermin extends Model
{
    use HasFactory;
    protected $table = 'setting_termins';
    protected $guarded = ['id'];
    protected $casts = ['rincian'=> 'array'];
}
