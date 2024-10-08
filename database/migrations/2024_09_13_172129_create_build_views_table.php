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
        Schema::create('build_views', function (Blueprint $table) {
            $table->id();
            $table->foreignId('build_id')->constrained('builds')->cascadeOnDelete();
            $table->string('ip_address', 45);
            $table->timestamps();

            $table->unique(['build_id', 'ip_address']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('build_views');
    }
};
