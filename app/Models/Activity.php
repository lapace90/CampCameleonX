<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ApiPlatform\Metadata\ApiResource;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[ApiResource]

class Activity extends Model
{
    use HasFactory;
    protected $fillable = [
        'guide',
        'duration',
        'meeting_point',
        'max_people',
        'difficulty_level',
    ];

    public function product()
    {
        return $this->morphOne(Product::class, 'productable');
    }

    
    // Relation avec les tags spécifiques
    public function specificTags()
    {
        return $this->morphToMany(Tag::class, 'taggable')
            ->where('is_global', false);
    }

    public function calculateTags()
    {
        $tags = [];

        // Logique spécifique aux Activity (ex: basée sur la difficulté)
        if ($this->difficulty_level > 5) {
            $tags[] = 'extreme';
        }

        return $tags;
    }
}
