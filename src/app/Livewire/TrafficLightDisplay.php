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
            $elapsed = now()->diffInSeconds($tl->last_changed_at);

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
        $trafficLights = TrafficLight::all()->map(function ($tl) {
            if ($tl->mode === 'otomatis') {
                $duration = (int) $tl->{"durasi_" . $tl->status};
                $elapsed = $tl->last_changed_at ? now()->diffInSeconds($tl->last_changed_at) : 0;
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
