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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->json('description')->nullable();
            $table->decimal('price', 10, 2);

            $table->float('weight')->nullable();
            $table->float('calories')->nullable();
            $table->float('fat')->nullable();
            $table->float('carbohydrates')->nullable();
            $table->float('protein')->nullable();
            $table->float('sugar')->nullable();

            $table->boolean('gluten_free')->nullable();
            $table->boolean('lactose_free')->nullable();
            $table->boolean('vegan')->nullable();
            $table->boolean('new')->nullable();
            $table->boolean('popular')->nullable();

            $table->boolean('active')->default(true);
            $table->boolean('hidden')->default(false);

            $table->foreignId('restaurant_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
