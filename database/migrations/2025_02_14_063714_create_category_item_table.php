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
        Schema::create('category_item', function (Blueprint $table) {
            $table->id();
            //  NOTE: I don't think this is really necessary since it's a pivot table
            // $table->foreignId('restaurant_id')->constrained();
            $table->foreignId('category_id')->constrained();
            $table->foreignId('item_id')->constrained();
            $table->unique(['category_id', 'item_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_category');
    }
};
