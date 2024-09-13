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
        Schema::create('property_stats', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->foreign('code')->references('code')->on('properties')->cascadeOnDelete();
            $table->string('stat');
            $table->foreign('stat')->references('stat')->on('stats');
            $table->string('set')->nullable();
            $table->string('value')->nullable();
            $table->string('function')->nullable();
            $table->unsignedTinyInteger('stat_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_stats');
    }
};
