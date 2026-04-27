<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TrafficLight;

class TrafficLightDashboardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            'Cawang',
            'Cakung',
            'Kosambi',
            'Surabaya',
            'Semarang',
            'Bali'
        ];

        foreach ($locations as $location) {
            TrafficLight::firstOrCreate(
                ['nama_persimpangan' => $location],
                [
                    'status' => 'merah',
                    'durasi_merah' => 10,
                    'durasi_kuning' => 3,
                    'durasi_hijau' => 7,
                    'mode' => 'otomatis',
                    'last_changed_at' => now(),
                ]
            );
        }
    }
}
