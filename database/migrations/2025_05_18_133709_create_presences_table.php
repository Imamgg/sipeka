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
        Schema::create('presences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_schedule_id')->constrained('class_schedules')->onDelete('cascade');
            $table->foreignId('class_id')->nullable()->constrained('classes');
            $table->foreignId('subject_id')->nullable()->constrained('subjects');
            $table->foreignId('student_id')->nullable()->constrained('students');
            $table->foreignId('teacher_id')->nullable()->constrained('teachers');
            $table->string('status')->default('present'); // e.g., 'present', 'absent', 'permission', 'sick'
            $table->text('notes')->nullable();
            $table->date('date');
            $table->string('qr_code_token')->unique();
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presences');
    }
};
