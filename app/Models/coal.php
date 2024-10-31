<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class coal extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari asumsi Laravel
    protected $table = 'coal';

    // Tentukan kolom kunci utama jika tidak menggunakan 'id'
    protected $primaryKey = 'id';

    // Daftar kolom yang dapat diisi secara massal
    protected $fillable = ['Clean Coal (Rp/ton)','Loading and Ripping (Rp/ton)','Coal Hauling @8,463 Km (Rp/ton)','HRM @8,463 Km (Rp/ton)','Pit Support (Rp/ton)','Sub Total Base Rate Coal (Rp/ton)','Currency Adjustment','Premium Rate','General Escalation','Total Rate Coal Actual (Rp/ton)','Contract Reference'];
}
