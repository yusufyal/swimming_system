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
            $table->string('qr_code')->nullable(); // For storing QR code
            $table->string('barcode')->nullable(); // For storing Barcode
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('qr_code'); // Drop the QR code column
            $table->dropColumn('barcode'); // Drop the Barcode column
        });
    }
};
