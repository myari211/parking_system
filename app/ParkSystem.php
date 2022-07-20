<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParkSystem extends Model
{
    protected $fillable = [
        'vehicle_number',
        'gate_in',
        'gate_out',
        'unique_key',
        'price',
        'petugas_id',
        'created_at',
        'updated_at',
    ];

    public $incrementing = false;
}
