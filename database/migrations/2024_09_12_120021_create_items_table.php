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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');  // Item name, e.g., "Hand Axe", "Plate Mail"
            $table->string('code')->unique();  // Item code, e.g., 'hax', 'plt'
            $table->string('type')->nullable();  // General item type, e.g., 'axe', 'armor'
            $table->string('gfx_base')->nullable();  // Graphics file name (like 'hax')
            $table->string('gfx_unique')->nullable();  // Graphics file name (like 'hax')
            $table->string('gfx_set')->nullable();  // Graphics file name (like 'hax')
            $table->unsignedSmallInteger('width');
            $table->unsignedSmallInteger('height');
            $table->integer('level_requirement')->nullable();  // Required level
            $table->integer('max_sockets')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
