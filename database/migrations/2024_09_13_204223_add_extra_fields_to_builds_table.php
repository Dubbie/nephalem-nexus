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
        Schema::table('builds', function (Blueprint $table) {
            $table->dropColumn('active');
            $table->string('status')->default('draft');
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->foreignId('declined_by')->nullable()->constrained('users');
            $table->string('decline_reason')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('builds', function (Blueprint $table) {
            $table->dropForeign(['approved_by', 'declined_by']);
            $table->dropColumn('declined_by');
            $table->dropColumn('approved_by');
            $table->dropColumn('decline_reason');
            $table->dropColumn('status');
            $table->boolean('active')->default(false);
        });
    }
};
