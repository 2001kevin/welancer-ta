<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class paketJasa extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'paket_jasas';

    public function jasa(){
        return $this->hasMany(Jasa::class);
    }
}
