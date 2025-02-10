<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialDeliveryNote extends Model
{
    protected $fillable = [
        'material_id',
        'delivery_note_id',
        'unit',
        'amount',
        'price',
        'summ',
    ];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
