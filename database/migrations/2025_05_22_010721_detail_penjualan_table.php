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
        //
        Schema::create('detailpenjualan', function (Blueprint $table) {
            $table->id('DetailID');
            $table->unsignedBigInteger('PenjualanID')->nullable();
            $table->unsignedBigInteger('ProdukID')->nullable();
            $table->integer('JumlahProduk')->nullable();
            $table->decimal('Subtotal', 10, 2)->nullable();
            $table->foreign('PenjualanID')->references('PenjualanID')->on('penjualan')->onDelete('cascade');
            $table->foreign('ProdukID')->references('ProdukID')->on('produk')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('detailpenjualan');
    }
};
