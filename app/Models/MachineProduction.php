<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MachineProduction extends Model
{
    protected $fillable = [
        'production_id',
        'machine_id',
        'user_id',
        'count',
        'defected',
        'status',
    ];
}
