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
        Schema::table('attendences', function (Blueprint $table) {
            $table->timestamp('attendance_date')->nullable()->after('status');
            $table->string('attendance_time', 20)->nullable()->after('status');  // You can adjust the length of the string if needed
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendences', function (Blueprint $table) {
              // Drop the added columns
              $table->dropColumn('attendance_date');
              $table->dropColumn('attendance_time');
        });
    }
};
