<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class pit_clearing_lcm extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari asumsi Laravel
    protected $table = 'pit_clearing_lcm';

    // Tentukan kolom kunci utama jika tidak menggunakan 'id'
    protected $primaryKey = 'id';

    protected $fillable = ['rate_actual_base_rate_lebih_dari','rate_actual_base_rate_kurang_dari','created_at','updated_at'];
}
