<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ApiPlatform\Metadata\ApiResource;

#[ApiResource]
class Room extends Model
{
    protected $fillable = [
        'capacity',
        'availability',
    ];

    public function product()
    {
        return $this->morphOne(Product::class, 'productable');
    }

    public function options()
    {
        return $this->morphMany(Option::class, 'product');
    }
}
