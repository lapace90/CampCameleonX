<?php 

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\User::factory()->count(10)->create();
        \App\Models\Category::factory()->count(10)->create();

        // Seed Options with valid product IDs
        \App\Models\Product::factory()->count(5)->create()->each(function ($product) {
            \App\Models\Option::factory()->count(3)->create([
                'product_id' => $product->id,
                'product_type' => \App\Models\Product::class,
            ]);
        });

        // Seed Products with valid category IDs
        \App\Models\Product::factory()->count(10)->create([
            'category_id' => \App\Models\Category::factory()->create()->id,
        ]);

        // Seed Activities
        \App\Models\Activity::factory()->count(10)->create();

        // Seed Customers
        \App\Models\Customer::factory()->count(10)->create();

        // Seed Ingredients
        \App\Models\Ingredient::factory()->count(25)->create();

        // Seed Rooms with valid options
        \App\Models\Room::factory()->count(10)->create()->each(function ($room) {
            $room->options()->attach(\App\Models\Option::factory()->count(3)->create([
                'product_id' => $room->id,
                'product_type' => \App\Models\Room::class,
            ]));
        });

        // Seed Invoices with valid relationships
        \App\Models\Invoice::factory()->count(10)->create()->each(function ($invoice) {
            $invoice->options()->attach(\App\Models\Option::factory()->count(3)->create([
                'product_id' => $invoice->id,
                'product_type' => \App\Models\Invoice::class,
            ]));
            $invoice->customer()->associate(\App\Models\Customer::factory()->create());
            $invoice->reservation()->associate(\App\Models\Reservation::factory()->create());
            $invoice->save();
        });

        // Seed Reservations
        \App\Models\Reservation::factory()->count(10)->create();

        // Seed Tags
        \App\Models\Tag::factory()->count(20)->create();

        // Seed Dishes
        \App\Models\Dish::factory()->count(15)->create();

        // Seed Menus with valid dishes and options
        \App\Models\Menu::factory()->count(10)->create()->each(function ($menu) {
            $menu->options()->attach(\App\Models\Option::factory()->count(3)->create([
                'product_id' => $menu->id,
                'product_type' => \App\Models\Menu::class,
            ]));
            $menu->dishes()->attach(\App\Models\Dish::factory()->count(3)->create());
        });

        // Seed Permissions and Roles
        \App\Models\Permission::factory()->count(10)->create();
        \App\Models\Role::factory()->count(5)->create()->each(function ($role) {
            $role->permissions()->attach(\App\Models\Permission::factory()->count(3)->create());
        });
    }
}
