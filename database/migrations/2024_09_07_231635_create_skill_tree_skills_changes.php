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
        Schema::create('skill_tree_changes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('skill_tree_id')->constrained('skill_trees');
            $table->foreignId('skill_id')->constrained('skills');
            $table->smallInteger('level');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skill_tree_skills');
    }
};
