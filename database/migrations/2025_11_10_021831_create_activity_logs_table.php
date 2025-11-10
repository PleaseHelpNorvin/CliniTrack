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
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();

            // Nullable for public forms
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); 

            // Store either user name or student name/email
            $table->string('user_name'); 

            // Roles: internal users or student/public form
            $table->enum('role', ['admin','nurse','staff','student_form']); 

            // Action: Login, Logout, Add Visit, Fill Form, etc.
            $table->string('action'); 

            // Optional description for details, e.g., "Submitted health form for Student #123"
            $table->text('description')->nullable(); 

            // Optional IP tracking
            $table->string('ip_address', 45)->nullable(); 

            $table->timestamps(); // created_at and updated_at
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
