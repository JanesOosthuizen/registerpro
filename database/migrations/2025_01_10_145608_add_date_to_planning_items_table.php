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
        Schema::table('planning_items', function (Blueprint $table) {
			$table->date('date')->nullable(); // Add a nullable date column
		});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('planning_items', function (Blueprint $table) {
			$table->dropColumn('date');
		});
    }
};
