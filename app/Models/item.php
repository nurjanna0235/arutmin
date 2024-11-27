<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari asumsi Laravel
    protected $table = 'item';

    // Tentukan kolom kunci utama jika tidak menggunakan 'id'
    protected $primaryKey = 'id_item';

    // Daftar kolom yang dapat diisi secara massal
    protected $fillable =['id_daywork','nama_item',];
}
