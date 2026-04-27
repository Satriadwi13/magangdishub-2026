<?php

namespace App\Filament\Resources\TrafficLightResource\Pages;

use App\Filament\Resources\TrafficLightResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTrafficLights extends ListRecords
{
    protected static string $resource = TrafficLightResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
