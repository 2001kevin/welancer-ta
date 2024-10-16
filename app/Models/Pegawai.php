<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Foundation\Auth\Pegawai as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model implements Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = ['id'];
    protected $table = 'pegawais';
    protected $primaryKey = 'id';

    public function detailJasa(){
        return $this->hasMany(DetailJasa::class);
    }

    public function mappingGrup(){
        return $this->hasMany(MappingGrup::class);
    }

    public function diskusis(){
        return $this->hasMany(Diskusi::class);
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    public function skills()
    {
        return $this->belongsToMany(skill::class, 'pegawai_skills')
        ->withPivot('level');
    }

    // public function getAuthIdentifierName() {
    //     return 'id';
    // }

    // public function getAuthIdentifier() {
    //     return $this->getKey();
    // }

    // public function getAuthPassword() {
    //     return $this->password;
    // }

    public function getAuthIdentifierName() {
        return 'id'; // Kolom yang menjadi primary key di tabel pegawai
    }

    public function getAuthIdentifier() {
        return $this->getKey(); // Mengembalikan nilai primary key dari model
    }

    public function getAuthPassword() {
        return $this->password; // Kolom yang menyimpan password
    }

    // Method untuk "Remember Me"
    public function getRememberToken() {
        return $this->remember_token; // Kolom yang menyimpan token untuk "Remember Me"
    }

    public function setRememberToken($value) {
        $this->remember_token = $value; // Set nilai remember token
    }

    public function getRememberTokenName() {
        return 'remember_token'; // Nama kolom yang menyimpan token "Remember Me"
    }
}
