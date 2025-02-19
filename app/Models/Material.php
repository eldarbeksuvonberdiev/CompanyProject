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

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_ingredients')
                    ->withPivot(['value', 'unit'])
                    ->withTimestamps();
    }
}
