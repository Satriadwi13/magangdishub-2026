<?php

namespace App\Livewire;

use App\Models\TrafficLight;
use Livewire\Component;

class MultiDashboardMonitoring extends Component
{
    public function render()
    {
        return view('livewire.multi-dashboard-monitoring', [
            'trafficLights' => TrafficLight::all()
        ]);
    }
}
