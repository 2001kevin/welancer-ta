<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MappingGrup extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'mapping_grups';

    public function diskusis(){
        return $this->hasMany(Diskusi::class);
    }

    // public function pegawais(){
    //     return $this->belongsTo(Pegawai::class);
    // }

    public function pegawais(){
        return $this->belongsTo(Pegawai::class, 'pegawai_id', 'id');
    }

    public function transaksis(){
        return $this->belongsTo(transaksi::class, 'transaksi_id', 'id');
    }

    public function mapping_sub_grups(){
        return $this->hasMany(MappingSubGrup::class);
    }
}
