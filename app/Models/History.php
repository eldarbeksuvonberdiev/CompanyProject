<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = [
        'material_id',
        'type',
        'status',
        'quantity',
        'was',
        'been',
        'from_id',
        'to_id',
    ];
}
