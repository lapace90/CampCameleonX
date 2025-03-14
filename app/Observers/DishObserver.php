<?php

namespace App\Observers;

use App\Models\Dish;
use App\Models\Tag;

class DishObserver
{
    /**
     * Handle the Dish "created" event.
     */
    public function created(Dish $dish): void
    {
        //
    }

    /**
     * Handle the Dish "updated" event.
     */
    public function updated(Dish $dish)
    {
        // Met à jour les tags spécifiques du Dish
        $tags = $dish->calculateSpecificTags();
        $tagIds = Tag::whereIn('name', $tags)->where('is_global', false)->pluck('id');
        $dish->specificTags()->sync($tagIds);
        
        // Optionnel : propager aux produits associés
        $dish->product?->touch(); // Forcer une mise à jour du cache si nécessaire
    }

    /**
     * Handle the Dish "deleted" event.
     */
    public function deleted(Dish $dish): void
    {
        //
    }

    /**
     * Handle the Dish "restored" event.
     */
    public function restored(Dish $dish): void
    {
        //
    }

    /**
     * Handle the Dish "force deleted" event.
     */
    public function forceDeleted(Dish $dish): void
    {
        //
    }
}
