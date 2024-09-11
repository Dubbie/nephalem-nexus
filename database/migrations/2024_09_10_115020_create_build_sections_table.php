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
        Schema::create('build_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('build_id')->constrained('builds')->cascadeOnDelete();
            $table->string('title');
            $table->morphs('sectionable');  // sectionable_id and sectionable_type (polymorphic)
            $table->unsignedSmallInteger('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('build_sections');
    }
};
