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
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('class_name');
            $table->foreignId('homeroom_teacher_id')->nullable()->constrained('teachers', 'id')->nullOnDelete();
            $table->integer('level'); // kelas 10, 11, 12
            $table->enum('major', ['IPA', 'IPS']);
            $table->string('academic_year', 9);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
