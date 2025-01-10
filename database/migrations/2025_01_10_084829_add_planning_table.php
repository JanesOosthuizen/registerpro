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
        Schema::create('planning_items', function (Blueprint $table) {
			$table->id();
			$table->string('cell_key'); // Row and column as a unique key
			$table->string('class_name');
			$table->string('subject');
			$table->text('pupils'); // Comma-separated list of pupils
			$table->longText('content'); // WYSIWYG content
			$table->timestamps();
		});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planning_items');
    }
};
