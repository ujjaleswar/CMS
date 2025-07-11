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
        Schema::create('students_attendance', function (Blueprint $table) {
        $table->id();
        $table->Integer('class_id')->nullable();
        $table->Integer('teacher_id')->nullable();
        $table->Integer('subject_id')->nullable();
        $table->json('attendance')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students_attendance');
    }
};
