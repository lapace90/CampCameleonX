<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Category;
use App\Models\Reservation;
use ApiPlatform\Metadata\ApiResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[ApiResource]

class Product extends Model
{
    use HasFactory;
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
        'is_draft'
    ];

    protected $casts = [
        'status' => 'boolean',
        'options' => 'array',
        'is_draft' => 'boolean'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
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

    public function scopeDraft($query)
    {
        return $query->where('is_draft', true);
    }

    public function productable()
    {
        return $this->morphTo();
    }

    public function getImageAttribute($value)
    {
        return $value ? asset('storage/' . $value) : null;
    }

    // Tags globaux (ex: "promo")
    public function globalTags()
    {
        return $this->belongsToMany(Tag::class, 'product_tag')
            ->where('is_global', true)
            ->withTimestamps();
    }

    public function getAllTagsAttribute()
    {
        return $this->globalTags
            ->merge($this->productable->specificTags ?? collect())
            ->unique('id');
    }
}
