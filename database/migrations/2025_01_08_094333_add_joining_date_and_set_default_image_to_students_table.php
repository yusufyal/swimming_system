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
        Schema::table('students', function (Blueprint $table) {
          // Add the joining_date column
          $table->date('joining_date')->nullable();

          // Set a default value for the image column
          $table->string('image')->default('images/default.png')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
           // Remove the joining_date column
           $table->dropColumn('joining_date');

           // Revert the image column to its previous state
           $table->string('image')->default(null)->change();
        });
    }
};
