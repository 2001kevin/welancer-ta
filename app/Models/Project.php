<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'projects';

    public function subGrup()
    {
        return $this->belongsTo(MappingSubGrup::class, 'sub_grup_id', 'id');
    }

    public function comments(){
        return $this->hasMany(CommentProject::class);
    }
}
