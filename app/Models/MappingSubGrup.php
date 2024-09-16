<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MappingSubGrup extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'mapping_sub_grups';

    public function mapping_grups(){
        return $this->belongsTo(MappingGrup::class, 'mapping_grup_id', 'id');
    }

    public function detailTransaksi(){
        return $this->belongsTo(DetailTransaksi::class);
    }

    public function transaksi(){
        return $this->belongsTo(transaksi::class);
    }

    public function pegawai(){
        return $this->belongsTo(Pegawai::class);
    }

    public function projects(){
        return $this->hasMany(Project::class);
    }
}
