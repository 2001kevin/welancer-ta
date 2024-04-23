<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RincianJasa extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'rincian_jasas';

    public function jasa(){
        return $this->belongsTo(Jasa::class);
    }

    public function detailJasa(){
        return $this->hasMany(DetailJasa::class);
    }
}
