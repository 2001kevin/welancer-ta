<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'transaksis';

    public function detail_transaksi(){
        return $this->hasMany(DetailTransaksi::class);
    }

    public function pegawai(){
        return $this->belongsTo(Pegawai::class);
    }

    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }

    public function mappingGrup(){
        return $this->hasMany(MappingGrup::class);
    }

    public function diskusis(){
        return $this->hasMany(Diskusi::class);
    }
}
