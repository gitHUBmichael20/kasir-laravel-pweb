<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Produk;
use Illuminate\Support\Facades\Log;
use Faker\Factory as Faker;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $kategoriProduk = ['Laptop', 'Mouse', 'Keyboard', 'Monitor', 'Headset'];
        $merek = [
            'Laptop' => ['ASUS', 'Lenovo', 'Acer', 'Dell', 'HP'],
            'Mouse' => ['Logitech', 'Razer', 'Microsoft', 'SteelSeries', 'Corsair'],
            'Keyboard' => ['Logitech', 'Razer', 'Keychron', 'Corsair', 'HyperX'],
            'Monitor' => ['Samsung', 'LG', 'Dell', 'AOC', 'BenQ'],
            'Headset' => ['JBL', 'Sony', 'HyperX', 'SteelSeries', 'Sennheiser'],
        ];
        $model = ['Pro', 'Max', 'Air', 'Elite', 'Gamer', 'Ultra', 'X', 'Z'];

        for ($i = 1; $i <= 10; $i++) {
            $kategori = $faker->randomElement($kategoriProduk);
            $merekProduk = $faker->randomElement($merek[$kategori]);
            $modelProduk = $faker->randomElement($model) . ' ' . $faker->bothify('##');
            $namaProduk = $kategori . ' ' . $merekProduk . ' ' . $modelProduk;

            // Download image
            $namaFile = $this->downloadImage($kategori, $i);

            Produk::create([
                'ProdukID' => '[SEED]' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'NamaProduk' => $namaProduk,
                'Harga' => $faker->numberBetween(1000, 99999) * 1000,
                'Stok' => $faker->numberBetween(5, 100),
                'foto_produk' => $namaFile,
            ]);

            usleep(100000); // 0.1 second delay
        }

        $this->command->info('Berhasil membuat 10 record produk.');
    }

    private function downloadImage($kategori, $index)
    {
        $fileName = strtolower($kategori) . '_' . str_pad($index, 3, '0', STR_PAD_LEFT) . uniqid() . '.jpg';
        $categorySeeds = [
            'Laptop' => 100,
            'Mouse' => 200,
            'Keyboard' => 300,
            'Monitor' => 400,
            'Headset' => 500
        ];
        $baseSeed = $categorySeeds[$kategori] ?? 600;
        $seed = $baseSeed + $index;
        $imageUrl = "https://picsum.photos/400/400?random={$seed}";

        try {
            $response = Http::timeout(10)->get($imageUrl);

            if ($response->successful()) {
                $imageContent = $response->body();
                Storage::put('public/produk/' . $fileName, $imageContent);
                return $fileName;
            } else {
                return null;
            }
        } catch (\Exception $e) {
            Log::error("Failed to download image for {$kategori}-{$index}: " . $e->getMessage());
            return null;
        }
    }
}

