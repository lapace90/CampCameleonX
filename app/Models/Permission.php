<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ApiPlatform\Metadata\ApiResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[ApiResource]
class Permission extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'action',
    ];

    // Si une permission appartient à plusieurs rôles
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    // Si une permission est attribuée directement à des utilisateurs
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
