<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class value extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari asumsi Laravel
    protected $table = 'value';

    // Tentukan kolom kunci utama jika tidak menggunakan 'id'
    protected $primaryKey = 'id_value';

    // Daftar kolom yang dapat diisi secara massal
    protected $fillable =['id_item','nama_item','base_rate_exc','actual_rate_exc','fbr'];
}
