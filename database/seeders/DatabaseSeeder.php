<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Disable foreign key checks to allow truncation
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate tables in the correct order (dependent tables first)
        DB::table('detailpenjualan')->truncate();
        DB::table('penjualan')->truncate();
        DB::table('produk')->truncate();
        DB::table('pelanggan')->truncate();

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Run seeders in the correct order
        $this->call([
            PelangganSeeder::class,
            ProdukSeeder::class,
            PenjualanSeeder::class,
            DetailPenjualanSeeder::class,
        ]);
    }
}
