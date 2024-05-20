<?php

namespace App\Filament\Resources\LocaleResource\Pages;

use App\Filament\Resources\LocaleResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageLocales extends ManageRecords
{
    protected static string $resource = LocaleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
