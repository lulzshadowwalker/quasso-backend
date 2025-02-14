<?php

use App\Enums\SelectionType;
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
        Schema::create('option_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->constrained();
            $table->foreignId('item_id')->constrained();
            $table->string('name');
            $table->boolean('required')->default(false);
            //  TODO: Use enum class
            $table->enum('selection_type', array_map(
                fn($type): string => $type->value,
                SelectionType::cases(),
            ))->default(SelectionType::MULTIPLE->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('option_groups');
    }
};
