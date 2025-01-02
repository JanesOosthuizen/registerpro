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
        Schema::create('cell_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            // row + column (e.g., row=0 => Monday, column=1 => Header 1)
            $table->integer('row');
            $table->integer('column');

            $table->foreignId('class_id')
                  ->constrained('classes')   // or whatever your classes table is named
                  ->cascadeOnDelete();

            $table->foreignId('subject_id')
                  ->constrained('subjects')  // or whatever your subjects table is named
                  ->cascadeOnDelete();

            $table->timestamps();

            // Optional: unique constraint if you want one "cell" per user
            // $table->unique(['user_id', 'row', 'column']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cell_assignments');
    }
};
