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
        Schema::create('item_properties', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->boolean('done')->default(false);
            $table->text('desc')->nullable();
            $table->string('param')->nullable();
            $table->string('min')->nullable();
            $table->string('max')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('eol')->default(false);  // If "*eol" means end of life or status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_properties');
    }
};
