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
