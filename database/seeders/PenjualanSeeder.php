<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penjualan;
use App\Models\Pelanggan;
use Faker\Factory as Faker;

class PenjualanSeeder extends Seeder
{
    /**
     * Jalankan database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');


        Penjualan::truncate();


        $pelangganIDs = Pelanggan::pluck('PelangganID')->toArray();


        if (empty($pelangganIDs)) {
            $this->command->error('Tidak ada data pelanggan ditemukan. Harap jalankan PelangganSeeder terlebih dahulu.');
            return;
        }

        $numberOfSales = 30;


        for ($i = 1; $i <= $numberOfSales; $i++) {


            $penjualanID = 'SALE-SEED' . substr(uniqid(), 0, 3) . '-' . str_pad($i, 3, '0', STR_PAD_LEFT);

            Penjualan::create([
                'PenjualanID' => $penjualanID,
                'PelangganID' => $faker->randomElement($pelangganIDs),
                'TanggalPenjualan' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
                'TotalHarga' => 0,
            ]);
        }

        $this->command->info("Berhasil membuat {$numberOfSales} record penjualan.");
    }
}
