<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2);
            $table->string('image', 255)->nullable();
            $table->unsignedBigInteger('category_id');
            $table->boolean('status')->default(true); // Changé en boolean
            $table->unsignedBigInteger('productable_id');
            $table->string('productable_type');
            $table->json('options')->nullable();
            $table->boolean('is_draft')->default(false);
            $table->timestamps();

            // Clé étrangère pour la catégorie
            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('cascade');

            // Index pour les relations polymorphiques
            $table->index(['productable_id', 'productable_type']);
        });

        // Créez la table pivot pour la relation plusieurs-à-plusieurs avec les tags
        Schema::create('product_tag', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('tag_id');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_tag');
        Schema::dropIfExists('products');
    }
};
