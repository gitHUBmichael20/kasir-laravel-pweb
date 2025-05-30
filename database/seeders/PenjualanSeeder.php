<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penjualan;
use App\Models\Pelanggan; // Pastikan model Pelanggan sudah ada dan diimpor
use Faker\Factory as Faker;

class PenjualanSeeder extends Seeder
{
    /**
     * Jalankan database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Hapus data yang ada terlebih dahulu untuk memastikan seeding bersih
        Penjualan::truncate();

        // Ambil semua ID pelanggan yang sudah ada
        $pelangganIDs = Pelanggan::pluck('PelangganID')->toArray();

        // Lakukan pengecekan jika tidak ada pelanggan
        if (empty($pelangganIDs)) {
            $this->command->error('Tidak ada data pelanggan ditemukan. Harap jalankan PelangganSeeder terlebih dahulu.');
            return;
        }

        $numberOfSales = 30; // Tentukan jumlah data penjualan yang ingin dibuat (misal: 30)

        // Loop untuk membuat data penjualan
        for ($i = 1; $i <= $numberOfSales; $i++) {
            // Hasilkan PenjualanID yang unik menggunakan counter
            // Ini lebih handal untuk seeding daripada mengandalkan logika boot() yang mencari record terakhir
            $penjualanID = 'SALE-' . str_pad($i, 3, '0', STR_PAD_LEFT); // Contoh: SALE-001, SALE-002, dst.

            Penjualan::create([
                'PenjualanID' => $penjualanID, // Set PenjualanID secara eksplisit
                'PelangganID' => $faker->randomElement($pelangganIDs), // Pilih pelanggan secara acak
                'TanggalPenjualan' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
                'TotalHarga' => 0, // TotalHarga akan diperbarui oleh DetailpenjualanSeeder
            ]);
        }

        $this->command->info("Berhasil membuat {$numberOfSales} record penjualan.");
    }
}
