<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class single_rate extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari asumsi Laravel
    protected $table = 'single_rate';

    // Tentukan kolom kunci utama jika tidak menggunakan 'id'
    protected $primaryKey = 'id';

    // Daftar kolom yang dapat diisi secara massal
    protected $fillable = ['Total Base Rate OB (Rp/BCM)','Total Base Rate Coal (Rp/ton)','SR','Currency Adjustment','Premium Rate','General Escalation','Total Single Rate Actual (Rp/ton)','Contract Reference'];

}

