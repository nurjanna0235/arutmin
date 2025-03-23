<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class coal extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari asumsi Laravel
    protected $table = 'coal';

    // Tentukan kolom kunci utama jika tidak menggunakan 'id'
    protected $primaryKey = 'id';

    // Daftar kolom yang dapat diisi secara massal
    protected $fillable = ['clean_coal','loading_and_ripping','coal_hauling','hrm','pit_support','sub_total_base_rate_coal','currency_adjustment','premium_rate','general_escalation','total_rate_coal_actual','contract_reference','created_at','updated_at','name_contract'];
};