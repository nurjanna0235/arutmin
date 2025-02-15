<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ob_lcm extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari asumsi Laravel
    protected $table = 'ob_lcm';

    // Tentukan kolom kunci utama jika tidak menggunakan 'id'
    protected $primaryKey = 'id';

    protected $fillable = ['load_and_haul_lcm_base_rate_lebih_dari','load_and_haul_lcm_base_rate_kurang_dari','pit_support_lebih_dari','pit_support_kurang_dari','pit_lighting_lebih_dari','pit_lighting_kurang_dari','haul_road_maintenance_lebih_dari','haul_road_maintenance_kurang_dari','dewatering_sediment_pit_active_lebih_dari','dewatering_sediment_pit_active_kurang_dari','water_treatment_lebih_dari','water_treatment_kurang_dari','total_rate_ob_actual_kurang_dari','total_rate_ob_actual_lebih_dari','contract_reference','created_at','updated_at'];
}

