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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('nurse_id')->constrained('users')->onDelete('cascade');

            $table->dateTime('visited_at');

            $table->enum('reason', [
                'sick','injury','checkup','headache','fever','stomachache','menstrual','asthma','toothache','other'
            ])->default('other');

            $table->string('temperature')->nullable();
            $table->string('blood_pressure')->nullable();
            $table->string('pulse_rate')->nullable();

            $table->text('treatment_given')->nullable();
            $table->text('nurse_notes')->nullable();

            $table->enum('status', ['treated','referred','sent_home'])->default('treated');
            $table->string('referred_to')->nullable();

            $table->boolean('emergency')->default(false);

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
