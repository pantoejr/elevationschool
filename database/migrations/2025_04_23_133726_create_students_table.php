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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('photo')->nullable();
            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['Male', 'Female', 'Unknown'])->nullable();
            $table->enum('marital_status',['Single','Married','Engaged','Divorced'])->nullable();
            $table->string('place_of_birth_town')->nullable();
            $table->string('place_of_birth_city')->nullable();
            $table->string('place_of_birth_country')->nullable();
            $table->string('nationality')->nullable();
            $table->string('official_language')->nullable();
            $table->string('permanent_address_town')->nullable();
            $table->string('permanent_address_city')->nullable();
            $table->string('permanent_address_country')->nullable();
            $table->string('mobile_phone')->nullable();
            $table->string('email')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_number')->nullable();
            $table->enum('computer_literacy', ['Beginner', 'Intermediate', 'Advanced', 'Professional'])->nullable();
            $table->string('education_status')->nullable(); // e.g. High School Diploma, College/University, etc.
            $table->string('course_applying_for')->nullable();
            $table->boolean('is_new')->default(true);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
