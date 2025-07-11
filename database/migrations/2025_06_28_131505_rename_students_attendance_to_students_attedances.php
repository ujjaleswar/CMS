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
        Schema::table('students_attedances', function (Blueprint $table) {
            Schema::rename('students_attendance', 'students_attedances');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students_attedances', function (Blueprint $table) {
             Schema::rename('students_attedances', 'students_attendance');
        });
    }
};
