<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'comments';

    public function diskusi(){
        return $this->belongsTo(Diskusi::class, 'diskusi_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'senderUser_id', 'id');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'senderPegawai_id', 'id');
    }
}
