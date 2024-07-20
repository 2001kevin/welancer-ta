<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TerminPembayaran extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'termin_pembayarans';

    public function transaksi(){
        return $this->belongsTo(transaksi::class);
    }
}
