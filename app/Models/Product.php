<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'image',
        'price',
        'slug'
    ];

    public function materials()
    {
        return $this->belongsToMany(Material::class, 'product_ingredients')
                    ->withPivot(['value', 'unit'])
                    ->withTimestamps();
    }
}
