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
        Schema::create('weapons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade');  // Links to the base item
            $table->integer('min_damage')->nullable();
            $table->integer('max_damage')->nullable();
            $table->integer('min_two_handed_damage')->nullable();  // For 2-handed weapons
            $table->integer('max_two_handed_damage')->nullable();
            $table->integer('min_missile_damage')->nullable(); // For ranged
            $table->integer('max_missile_damage')->nullable();
            $table->integer('speed')->nullable();
            $table->boolean('has_splash')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weapons');
    }
};
