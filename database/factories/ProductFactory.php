<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Log;
use App\Models\Product;
use App\Models\Option;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'category_id' => function () {
                $category = Category::inRandomOrder()->first();
                if (!$category) {
                    Log::error('Aucune catégorie trouvée pour l\'ajout d\'un produit.');
                    return null;
                } else {
                    Log::info('Catégorie trouvée : ' . $category->id);
                    return $category->id;
                }
            },
            'image' => $this->faker->imageUrl(),
            'status' => $this->faker->boolean(),
            'productable_type' => $this->faker->randomElement(['App\Models\Room', 'App\Models\Activity', 'App\Models\Dish', 'App\Models\Menu',]),
            'productable_id' => function (array $attributes) {
                $type = $attributes['productable_type'];
                $productable = $type::factory()->create();
                Log::info("Création du produit de type {$type} avec ID : {$productable->id}");
                return $productable->id;
            },
            'is_draft' => $this->faker->boolean(),
        ];
    }

    // Ajoutons des options pour chaque produit
    public function configure()
    {
        return $this->afterCreating(function (Product $product) {
            $options = Option::inRandomOrder()->take(3)->pluck('id');
            $product->options()->attach($options);
        });
    }
}
