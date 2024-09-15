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
            $table->unsignedInteger('min_damage')->nullable();
            $table->unsignedInteger('max_damage')->nullable();
            $table->unsignedInteger('min_two_handed_damage')->nullable();  // For 2-handed weapons
            $table->unsignedInteger('max_two_handed_damage')->nullable();
            $table->unsignedInteger('min_missile_damage')->nullable(); // For ranged
            $table->unsignedInteger('max_missile_damage')->nullable();
            $table->integer('speed')->nullable();
            $table->unsignedInteger('required_strength')->default(0);
            $table->unsignedInteger('required_dexterity')->default(0);
            $table->boolean('has_splash')->default(false);
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
