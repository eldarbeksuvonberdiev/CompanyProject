<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];

    public function deliveryNoteMaterials()
    {
        return $this->hasMany(MaterialDeliveryNote::class);
    }


}
