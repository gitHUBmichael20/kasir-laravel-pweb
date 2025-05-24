<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Memanggil seeder-seeder lain
        $this->call([
            PelangganSeeder::class,
            ProdukSeeder::class,
            PenjualanSeeder::class,
            DetailpenjualanSeeder::class,
        ]);
    }
}