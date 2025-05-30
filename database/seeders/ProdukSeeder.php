<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Produk;
use Illuminate\Support\Facades\log;
use Faker\Factory as Faker;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Clear existing products first to avoid conflicts
        Produk::truncate();

        // Daftar kategori produk
        $kategoriProduk = ['Laptop', 'Mouse', 'Keyboard', 'Monitor', 'Headset'];

        // Daftar merek teknologi
        $merek = [
            'Laptop' => ['ASUS', 'Lenovo', 'Acer', 'Dell', 'HP'],
            'Mouse' => ['Logitech', 'Razer', 'Microsoft', 'SteelSeries', 'Corsair'],
            'Keyboard' => ['Logitech', 'Razer', 'Keychron', 'Corsair', 'HyperX'],
            'Monitor' => ['Samsung', 'LG', 'Dell', 'AOC', 'BenQ'],
            'Headset' => ['JBL', 'Sony', 'HyperX', 'SteelSeries', 'Sennheiser'],
        ];

        // Daftar model produk
        $model = ['Pro', 'Max', 'Air', 'Elite', 'Gamer', 'Ultra', 'X', 'Z'];

        for ($i = 1; $i <= 10; $i++) {
            // Pilih kategori acak
            $kategori = $faker->randomElement($kategoriProduk);

            // Pilih merek berdasarkan kategori
            $merekProduk = $faker->randomElement($merek[$kategori]);

            // Buat model produk
            $modelProduk = $faker->randomElement($model) . ' ' . $faker->bothify('##');

            // Gabungkan nama produk
            $namaProduk = $kategori . ' ' . $merekProduk . ' ' . $modelProduk;

            // Download image
            $namaFile = $this->downloadImage($kategori, $i);

            // Create product data array
            $productData = [
                'NamaProduk' => $namaProduk,
                'Harga' => $faker->numberBetween(1000, 99999) * 1000,
                'Stok' => $faker->numberBetween(5, 100),
                'foto_produk' => $namaFile,
            ];

            // If ProdukID is auto-generated, don't set it
            // If you need to set it manually, ensure it's unique:
            // $productData['ProdukID'] = 'PROID-' . str_pad($i, 3, '0', STR_PAD_LEFT);

            Produk::create($productData);

            // Add a small delay to avoid potential timing issues
            usleep(100000); // 0.1 second delay
        }
    }

    /**
     * Download image from Lorem Picsum
     */
    private function downloadImage($kategori, $index)
    {
        $fileName = strtolower($kategori) . '_' . str_pad($index, 3, '0', STR_PAD_LEFT) . uniqid() . '.jpg';

        // Different seed for each category
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
