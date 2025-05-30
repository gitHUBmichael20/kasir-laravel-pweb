<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Detailpenjualan;
use App\Models\Penjualan;
use App\Models\Produk; // Pastikan model Produk sudah diimpor
use Faker\Factory as Faker;

class DetailpenjualanSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Hapus data detail penjualan yang ada terlebih dahulu
        Detailpenjualan::truncate();

        // Ambil data produk dan penjualan menggunakan Eloquent
        // Menggunakan Eloquent model (Produk::select...) lebih konsisten dengan pola Laravel
        $produkData = Produk::select('ProdukID', 'Harga')->get();
        $penjualanRecords = Penjualan::all(); // Ambil semua record Penjualan yang sudah dibuat

        // Pengecekan jika data produk atau penjualan kosong
        if ($produkData->isEmpty()) {
            $this->command->error('Tidak ada data produk ditemukan. Harap jalankan ProdukSeeder terlebih dahulu.');
            return;
        }

        if ($penjualanRecords->isEmpty()) {
            $this->command->error('Tidak ada data penjualan ditemukan. Harap jalankan PenjualanSeeder terlebih dahulu.');
            return;
        }

        $this->command->info('Membuat detail penjualan untuk ' . $penjualanRecords->count() . ' record penjualan...');

        $detailCounter = 0; // Inisialisasi counter untuk DetailID

        // Loop melalui setiap record penjualan yang sudah ada
        foreach ($penjualanRecords as $penjualan) {
            $totalHarga = 0;
            $jumlahItem = $faker->numberBetween(1, 3); // Setiap penjualan akan memiliki 1-3 item detail

            // Loop untuk membuat item detail untuk penjualan saat ini
            for ($i = 0; $i < $jumlahItem; $i++) {
                $produk = $faker->randomElement($produkData); // Pilih produk secara acak
                $jumlahProduk = $faker->numberBetween(1, 5); // Jumlah produk untuk item ini
                $subtotal = $produk->Harga * $jumlahProduk; // Hitung subtotal
                $totalHarga += $subtotal; // Tambahkan ke total harga penjualan

                $detailCounter++; // Tingkatkan counter untuk setiap record detail
                // Hasilkan DetailID yang unik secara eksplisit
                $detailID = 'SALE-INFO-' . $detailCounter;

                // Buat record Detailpenjualan
                Detailpenjualan::create([
                    'DetailID' => $detailID, // Set DetailID secara eksplisit
                    'PenjualanID' => $penjualan->PenjualanID,
                    'ProdukID' => $produk->ProdukID,
                    'JumlahProduk' => $jumlahProduk,
                    'Subtotal' => $subtotal,
                ]);
            }

            // Perbarui TotalHarga di record penjualan setelah semua detailnya dibuat
            $penjualan->update(['TotalHarga' => $totalHarga]);
        }

        $totalDetailRecords = Detailpenjualan::count();
        $this->command->info("Berhasil membuat {$totalDetailRecords} record detail penjualan.");
    }
}
