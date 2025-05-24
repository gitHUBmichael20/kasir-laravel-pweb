<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PenjualanSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Pastikan ada pelanggan yang sudah dibuat sebelumnya
        $pelangganIds = DB::table('pelanggan')->pluck('PelangganID')->toArray();

        for ($i = 1; $i <= 5; $i++) {
            DB::table('penjualan')->insert([
                'TanggalPenjualan' => $faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d'),
                'TotalHarga' => 0, // Akan diupdate setelah detailpenjualan dibuat
                'PelangganID' => $faker->randomElement($pelangganIds),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}