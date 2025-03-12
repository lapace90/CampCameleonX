<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ApiPlatform\Metadata\ApiResource;

#[ApiResource]

class Activity extends Model
{
    protected $fillable = [
        'guide',
        'duration',
        'meeting_point',
        'max_people'
    ];

    public function product()
    {
        return $this->morphOne(Product::class, 'productable');
    }
}
