<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ApiPlatform\Metadata\ApiResource;

#[ApiResource]

class Role extends Model
{
    protected $fillable = [
        'name',
        'description',
        'slug',
        'permissions'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
