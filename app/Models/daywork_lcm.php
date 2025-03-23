<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class daywork_lcm extends Model
{
    protected $table = 'daywork_lcm';

    protected $primaryKey = 'id_daywork_lcm';

    public $timestamps = false;

    protected $fillable = [
        'item',
        'model',
        'rate_per_hour',
        'fuel_burn_rate',
        'id_contract',
        'created_at',
        'updated_at',
        'name_contract',
    ];
}
