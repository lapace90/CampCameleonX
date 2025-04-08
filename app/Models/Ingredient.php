<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ApiPlatform\Metadata\ApiResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[ApiResource]

class Ingredient extends Model
{
    use HasFactory;
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
