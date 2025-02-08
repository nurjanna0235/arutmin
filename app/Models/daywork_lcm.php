<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class daywork_lcm extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari asumsi Laravel
    protected $table = 'daywork_lcm';

    // Tentukan kolom kunci utama jika tidak menggunakan 'id'
    protected $primaryKey = 'id';

    public $timestamps = false;

    // Daftar kolom yang dapat diisi secara massal
    protected $fillable = ['id_kontraktor','contract_reference','created_at','updated_at',];

    public function valueDayworkLcMs(): HasMany
    {
        return $this->hasMany(daywork_lcm::class, 'id');
    }
}
