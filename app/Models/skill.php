<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class skill extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    protected $table = 'skills';

    public function detailJasa(){
        return $this->hasMany(DetailJasa::class);
    }
}
