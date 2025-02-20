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

            $table->boolean('is_gluten_free')->nullable();
            $table->boolean('is_lactose_free')->nullable();
            $table->boolean('is_vegan')->nullable();
            $table->boolean('is_new')->nullable();
            $table->boolean('is_popular')->nullable();

            $table->boolean('is_active')->default(true);
            $table->boolean('is_hidden')->default(false);

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
