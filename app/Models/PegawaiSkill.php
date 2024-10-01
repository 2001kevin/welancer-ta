<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PegawaiSkill extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'pegawai_skills';
    protected $primaryKey = 'id';

    public function skills()
    {
        return $this->belongsTo(Skill::class, 'skill_id');
    }

    public function pegawais()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
}
