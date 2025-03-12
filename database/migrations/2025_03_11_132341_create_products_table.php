<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2);
            $table->string('image', 255)->nullable();
            $table->unsignedBigInteger('category_id'); 
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->unsignedBigInteger('productable_id'); // ID di Activity/Menu
            $table->string('productable_type'); // Classe del modello (Activity::class o Menu::class)
            $table->string('tags')->nullable();
            $table->json('options')->nullable();
            $table->boolean('is_draft')->default(false);

            // // Clé étrangère explicite
            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('cascade');
    
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
