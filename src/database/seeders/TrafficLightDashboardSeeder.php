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
            [
                'nama' => 'Cawang',
                'lat' => '-6.2425',
                'lng' => '106.8686',
                'cctv' => 'https://www.youtube.com/embed/1EiC9bvVGnk?autoplay=1&mute=1&loop=1'
            ],
            [
                'nama' => 'Cakung',
                'lat' => '-6.1824',
                'lng' => '106.9422',
                'cctv' => 'https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1&mute=1&loop=1'
            ],
            [
                'nama' => 'Kosambi',
                'lat' => '-6.1704',
                'lng' => '106.7465',
                'cctv' => 'https://www.youtube.com/embed/1EiC9bvVGnk?autoplay=1&mute=1&loop=1'
            ],
            [
                'nama' => 'Surabaya',
                'lat' => '-7.2504',
                'lng' => '112.7688',
                'cctv' => 'https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1&mute=1&loop=1'
            ],
            [
                'nama' => 'Semarang',
                'lat' => '-6.9667',
                'lng' => '110.4167',
                'cctv' => 'https://www.youtube.com/embed/1EiC9bvVGnk?autoplay=1&mute=1&loop=1'
            ],
            [
                'nama' => 'Bali',
                'lat' => '-8.4095',
                'lng' => '115.1889',
                'cctv' => 'https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1&mute=1&loop=1'
            ],
            [
                'nama' => 'Bundaran HI',
                'lat' => '-6.1949',
                'lng' => '106.8230',
                'cctv' => 'https://www.youtube.com/embed/1EiC9bvVGnk?autoplay=1&mute=1&loop=1'
            ],
            [
                'nama' => 'Monas',
                'lat' => '-6.1754',
                'lng' => '106.8272',
                'cctv' => 'https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1&mute=1&loop=1'
            ]
        ];

        foreach ($locations as $loc) {
            TrafficLight::updateOrCreate(
                ['nama_persimpangan' => $loc['nama']],
                [
                    'latitude' => $loc['lat'],
                    'longitude' => $loc['lng'],
                    'cctv_url' => $loc['cctv'],
                    'status' => 'merah',
                    'durasi_merah' => 60,
                    'durasi_kuning' => 10,
                    'durasi_hijau' => 60,
                    'mode' => 'otomatis',
                    'last_changed_at' => now(),
                ]
            );
        }
    }
}
