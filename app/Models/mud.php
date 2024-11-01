<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mud extends Model
{
     use HasFactory;

    // Tentukan nama tabel jika berbeda dari asumsi Laravel
    protected $table = 'mud';

    // Tentukan kolom kunci utama jika tidak menggunakan 'id'
    protected $primaryKey = 'id';

    // Daftar kolom yang dapat diisi secara massal
    protected $fillable =['Mud Removal - Load and Haul (Rp/BCM)','Currency Adjustment','Premium Rate','General Escalation','Rate Actual (Rp/Ha)','Contract Reference'];
}
