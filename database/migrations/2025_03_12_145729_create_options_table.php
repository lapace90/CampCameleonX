<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2)->default(0.00);
            $table->unsignedBigInteger('product_id');
            $table->string('product_type');
            $table->timestamps();

            // Index pour améliorer les performances des requêtes polymorphiques
            $table->index(['product_id', 'product_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('options');
    }
};
