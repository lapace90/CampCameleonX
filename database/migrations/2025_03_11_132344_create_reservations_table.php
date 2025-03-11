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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->dateTime('date');
            $table->dateTime('checkin');
            $table->dateTime('checkout');
            $table->decimal('amount', 8, 2);
            $table->string('invoice');
            $table->string('booking_source');
            $table->enum('payment_status', ['paid', 'pending', 'canceled'])->default('pending');
            $table->integer('number_of_children');
            $table->integer('number_of_adults');
            $table->unsignedBigInteger('room_id');
            $table->text('comment')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->unsignedBigInteger('activity_id')->nullable();
            $table->unsignedBigInteger('menu_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            // $table->unsignedBigInteger('product_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
