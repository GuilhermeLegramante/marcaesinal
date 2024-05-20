<?php

namespace App\Filament\Forms;

use Dotswan\MapPicker\Fields\Map;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Forms\Set;

class LocaleForm
{
    public static function form(): array
    {
        return [
            GeneralFields::name(),
            TextInput::make('latitude')
                ->numeric(),
            TextInput::make('longitude')
                ->numeric(),
            Map::make('location')
                ->label('Location')
                ->columnSpanFull()
                ->afterStateUpdated(function (Get $get, Set $set, string|array|null $old, ?array $state): void {
                    $set('latitude', $state['lat']);
                    $set('longitude', $state['lng']);
                })
                ->afterStateHydrated(function ($state, $record, Set $set): void {
                    if(isset($record->latitude) && isset($record->longitude)) {
                        $set('location', ['lat' => $record->latitude, 'lng' => $record->longitude]);
                    }
                })
                ->extraStyles([
                    'min-height: 30vh',
                    'border-radius: 50px'
                ])
                ->liveLocation()
                ->showMarker()
                ->markerColor("#22c55eff")
                ->showFullscreenControl()
                ->showZoomControl()
                ->draggable()
                ->tilesUrl("https://tile.openstreetmap.de/{z}/{x}/{y}.png")
                ->zoom(15)
                ->detectRetina()
                ->extraTileControl([])
                ->extraControl([
                    'zoomDelta'           => 1,
                    'zoomSnap'            => 2,
                ]),
            GeneralFields::note(),
        ];
    }
}
