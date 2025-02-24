<?php

namespace App\Models;

use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class pengguna extends Authenticatable
{
    use HasFactory, Notifiable,CanResetPassword;

    // Tentukan nama tabel jika berbeda dari asumsi Laravel
    protected $table = 'pengguna';

    // Tentukan kolom kunci utama jika tidak menggunakan 'id'
    protected $primaryKey = 'id';

    // Daftar kolom yang dapat diisi secara massal
    protected $fillable = ['username','password','email','nik','level','foto_profil'];
};

