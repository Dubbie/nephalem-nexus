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
        Schema::create('item_property_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade');  // Links to the item
            $table->foreignId('item_property_stat_id')->constrained('item_property_stats')->onDelete('cascade');  // Links to the specific stat of the property
            $table->integer('value')->nullable();  // The value of the property for the item
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_property_values');
    }
};
