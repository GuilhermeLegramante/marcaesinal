<?php

namespace App\Filament\Resources\FarmerResource\Pages;

use App\Filament\Resources\FarmerResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFarmer extends CreateRecord
{
    protected static string $resource = FarmerResource::class;

    protected static ?string $navigationLabel = 'Cadastrar Produtor';

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return $data;
    }
}
