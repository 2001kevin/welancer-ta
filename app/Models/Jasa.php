<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jasa extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'jasas';

    public function paketJasa(){
        return $this->belongsTo(paketJasa::class, 'id');
    }

    public function kategori(){
        return $this->belongsTo(kategori::class, 'id');
    }

}
