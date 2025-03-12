<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ApiPlatform\Metadata\ApiResource;

#[ApiResource]

class Tag extends Model
{
    protected $fillable = [
        'name', 
        'slug',
        'description',
        'icon',
       

    ];

    public function product()
    {
        return $this->morphToMany(Product::class, 'productable');
    }
}
