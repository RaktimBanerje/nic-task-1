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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id(); // Primary key for the table
            $table->string('name'); // Name of the teacher
            $table->string('phone_number')->unique(); // Unique phone number
            $table->string('designation'); // Designation (e.g., subject, role)
            $table->string('email')->unique(); // Unique email ID
            $table->date('dob'); // Date of birth
            $table->enum('gender', ['male', 'female', 'other']); // Gender (male, female, other)
            $table->timestamps(); // created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers'); // Drop the teachers table if it exists
    }
};
