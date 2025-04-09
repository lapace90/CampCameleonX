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
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->string('image')->nullable();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->boolean('status')->default(true);
            $table->morphs('productable');
            $table->boolean('is_draft')->default(false);
            $table->timestamps();

            // Index pour les relations polymorphiques
            $table->index(['productable_id', 'productable_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
