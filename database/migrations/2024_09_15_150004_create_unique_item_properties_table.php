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
        Schema::create('unique_item_properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unique_item_id')->references('id')->on('unique_items')->cascadeOnDelete();
            $table->string('code');
            $table->foreign('code')->references('code')->on('properties')->cascadeOnDelete();
            $table->string('parameter')->nullable();
            $table->string('min')->nullable();
            $table->string('max')->nullable();
            $table->unsignedSmallInteger('property_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unique_item_properties');
    }
};
