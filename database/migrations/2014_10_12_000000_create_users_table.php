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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Name
            $table->string('phone_number')->nullable(); // Phone Number
            $table->string('designation')->nullable(); // Designation
            $table->string('email')->unique(); // Email ID
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable(); // Gender
            $table->date('dob')->nullable(); // Date of Birth (DOB)
            $table->string('otp')->nullable();
            $table->timestamp('otp_expiry')->nullable();
            $table->rememberToken();
            $table->boolean('is_approve')->default(0); // Approval status (default 0)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
