<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ApiPlatform\Metadata\ApiResource;

#[ApiResource]
class Option extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'product_id',
        'product_type',
    ];

    public function product()
    {
        return $this->morphTo();
    }
}
