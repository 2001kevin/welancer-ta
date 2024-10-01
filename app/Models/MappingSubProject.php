<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MappingSubProject extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'mapping_sub_projects';

    public function rincianJasa(){
        return $this->belongsTo(RincianJasa::class);
    }

    public function subGrup(){
        return $this->belongsTo(MappingSubGrup::class, 'mapping_sub_grup_id');
    }
}
