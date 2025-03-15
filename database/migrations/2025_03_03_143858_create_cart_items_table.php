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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->constrained();
            $table->foreignId('cart_id')->constrained();
            //  NOTE: 0, in-case e.g. the guest adds an addon to a non-existent item in the cart
            $table->unsignedInteger('quantity')->default(0);
            $table->foreignId('item_id')->constrained();
            $table->decimal('unit_price', 10, 2);
            $table->boolean('draft')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
