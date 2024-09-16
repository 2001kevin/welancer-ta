<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentProject extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'comment_projects';

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'senderUser_id', 'id');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'senderPegawai_id', 'id');
    }
}
