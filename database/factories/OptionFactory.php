<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Option;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Option>
 */
class OptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Option::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Choose a random product type
        $productType = $this->faker->randomElement([
            'App\Models\Room',
            'App\Models\Activity',
            'App\Models\Dish',
            'App\Models\Menu',
        ]);

        // Create a related product and get its ID
        $productId = match ($productType) {
            'App\Models\Room' => \App\Models\Room::factory()->create()->id,
            'App\Models\Activity' => \App\Models\Activity::factory()->create()->id,
            'App\Models\Dish' => \App\Models\Dish::factory()->create()->id,
            'App\Models\Menu' => \App\Models\Menu::factory()->create()->id,
        };

        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'product_id' => $productId,
            'product_type' => $productType,
        ];
    }
}
