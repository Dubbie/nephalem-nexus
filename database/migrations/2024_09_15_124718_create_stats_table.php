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
        Schema::create('stats', function (Blueprint $table) {
            $table->string('stat')->primary();
            $table->string('desc_func')->nullable();
            $table->unsignedInteger('desc_priority')->nullable();
            $table->string('desc_value')->nullable();
            $table->string('desc_str_pos')->nullable();
            $table->foreign('desc_str_pos')->references('key')->on('tbl_entries');
            $table->string('desc_str_neg')->nullable();
            $table->foreign('desc_str_neg')->references('key')->on('tbl_entries');
            $table->string('desc_str_2')->nullable();
            $table->foreign('desc_str_2')->references('key')->on('tbl_entries');
            $table->string('desc_group')->nullable();
            $table->string('desc_group_value')->nullable();
            $table->string('desc_group_str_pos')->nullable();
            $table->foreign('desc_group_str_pos')->references('key')->on('tbl_entries');
            $table->string('desc_group_str_neg')->nullable();
            $table->foreign('desc_group_str_neg')->references('key')->on('tbl_entries');
            $table->string('desc_group_str_2')->nullable();
            $table->foreign('desc_group_str_2')->references('key')->on('tbl_entries');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stats');
    }
};
