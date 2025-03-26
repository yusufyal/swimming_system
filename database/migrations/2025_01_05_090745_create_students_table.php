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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('date_of_birth');
            $table->string('civil_id')->unique();
            $table->string('registration_id')->unique();
            $table->string('nationality');
            $table->string('address');
            $table->string('status')->default('Active');
            $table->string('place_of_birth');
            $table->string('telephone_number');
            $table->string('recipt_number');
            $table->enum('gender', ['Male', 'Female']);
            $table->string('image');
            $table->integer('attendance')->nullable();
            $table->unsignedBigInteger('class_model_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
