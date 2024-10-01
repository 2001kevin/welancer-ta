<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\FixPricesUpdated;

class transaksi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'transaksis';
    protected $casts = ['rincian' => 'array'];

    public function detail_transaksi(){
        return $this->hasMany(DetailTransaksi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
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

    public function terminPembayaran()
    {
        return $this->hasMany(TerminPembayaran::class);
    }

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::updated(function ($transaction) {
    //         if ($transaction->isDirty('fix_prices') && !is_null($transaction->fix_prices)) {
    //             event(new FixPricesUpdated($transaction));
    //         }
    //     });
    // }
}
