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
    Schema::table('presences', function (Blueprint $table) {
      // Add new columns
      $table->foreignId('class_id')->nullable()->after('class_schedule_id')->constrained('classes');
      $table->foreignId('subject_id')->nullable()->after('class_id')->constrained('subjects');
      $table->foreignId('student_id')->nullable()->after('subject_id')->constrained('students');
      $table->foreignId('teacher_id')->nullable()->after('student_id')->constrained('teachers');
      $table->string('status')->nullable()->after('teacher_id');
      $table->text('notes')->nullable()->after('status');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('presences', function (Blueprint $table) {
      $table->dropForeign(['class_id']);
      $table->dropForeign(['subject_id']);
      $table->dropForeign(['student_id']);
      $table->dropForeign(['teacher_id']);
      $table->dropColumn(['class_id', 'subject_id', 'student_id', 'teacher_id', 'status', 'notes']);
    });
  }
};
