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
            $table->string('first_name');
            $table->string('last_name');
            $table->string('student_number')->unique();
            $table->unsignedTinyInteger('grade_level');
            $table->string('grade_level_other')->nullable();
            $table->string('section')->nullable();
            $table->date('dob')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('email')->nullable();

            $table->string('address')->nullable();
            $table->string('photo')->nullable(); // store image path
            $table->text('allergies')->nullable();
            $table->text('medical_notes')->nullable();
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
