<?php

namespace App\Filament\Resources\TrafficLightResource\Pages;

use App\Filament\Resources\TrafficLightResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTrafficLight extends EditRecord
{
    protected static string $resource = TrafficLightResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
