<?php

namespace App\Models;
use App\Models\Pengguna;

use Illuminate\Database\Eloquent\Model;

class pengguna extends Model
{
    protected $fillable = ['name', 'email', 'password', 'nik', 'no_hp', 'alamat', 'level'];
}
