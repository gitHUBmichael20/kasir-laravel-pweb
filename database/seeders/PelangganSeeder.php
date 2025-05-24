<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class PelangganSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 5; $i++) {
            // Generate nama pelanggan terlebih dahulu
            $namaPelanggan = $faker->name;

            // Buat nama file dari nama pelanggan (slug format)
            $namaFile = Str::slug($namaPelanggan, '_') . '_' . uniqid() . '.jpg';

            // OPSI 1: Menggunakan This Person Does Not Exist (AI Generated People)
            $imageUrl = 'https://thispersondoesnotexist.com/';

            // OPSI 2: Menggunakan Random User API (lebih reliable)
            // $randomUserResponse = Http::get('https://randomuser.me/api/');
            // if ($randomUserResponse->successful()) {
            //     $userData = $randomUserResponse->json();
            //     $imageUrl = $userData['results'][0]['picture']['large'];
            // }

            // OPSI 3: Menggunakan Pravatar (Generate Avatar from name)
            // $imageUrl = 'https://i.pravatar.cc/200?u=' . urlencode($namaPelanggan);

            // OPSI 4: Menggunakan UI Avatars dengan inisial nama
            // $initials = $this->getInitials($namaPelanggan);
            // $imageUrl = 'https://ui-avatars.com/api/?name=' . urlencode($initials) . '&size=200&background=random';

            // Download gambar
            try {
                // Matikan verifikasi SSL agar tidak error di Windows
                $response = Http::withOptions([
                    'verify' => false,
                    'timeout' => 30
                ])->get($imageUrl);

                if ($response->successful()) {
                    $imageContent = $response->body();
                    Storage::put('public/pelanggan/' . $namaFile, $imageContent);
                } else {
                    $namaFile = null; // Jika gagal, kosongkan nama file
                }
            } catch (\Exception $e) {
                $namaFile = null; // Jika ada error, kosongkan nama file
            }

            DB::table('pelanggan')->insert([
                'NamaPelanggan' => $namaPelanggan,
                'Alamat' => $faker->address,
                'NomorTelepon' => $faker->phoneNumber,
                'foto_pelanggan' => $namaFile,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Delay untuk menghindari rate limiting
            sleep(1); // 1 detik delay
        }
    }

    /**
     * Get initials from full name
     */
    private function getInitials($name)
    {
        $words = explode(' ', $name);
        $initials = '';

        foreach ($words as $word) {
            if (!empty($word)) {
                $initials .= strtoupper($word[0]);
            }
        }

        return $initials;
    }
}

// ALTERNATIF SEEDER DENGAN MULTIPLE OPTIONS
class PelangganSeederAdvanced extends Seeder
{
    private $imageServices = [
        'thisperson' => 'https://thispersondoesnotexist.com/',
        'randomuser' => 'randomuser_api',
        'pravatar' => 'pravatar_service',
        'uiavatar' => 'ui_avatar_service'
    ];

    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 5; $i++) {
            $namaPelanggan = $faker->name;
            $namaFile = Str::slug($namaPelanggan, '_') . '_' . uniqid() . '.jpg';

            // Coba beberapa service secara bergantian
            $imageUrl = $this->getImageFromService($namaPelanggan, $i);

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
                Log::error('Error downloading image: ' . $e->getMessage());
                $namaFile = null;
            }

            DB::table('pelanggan')->insert([
                'NamaPelanggan' => $namaPelanggan,
                'Alamat' => $faker->address,
                'NomorTelepon' => $faker->phoneNumber,
                'foto_pelanggan' => $namaFile,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            sleep(1);
        }
    }

    private function getImageFromService($name, $index)
    {
        // Rotasi service berdasarkan index
        $serviceKeys = array_keys($this->imageServices);
        $currentService = $serviceKeys[$index % count($serviceKeys)];

        switch ($currentService) {
            case 'thisperson':
                return 'https://thispersondoesnotexist.com/';

            case 'randomuser':
                try {
                    $response = Http::get('https://randomuser.me/api/');
                    if ($response->successful()) {
                        $userData = $response->json();
                        return $userData['results'][0]['picture']['large'];
                    }
                } catch (\Exception $e) {
                    // Fallback to other service
                }
                return 'https://i.pravatar.cc/200?u=' . urlencode($name);

            case 'pravatar':
                return 'https://i.pravatar.cc/200?u=' . urlencode($name);

            case 'uiavatar':
                $initials = $this->getInitials($name);
                $colors = ['3498db', 'e74c3c', '2ecc71', 'f39c12', '9b59b6', '1abc9c'];
                $randomColor = $colors[array_rand($colors)];
                return 'https://ui-avatars.com/api/?name=' . urlencode($initials) . '&size=200&background=' . $randomColor . '&color=fff&bold=true';

            default:
                return 'https://i.pravatar.cc/200?u=' . urlencode($name);
        }
    }

    private function getInitials($name)
    {
        $words = explode(' ', $name);
        $initials = '';

        foreach ($words as $word) {
            if (!empty($word)) {
                $initials .= strtoupper($word[0]);
            }
        }

        return $initials;
    }
}
