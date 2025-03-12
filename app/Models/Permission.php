<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ApiPlatform\Metadata\ApiResource;

#[ApiResource]

class Permission extends Model
{
    protected $fillable = [
        'name',
        'action'
    ];
}
