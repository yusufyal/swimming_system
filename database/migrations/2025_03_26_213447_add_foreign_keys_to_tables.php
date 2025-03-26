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
        // Add foreign keys to class_models table
        Schema::table('class_models', function (Blueprint $table) {
            $table->foreign('level_id')->references('id')->on('levels')->onDelete('cascade');
            $table->foreign('instructor_id')->references('id')->on('instructors')->onDelete('cascade');
        });

        // Add foreign keys to students table
        Schema::table('students', function (Blueprint $table) {
            $table->foreign('class_model_id')->references('id')->on('class_models')->onDelete('cascade');
        });

        // Add foreign keys to attendences table
        Schema::table('attendences', function (Blueprint $table) {
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove foreign keys from attendences table
        Schema::table('attendences', function (Blueprint $table) {
            $table->dropForeign(['student_id']);
        });

        // Remove foreign keys from students table
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign(['class_model_id']);
        });

        // Remove foreign keys from class_models table
        Schema::table('class_models', function (Blueprint $table) {
            $table->dropForeign(['level_id']);
            $table->dropForeign(['instructor_id']);
        });
    }
};
