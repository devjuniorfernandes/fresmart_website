<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Store;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeding standard Admin user
        User::updateOrCreate(
            ['email' => 'admin@fresmart.ao'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'),
            ]
        );

        // Seeding Store Locator standard stores
        $stores = [
            [
                'name' => 'Fresmart Talatona',
                'slug' => 'fresmart-talatona',
                'city' => 'Luanda',
                'bairro' => 'Talatona',
                'address' => 'Av. Talatona, Luanda, Angola',
                'lat' => -8.91750000,
                'lng' => 13.18660000,
                'opening_time' => '07:00:00',
                'closing_time' => '22:00:00',
                'phone' => '+244 923 000 001',
                'email' => 'talatona@fresmart.ao',
                'status' => 'Aberta',
            ],
            [
                'name' => 'Fresmart Belas',
                'slug' => 'fresmart-belas',
                'city' => 'Luanda',
                'bairro' => 'Belas',
                'address' => 'Rua Principal, Belas, Luanda',
                'lat' => -8.96220000,
                'lng' => 13.14920000,
                'opening_time' => '07:00:00',
                'closing_time' => '22:00:00',
                'phone' => '+244 923 000 002',
                'email' => 'belas@fresmart.ao',
                'status' => 'Aberta',
            ],
            [
                'name' => 'Fresmart Viana',
                'slug' => 'fresmart-viana',
                'city' => 'Luanda',
                'bairro' => 'Viana',
                'address' => 'Av. 4 de Fevereiro, Viana',
                'lat' => -8.90560000,
                'lng' => 13.36440000,
                'opening_time' => '07:00:00',
                'closing_time' => '21:00:00',
                'phone' => '+244 923 000 003',
                'email' => 'viana@fresmart.ao',
                'status' => 'Aberta',
            ],
            [
                'name' => 'Fresmart Kilamba',
                'slug' => 'fresmart-kilamba',
                'city' => 'Luanda',
                'bairro' => 'Kilamba',
                'address' => 'Rua do Comércio, Kilamba',
                'lat' => -8.99500000,
                'lng' => 13.25000000,
                'opening_time' => '07:00:00',
                'closing_time' => '22:00:00',
                'phone' => '+244 923 000 004',
                'email' => 'kilamba@fresmart.ao',
                'status' => 'Aberta',
            ],
            [
                'name' => 'Fresmart Benguela',
                'slug' => 'fresmart-benguela',
                'city' => 'Benguela',
                'bairro' => 'Centro',
                'address' => 'Avenida Eduardo dos Santos, Benguela',
                'lat' => -12.57830000,
                'lng' => 13.40720000,
                'opening_time' => '08:00:00',
                'closing_time' => '20:00:00',
                'phone' => '+244 923 000 005',
                'email' => 'benguela@fresmart.ao',
                'status' => 'Aberta',
            ],
        ];

        foreach ($stores as $storeData) {
            Store::updateOrCreate(
                ['slug' => $storeData['slug']],
                $storeData
            );
        }

        // Seeding standard Settings
        \App\Models\Setting::updateOrCreate(
            ['id' => 1],
            [
                'facebook' => 'https://facebook.com/fresmart',
                'instagram' => 'https://instagram.com/fresmart',
                'tiktok' => 'https://tiktok.com/@fresmart',
                'linkedin' => 'https://linkedin.com/company/fresmart',
                'youtube' => 'https://youtube.com/@fresmart',
                'app_store' => 'https://apps.apple.com',
                'google_play' => 'https://play.google.com',
            ]
        );
    }
}

