<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DetailpenjualanSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil data produk dan penjualan
        $produkData = DB::table('produk')->select('ProdukID', 'Harga')->get()->toArray();
        $penjualanIds = DB::table('penjualan')->pluck('PenjualanID')->toArray();

        // Pengecekan jika data kosong
        if (empty($produkData) || empty($penjualanIds)) {
            $this->command->info('No products or penjualan data found. Please run the respective seeders first.');
            return;
        }

        foreach ($penjualanIds as $penjualanId) {
            $totalHarga = 0;
            $jumlahItem = $faker->numberBetween(1, 3); // Setiap penjualan punya 1-3 item

            for ($i = 0; $i < $jumlahItem; $i++) {
                $produk = $faker->randomElement($produkData);
                $jumlahProduk = $faker->numberBetween(1, 5);
                $subtotal = $produk->Harga * $jumlahProduk;
                $totalHarga += $subtotal;

                DB::table('detailpenjualan')->insert([
                    'PenjualanID' => $penjualanId,
                    'ProdukID' => $produk->ProdukID,
                    'JumlahProduk' => $jumlahProduk,
                    'Subtotal' => $subtotal,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Update TotalHarga di tabel penjualan
            DB::table('penjualan')
                ->where('PenjualanID', $penjualanId)
                ->update(['TotalHarga' => $totalHarga]);
        }
    }
}
