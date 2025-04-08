<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
    protected $model = \App\Models\Product::class;
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
            'category_id' => $this->faker->randomElement(\App\Models\Category::pluck('id')),
            'image' => $this->faker->imageUrl(),
            'status' => $this->faker->randomElement(['available', 'unavailable']),
            'productable_type' => $this->faker->randomElement(['App\Models\Room', 'App\Models\Activity','App\Models\Dish', 'App\Models\Menu', ]),
            'productable_id' => $this->faker->randomElement([
                \App\Models\Room::factory(),
                \App\Models\Activity::factory(),
                \App\Models\Dish::factory(),
                \App\Models\Menu::factory(),
            ]),
            'options' => \App\Models\Option::factory()->count(3),
            'is_draft' => $this->faker->boolean(),
        ];
    }
}
