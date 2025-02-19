<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductIngredient extends Model
{
    protected $fillable = [
        'product_id',
        'material_id',
        'value',
        'unit'
    ];
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
