<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    protected $fillable = [
        'product_id',
        'count',
        'defected',
        'status',
    ];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function machineProductions()
    {
        return $this->hasMany(MachineProduction::class);
    }
}
