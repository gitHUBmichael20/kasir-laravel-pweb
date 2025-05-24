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
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->id('PelangganID');
            $table->string('NamaPelanggan', 255);
            $table->text('Alamat')->nullable();
            $table->string('NomorTelepon', 25);
            $table->string('foto_pelanggan', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('pelanggan');
    }
};
