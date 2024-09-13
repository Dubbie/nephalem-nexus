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
        Schema::create('affix_mods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('affix_id')->constrained()->cascadeOnDelete();
            $table->string('code');
            $table->foreign('code')->references('code')->on('properties');
            $table->string('param');
            $table->string('min');
            $table->string('max');
            $table->unsignedTinyInteger('mod_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affix_mods');
    }
};
