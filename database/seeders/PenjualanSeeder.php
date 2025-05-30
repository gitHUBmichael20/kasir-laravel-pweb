<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penjualan;
use App\Models\Pelanggan;
use Faker\Factory as Faker;

class PenjualanSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $pelangganIDs = Pelanggan::pluck('PelangganID')->toArray();

        if (empty($pelangganIDs)) {
            $this->command->error('Tidak ada data pelanggan ditemukan. Harap jalankan PelangganSeeder terlebih dahulu.');
            return;
        }

        $numberOfSales = 30;

        for ($i = 1; $i <= $numberOfSales; $i++) {
            Penjualan::create([
                'PenjualanID' => 'SALE-SEED-' . str_pad($i, 3, '0', STR_PAD_LEFT), // Format: SALE-SEED-001
                'PelangganID' => $faker->randomElement($pelangganIDs),
                'TanggalPenjualan' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
                'TotalHarga' => 0, // Will be updated by DetailPenjualanSeeder
            ]);
        }

        $this->command->info("Berhasil membuat {$numberOfSales} record penjualan.");
    }
}
