<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrafficLightResource\Pages;
use App\Models\TrafficLight;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TrafficLightResource extends Resource
{
    protected static ?string $model = TrafficLight::class;

    protected static ?string $navigationIcon = 'heroicon-o-stop';
    protected static ?string $navigationLabel = 'Persimpangan (Lampu)';
    protected static ?string $modelLabel = 'Lampu Lalu Lintas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_persimpangan')
                    ->label('Nama Persimpangan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('status')
                    ->label('Status Menengah (Initial)')
                    ->options([
                        'merah' => 'Merah',
                        'kuning' => 'Kuning',
                        'hijau' => 'Hijau',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('durasi_merah')
                    ->label('Durasi Merah (detik)')
                    ->numeric()
                    ->required()
                    ->default(10)
                    ->minValue(1),
                Forms\Components\TextInput::make('durasi_kuning')
                    ->label('Durasi Kuning (detik)')
                    ->numeric()
                    ->required()
                    ->default(3)
                    ->minValue(1),
                Forms\Components\TextInput::make('durasi_hijau')
                    ->label('Durasi Hijau (detik)')
                    ->numeric()
                    ->required()
                    ->default(10)
                    ->minValue(1),
                Forms\Components\Select::make('mode')
                    ->label('Mode')
                    ->options([
                        'otomatis' => 'Otomatis',
                        'manual' => 'Manual',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_persimpangan')
                    ->label('Nama Persimpangan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'merah' => 'danger',
                        'kuning' => 'warning',
                        'hijau' => 'success',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('mode')
                    ->label('Mode')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'otomatis' => 'info',
                        'manual' => 'secondary',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTrafficLights::route('/'),
            'create' => Pages\CreateTrafficLight::route('/create'),
            'edit' => Pages\EditTrafficLight::route('/{record}/edit'),
        ];
    }
}
