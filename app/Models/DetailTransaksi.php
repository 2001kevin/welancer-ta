<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'detail_transaksis';

    public function transaksi(){
        return $this->belongsTo(transaksi::class);
    }

    public function jasa(){
        return $this->belongsTo(Jasa::class);
    }

    public function detailTransaksiJasas()
    {
        return $this->hasMany(DetailTransaksiJasa::class, 'detail_transaksi_id');
    }

    public function detailJasas()
    {
        return $this->hasManyThrough(
            DetailJasa::class, // The final model you want to reach
            RincianJasa::class,
            Jasa::class, // The intermediate model
            'id', // Foreign key on the `jasas` table...
            'rincian_jasa_id', // Foreign key on the `detail_jasas` table...
            'jasa_id',
            'jasa_id', // Local key on the `detail_transaksis` table...
            'id',
            'id' // Local key on the `jasas` table...
        );
    }


}
