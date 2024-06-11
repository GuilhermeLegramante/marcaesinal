<?php

namespace App\Filament\Resources\BrandGeneralResource\Pages;

use App\Filament\Resources\BrandGeneralResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageBrandGenerals extends ManageRecords
{
    protected static string $resource = BrandGeneralResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
