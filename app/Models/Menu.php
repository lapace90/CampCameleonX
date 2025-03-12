<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ApiPlatform\Metadata\ApiResource;

#[ApiResource]

class Menu extends Model
{
    public function product()
    {
        return $this->morphOne(Product::class, 'productable');
    }
}
