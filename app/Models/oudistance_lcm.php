<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class oudistance_lcm extends Model
{
    protected $table = 'oudistance_lcm';

    public $timestamps = false;

    protected $primaryKey = 'id';

    protected $fillable = [
        'activity',
        'item',
        'base_rate_high',
        'base_rate_low',
        'contractual_distance',
        'id_contract',
        'created_at',
        'updated_at',
    ];
}
