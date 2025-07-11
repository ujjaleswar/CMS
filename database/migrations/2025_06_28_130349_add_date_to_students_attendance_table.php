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
        Schema::table('students_attendance', function (Blueprint $table) {
               $table->date('date')->after('class_id'); // Add after class_id, adjust as needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students_attendance', function (Blueprint $table) {
             $table->dropColumn('date');
        });
    }
};
