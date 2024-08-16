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

    // protected static function booted()
    // {
    //     static::saved(function ($rincianJasa) {
    //         $jasa = $rincianJasa->jasa;
    //         $jasa->min_price = $jasa->rincian_jasa->min('harga');
    //         $jasa->max_price = $jasa->rincian_jasa->max('harga');
    //         $jasa->save();
    //     });

    //     static::deleted(function ($rincianJasa) {
    //         $jasa = $rincianJasa->jasa;
    //         $jasa->min_price = $jasa->rincianJasa()->min('harga');
    //         $jasa->max_price = $jasa->rincianJasa()->max('harga');
    //         $jasa->save();
    //     });
    // }
}
