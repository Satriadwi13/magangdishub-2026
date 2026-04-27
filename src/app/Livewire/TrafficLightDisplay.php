<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TrafficLight;
use Carbon\Carbon;

class TrafficLightDisplay extends Component
{
    public $currentStatus;
    public $timeRemaining;
    public $mode;

    public function checkStatus()
    {
        $tl = TrafficLight::first();
        if (!$tl) return;

        $this->mode = $tl->mode;

        if ($this->mode === 'manual') {
            $this->currentStatus = $tl->status;
            $this->timeRemaining = 0;
            return;
        }

        // Mode Otomatis
        if (!$tl->last_changed_at) {
            $tl->last_changed_at = now();
            $tl->save();
        }

        $this->currentStatus = $tl->status;
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
            
            $this->currentStatus = $nextStatus;
            $this->timeRemaining = (int) $tl->{"durasi_" . $nextStatus};
        } else {
            $this->timeRemaining = $duration - $elapsed;
        }
    }

    public function render()
    {
        $tl = TrafficLight::first();
        
        // Initial setup for view
        if ($tl && $this->currentStatus === null) {
            $this->currentStatus = $tl->status;
            $this->mode = $tl->mode;
            if ($this->mode === 'otomatis') {
                $duration = (int) $tl->{"durasi_" . $tl->status};
                $elapsed = $tl->last_changed_at ? now()->diffInSeconds($tl->last_changed_at) : 0;
                $this->timeRemaining = max(0, $duration - $elapsed);
            } else {
                $this->timeRemaining = 0;
            }
        }

        return view('livewire.traffic-light-display', [
            'trafficLight' => $tl
        ]);
    }
}
