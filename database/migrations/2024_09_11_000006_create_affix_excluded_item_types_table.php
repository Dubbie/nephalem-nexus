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
        Schema::create('affix_excluded_item_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('affix_id')->constrained()->cascadeOnDelete();
            $table->string('item_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affix_excluded_item_types');
    }
};
