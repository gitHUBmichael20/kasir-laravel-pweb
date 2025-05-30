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
        Schema::create('penjualan', function (Blueprint $table) {
            $table->string('PenjualanID')->primary();
            $table->date('TanggalPenjualan')->nullable();
            $table->decimal('TotalHarga', 10, 2)->nullable();
            $table->string('PelangganID')->nullable(); // Changed from unsignedBigInteger to string
            $table->foreign('PelangganID')->references('PelangganID')->on('pelanggan')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan');
    }
};
