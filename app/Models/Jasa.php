<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jasa extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'jasas';

    public function detail_paket(){
        return $this->hasMany(DetailPaket::class);
    }

    public function kategori(){
        return $this->belongsTo(kategori::class, 'kategori_id');
    }

    public function rincian_jasa(){
        return $this->hasMany(RincianJasa::class);
    }

    public function detail_transaksi(){
        return $this->hasMany(DetailTransaksi::class);
    }

}
