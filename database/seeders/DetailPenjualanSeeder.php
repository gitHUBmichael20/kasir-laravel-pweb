<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Detailpenjualan;
use App\Models\Penjualan;
use App\Models\Produk;
use Faker\Factory as Faker;

class DetailPenjualanSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $produkData = Produk::select('ProdukID', 'Harga')->get();
        $penjualanRecords = Penjualan::all();

        if ($produkData->isEmpty()) {
            $this->command->error('Tidak ada data produk ditemukan. Harap jalankan ProdukSeeder terlebih dahulu.');
            return;
        }

        if ($penjualanRecords->isEmpty()) {
            $this->command->error('Tidak ada data penjualan ditemukan. Harap jalankan PenjualanSeeder terlebih dahulu.');
            return;
        }

        $this->command->info('Membuat detail penjualan untuk ' . $penjualanRecords->count() . ' record penjualan...');

        foreach ($penjualanRecords as $penjualan) {
            $totalHarga = 0;
            $jumlahItem = $faker->numberBetween(1, 3);

            for ($i = 0; $i < $jumlahItem; $i++) {
                $produk = $faker->randomElement($produkData);
                $jumlahProduk = $faker->numberBetween(1, 5);
                $subtotal = $produk->Harga * $jumlahProduk;
                $totalHarga += $subtotal;

                Detailpenjualan::create([
                    'PenjualanID' => $penjualan->PenjualanID,
                    'ProdukID' => $produk->ProdukID,
                    'JumlahProduk' => $jumlahProduk,
                    'Subtotal' => $subtotal,
                ]);
            }

            $penjualan->update(['TotalHarga' => $totalHarga]);
        }

        $totalDetailRecords = Detailpenjualan::count();
        $this->command->info("Berhasil membuat {$totalDetailRecords} record detail penjualan.");
    }
}
