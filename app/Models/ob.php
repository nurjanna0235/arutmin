<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ob extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari asumsi Laravel
    protected $table = 'ob';

    // Tentukan kolom kunci utama jika tidak menggunakan 'id'
    protected $primaryKey = 'id';

    // Daftar kolom yang dapat diisi secara massal
    protected $fillable = ['Load and Haul (Rp/BCM)','Drill and Blast (if required) (Rp/BCM)','Pit Support (Rp/BCM)','Pit Lighting (Rp/BCM)','HRM (Rp/BCM)','Dump Maintenance (Rp/BCM)','Dewatering/Sediment (Rp/BCM)','Sub Total Base Rate OB (Rp/BCM)','SR','Currency Adjustment','Premium Rate','General Escalation','Total Rate OB Actual (Rp/BCM)','Contract Reference'];
}
