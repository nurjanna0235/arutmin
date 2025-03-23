<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class other_items_lcm extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari asumsi Laravel
    protected $table = 'other_items_lcm';

    // Tentukan kolom kunci utama jika tidak menggunakan 'id'
    protected $primaryKey = 'id';

    protected $fillable = ['rate_actual_hrm_lcm_base_rate_lebih_dari','rate_actual_hrm_lcm_base_rate_kurang_dari','contract_reference','created_at','updated_at','name_contract'];
}
