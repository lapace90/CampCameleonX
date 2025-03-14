<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Ingredient;
use App\Observers\IngredientObserver;
use App\Models\Tag;
use App\Observers\TagObserver;
use App\Models\Dish;
use App\Observers\DishObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
         // Enregistrez l'observer ici
         Ingredient::observe(IngredientObserver::class);
         Tag::observe(TagObserver::class);
         Dish::observe(DishObserver::class);
    }
}
