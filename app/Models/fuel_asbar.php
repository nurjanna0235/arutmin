<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class fuel_asbar extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari asumsi Laravel
    protected $table = 'fuel_asbar';

    // Tentukan kolom kunci utama jika tidak menggunakan 'id'
    protected $primaryKey = 'id';

    public $timestamps = false;

    // Daftar kolom yang dapat diisi secara massal
    protected $fillable = ['id_kontraktor','item','fuel_index','distance','created_at','updated_at'];
}
