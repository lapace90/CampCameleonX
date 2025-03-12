<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $fillable = [
        'name',
        'is_vegetarian',
        'is_spicy',
        'is_gluten_free',
        'is_lactose_free',
        'is_nut_free',
        'is_vegan',
        'stock'
    ];

    public function dishes()
    {
        return $this->belongsToMany(Dish::class);
    }
}
