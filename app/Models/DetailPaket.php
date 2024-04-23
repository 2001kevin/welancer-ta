<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPaket extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'detail_pakets';

    public function jasa(){
        return $this->belongsTo(Jasa::class);
    }

    public function paket_jasa(){
        return $this->belongsTo(paketJasa::class);
    }


}
