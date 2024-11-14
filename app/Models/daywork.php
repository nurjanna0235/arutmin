<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class daywork extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari asumsi Laravel
    protected $table = 'daywork';

    // Tentukan kolom kunci utama jika tidak menggunakan 'id'
    protected $primaryKey = 'id';

    // Daftar kolom yang dapat diisi secara massal
    protected $fillable =['item','base_rate_exc_fuel','actual_rate_exc_fuel','fbr'];
}
