<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Pelanggan;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class PelangganSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 5; $i++) {
            $namaPelanggan = $faker->name;
            $namaFile = Str::slug($namaPelanggan, '_') . '_' . uniqid() . '.jpg';

            // Download image from Pravatar
            $imageUrl = 'https://i.pravatar.cc/800?u=' . urlencode($namaPelanggan);

            try {
                $response = Http::withOptions([
                    'verify' => false,
                    'timeout' => 30
                ])->get($imageUrl);

                if ($response->successful()) {
                    $imageContent = $response->body();
                    Storage::put('public/pelanggan/' . $namaFile, $imageContent);
                } else {
                    $namaFile = null;
                }
            } catch (\Exception $e) {
                $namaFile = null;
            }

            Pelanggan::create([
                'NamaPelanggan' => $namaPelanggan,
                'Alamat' => $faker->address,
                'NomorTelepon' => $faker->phoneNumber,
                'foto_pelanggan' => $namaFile,
            ]);

            sleep(1); // Delay to avoid rate limiting
        }
    }
}
