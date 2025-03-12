<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ApiPlatform\Metadata\ApiResource;

#[ApiResource]

class Dish extends Model
{
    protected $fillable = [
        'ingredient_id',
        'is_vegetarian',
        'is_spicy',
        'is_gluten_free',
        'is_lactose_free',
        'is_nut_free',
        'is_vegan'
    ];

    public function product()
    {
        return $this->morphOne(Product::class, 'productable');
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class);
    }
}
