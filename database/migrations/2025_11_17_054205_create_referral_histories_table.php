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
        Schema::create('referral_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('referral_id')->constrained()->onDelete('cascade');
            
            $table->string('perform_by');

            // VITAL SIGNS
            $table->string('bp')->nullable();           // Blood Pressure (e.g. 120/80)
            $table->decimal('temp', 4, 1)->nullable();  // Temperature (e.g. 37.5)
            $table->integer('pulse')->nullable();       // Pulse / Heart Rate (e.g. 88)
            $table->integer('resp_rate')->nullable();   // Respiratory Rate (e.g. 20)
            $table->integer('o2_sat')->nullable();      // Oxygen Saturation %

            // Hospital update info
            $table->string('treatment')->nullable();
            $table->string('medicine_given')->nullable();
            $table->text('nurse_notes')->nullable();
            $table->string('attachments')->nullable();

            // Type of update
            $table->enum('update_type', [
                'checkup',
                'medication',
                'laboratory',
                'follow_up',
                'final'
            ])->default('checkup');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referral_histories');
    }
};
