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
		Schema::table('cell_assignments', function (Blueprint $table) {
            // Option 1: TEXT column for storing JSON as a string
            $table->text('pupil_ids')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cell_assignments', function (Blueprint $table) {
            $table->dropColumn('pupil_ids');
        });
    }
};
