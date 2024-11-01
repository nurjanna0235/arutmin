<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class other extends Model

{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari asumsi Laravel
    protected $table = 'other';

    // Tentukan kolom kunci utama jika tidak menggunakan 'id'
    protected $primaryKey = 'id';

    // Daftar kolom yang dapat diisi secara massal
    protected $fillable = ['Base Rate HRM LCM (Rp/ton/KM)','Currency Adjustment','Premium Rate','General Escalation','Rate Actual HRM LCM (Rp/ton/KM)','Contract Reference'];

 
}


