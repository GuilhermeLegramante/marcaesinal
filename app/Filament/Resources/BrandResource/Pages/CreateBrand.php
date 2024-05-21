<?php

namespace App\Filament\Resources\BrandResource\Pages;

use App\Filament\Resources\BrandResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBrand extends CreateRecord
{
    protected static string $resource = BrandResource::class;

    protected static ?string $navigationLabel = 'Cadastrar Marca';

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['original_number'] = $data['number'];
        $data['original_year'] = $data['year'];
        $data['situation'] = 'ATIVA';
        

        return $data;
    }

}
