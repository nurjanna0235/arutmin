<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class coal_lcm extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari asumsi Laravel
    protected $table = 'coal_lcm';

    // Tentukan kolom kunci utama jika tidak menggunakan 'id'
    protected $primaryKey = 'id';

    // Daftar kolom yang dapat diisi secara massal
    protected $fillable = ['coal_getting_lebih_dari','coal_getting_kurang_dari','coal_hauling_lebih_dari','coal_hauling_kurang_dari','coal_cleaning_lebih_dari','coal_cleaning_kurang_dari','pit_support_lebih_dari','pit_support_kurang_dari','contract_reference','created_at','updated_at'];
}
