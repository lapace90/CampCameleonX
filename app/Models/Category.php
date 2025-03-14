<?php

namespace App\Models;

use ApiPlatform\Metadata\ApiResource;
use Illuminate\Database\Eloquent\Model;

#[ApiResource]

class Category extends Model
{
    protected $fillable = [
        'type',
        'name',
        'photo',
        'description',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }

    public function getPhotoUrlAttribute()
    {
        return $this->photo ? asset('storage/' . $this->photo) : null;
    }

    public static function rules()
    {
        return [
            'type' => (['Activity', 'Menu']),
            'name' => 'required|max:50',
        ];
    }
}
