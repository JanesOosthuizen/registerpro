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
        Schema::create('pupils', function (Blueprint $table) {
            $table->id();
            $table->string('name');       // Pupil name (required)
            $table->foreignId('class_id')
				  ->nullable() // Link to existing class
                  ->constrained('classes') // The name of your classes table
                  ->nullOnDelete();    // or setNullOnDelete() if you want
            $table->timestamps();
		});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pupils');
    }
};
