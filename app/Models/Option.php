<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ApiPlatform\Metadata\ApiResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[ApiResource]
class Option extends Model
{
    use HasFactory;
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
