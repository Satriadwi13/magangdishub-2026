<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TrafficLight;
use Carbon\Carbon;

class TrafficLightDisplay extends Component
{
    public $selectedNode = null;

    public function selectNode($id)
    {
        $this->selectedNode = $id;
    }

    public function closeNode()
    {
        $this->selectedNode = null;
    }

    public function checkStatus()
    {
        $trafficLights = TrafficLight::all();

        foreach ($trafficLights as $tl) {
            if ($tl->mode === 'manual') {
                continue;
            }

            // Mode Otomatis
            if (!$tl->last_changed_at) {
                $tl->last_changed_at = now();
                $tl->save();
                continue;
            }

            $duration = (int) $tl->{"durasi_" . $tl->status};
            // Gunakan intval untuk membuang koma/desimal dari diffInSeconds
            $elapsed = (int) now()->diffInSeconds($tl->last_changed_at, true);

            if ($elapsed >= $duration) {
                $nextStatus = 'merah';
                if ($tl->status === 'merah') {
                    $nextStatus = 'hijau';
                } elseif ($tl->status === 'hijau') {
                    $nextStatus = 'kuning';
                }

                $tl->status = $nextStatus;
                $tl->last_changed_at = now();
                $tl->save();
            }
        }
    }

    public function render()
    {
        if (TrafficLight::count() === 0) {
            $seeder = new \Database\Seeders\TrafficLightDashboardSeeder();
            $seeder->run();
        }

        // Call checkStatus to guarantee the cycle advances on every poll/render
        $this->checkStatus();

        // Force clear view cache to fix any WSL/Windows filemtime caching issues
        $files = glob(storage_path('framework/views/*.php'));
        foreach($files as $file) {
            if(is_file($file)) {
                @unlink($file);
            }
        }

        // Force update existing records to 60s for merah/hijau, 10s for kuning to ensure the user sees the changes
        TrafficLight::where('durasi_merah', '!=', 60)
            ->orWhere('durasi_kuning', '!=', 10)
            ->orWhere('durasi_hijau', '!=', 60)
            ->update([
                'durasi_merah' => 60,
                'durasi_kuning' => 10,
                'durasi_hijau' => 60,
            ]);

        // Scramble the statuses if they are ALL red (which happens on fresh seed)
        $allRed = TrafficLight::where('status', 'merah')->count() === TrafficLight::count();
        if ($allRed && TrafficLight::count() > 0) {
            $statuses = ['merah', 'kuning', 'hijau'];
            TrafficLight::all()->each(function($tl) use ($statuses) {
                $tl->update([
                    'status' => $statuses[array_rand($statuses)],
                    'last_changed_at' => now()->subSeconds(rand(0, 9)),
                ]);
            });
        }

        $trafficLights = TrafficLight::all()->map(function ($tl) {
            if ($tl->mode === 'otomatis') {
                $duration = (int) $tl->{"durasi_" . $tl->status};
                $elapsed = $tl->last_changed_at ? (int) now()->diffInSeconds($tl->last_changed_at, true) : 0;
                $tl->timeRemaining = max(0, $duration - $elapsed);
            } else {
                $tl->timeRemaining = 0;
            }
            return $tl;
        });

        return view('livewire.traffic-light-display', [
            'trafficLights' => $trafficLights
        ]);
    }
}
