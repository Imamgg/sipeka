<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('materials', function (Blueprint $table) {
            // Drop the enum constraint first, then recreate with new values
            DB::statement("ALTER TABLE materials MODIFY COLUMN type ENUM('lesson', 'assignment', 'quiz', 'reference')");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('materials', function (Blueprint $table) {
            DB::statement("ALTER TABLE materials MODIFY COLUMN type ENUM('material', 'assignment')");
        });
    }
};
