<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diskusi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'diskusis';

    public function mappingGrup()
    {
        return $this->belongsTo(MappingGrup::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function transaksis()
    {
        return $this->belongsTo(transaksi::class, 'transaksi_id', 'id');
    }

    public function pegawais()
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'diskusi_id');
    }
}
