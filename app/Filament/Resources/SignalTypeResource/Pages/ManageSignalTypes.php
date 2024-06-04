<?php

namespace App\Filament\Resources\SignalTypeResource\Pages;

use App\Filament\Resources\SignalTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Support\Facades\Storage;

class ManageSignalTypes extends ManageRecords
{
    protected static string $resource = SignalTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->mutateFormDataUsing(function (array $data): array {
                $path = str()->random() . '.png';

                $image_parts = explode(";base64,", $data['draw']);

                $image_base64 = base64_decode($image_parts[1]);

                Storage::put('public/' . $path, $image_base64);

                $data['path'] = $path;

                return $data;
            }),
        ];
    }
}
