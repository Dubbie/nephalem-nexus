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
        Schema::create('item_property_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_property_id')->constrained()->onDelete('cascade');
            $table->string('set')->nullable();      // Corresponds to set1, set2, etc.
            $table->string('val')->nullable();
            $table->string('func')->nullable();
            $table->string('stat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_property_stats');
    }
};
