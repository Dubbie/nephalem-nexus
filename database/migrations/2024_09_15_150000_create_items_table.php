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
            $table->string('gfx')->nullable();  // Graphics file name (like 'hax')
            $table->unsignedSmallInteger('width');
            $table->unsignedSmallInteger('height');
            $table->integer('level_requirement')->nullable();  // Required level
            $table->integer('max_sockets')->default(0);
            $table->string('itemable_type');  // This will be the type of item model (Armor, Weapon, etc.)
            $table->unsignedBigInteger('itemable_id'); // The ID of the specific item
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
