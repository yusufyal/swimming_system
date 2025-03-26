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
        Schema::create('attendences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->date('date')->nullable(false);
            $table->char('day')->nullable(false);
            $table->time('clock_in')->nullable();
            $table->text('checkin_reason')->nullable();
            $table->time('clock_out')->nullable();
            $table->text('checkout_reason')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('attendences', function (Blueprint $table) {
        //     if (Schema::hasColumn('attendences', 'student_id')) {
        //         $table->dropForeign('attendences_student_id_foreign');
        //         $table->dropColumn('student_id');
        //     }
        // });

        Schema::dropIfExists('attendences');
    }
};
