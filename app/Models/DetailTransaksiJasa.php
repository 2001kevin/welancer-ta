<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksiJasa extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'detail_transaksi_jasas';

    public function DetailTransaksi(){
        return $this->belongsTo(DetailTransaksi::class, 'detail_transaksi_id', 'id');
    }

    public function rincianJasa(){
        return $this->belongsTo(RincianJasa::class, 'detail_jasa_id', 'id');
    }
}
