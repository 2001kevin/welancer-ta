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

    
}
