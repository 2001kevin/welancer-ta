<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailJasa extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'detail_jasas';

    public function skill(){
        return $this->belongsTo(skill::class);
    }

    public function rincianJasa(){
        return $this->belongsTo(RincianJasa::class);
    }

    public function pegawai(){
        return $this->belongsTo(Pegawai::class);
    }
}
