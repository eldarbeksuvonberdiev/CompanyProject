<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WarehouseMaterial extends Model
{
    protected $fillable = [
        'warehouse_id',
        'material_id',
        'value',
    ];
}
