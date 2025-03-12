<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Category;
use App\Models\Reservation;
use ApiPlatform\Metadata\ApiResource;

#[ApiResource]

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'category_id',
        'status',
        'productable_id',
        'productable_type',
        'options',
        'tags',
        'is_draft'
    ];

    // Casts pour les enums
    protected $casts = [
        'status' => 'string',
        'type' => 'string'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function reservations(): BelongsToMany
    {
        return $this->belongsToMany(Reservation::class)->withTimestamps();
    }
    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }

    public function productable()
    {
        return $this->morphTo(); // Relazione polimorfica
    }

    public function getOptionsAttribute($value)
    {
        return json_decode($value);
    }

    public function setOptionsAttribute($value)
    {
        $this->attributes['options'] = json_encode($value);
    }

    public function getTagsAttribute($value)
    {
        return json_decode($value);
    }

    public function setTagsAttribute($value)
    {
        $this->attributes['tags'] = json_encode($value);
    }

    public function getIsDraftAttribute($value)
    {
        return (bool) $value;
    }

    public function setIsDraftAttribute($value)
    {
        $this->attributes['is_draft'] = (int) $value;
    }

    public function getPhotoAttribute($value)
    {
        return $value ? asset('storage/' . $value) : null;
    }

    public function getImageAttribute($value)
    {
        return $value ? asset('storage/' . $value) : null;
    }

    public function tag()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
