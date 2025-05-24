<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Daftar kategori produk
        $kategoriProduk = ['Laptop', 'Mouse', 'Keyboard', 'Monitor', 'Headset'];

        // Daftar merek teknologi realistis
        $merek = [
            'Laptop' => ['ASUS', 'Lenovo', 'Acer', 'Dell', 'HP', 'Apple', 'Toshiba', 'MSI', 'Microsoft', 'Google', 'Razer', 'LG', 'Samsung'],
            'Mouse' => ['Logitech', 'Razer', 'Microsoft', 'SteelSeries', 'Corsair', 'HyperX', 'ASUS ROG', 'Glorious', 'Redragon', 'UtechSmart'],
            'Keyboard' => ['Logitech', 'Razer', 'Keychron', 'Anne Pro', 'Ducky', 'WASD Keyboards', 'Corsair', 'HyperX', 'SteelSeries', 'ASUS ROG'],
            'Monitor' => ['Samsung', 'LG', 'Dell', 'AOC', 'BenQ', 'ASUS', 'Acer', 'ViewSonic', 'MSI', 'Gigabyte'],
            'Headset' => ['JBL', 'Sony', 'HyperX', 'SteelSeries', 'Sennheiser', 'Audio-Technica', 'Bose', 'Plantronics', 'Turtle Beach', 'Razer'],
        ];

        // Daftar kata untuk model produk
        $model = ['Pro', 'Max', 'Air', 'Elite', 'Gamer', 'Ultra', 'Neo', 'X', 'Z', 'Vivo', 'Zen', 'Pulse', 'Core'];

        for ($i = 1; $i <= 10; $i++) {
            // Pilih kategori acak
            $kategori = $faker->randomElement($kategoriProduk);

            // Pilih merek acak berdasarkan kategori
            $merekProduk = $faker->randomElement($merek[$kategori]);

            // Buat nama model produk
            $modelProduk = $faker->randomElement($model) . ' ' . $faker->bothify('##?');

            // Gabungkan untuk nama produk
            $namaProduk = $kategori . ' ' . $merekProduk . ' ' . $modelProduk;

            // Generate image filename and download from Lorem Picsum
            $namaFile = $this->downloadImage($kategori, $i);

            DB::table('produk')->insert([
                'NamaProduk' => $namaProduk,
                'Harga' => $faker->randomFloat(2, 100000, 20000000),
                'Stok' => $faker->numberBetween(5, 100),
                'foto_produk' => $namaFile,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Download image from Lorem Picsum and save to storage
     */
    private function downloadImage($kategori, $index)
    {
        $categoryMap = [
            'Laptop' => 'laptop',
            'Mouse' => 'mouse',
            'Keyboard' => 'keyboard',
            'Monitor' => 'monitor',
            'Headset' => 'headset'
        ];

        $categorySlug = $categoryMap[$kategori] ?? 'product';
        $fileName = $categorySlug . '_' . str_pad($index, 3, '0', STR_PAD_LEFT) . '.jpg';

        // Get image from Lorem Picsum with different seed for each category
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
                Log::warning("Failed to download image from Lorem Picsum: " . $response->status());
                return null;
            }
        } catch (\Exception $e) {
            Log::error('Error downloading image from Lorem Picsum: ' . $e->getMessage());
            return null;
        }
    }
}
