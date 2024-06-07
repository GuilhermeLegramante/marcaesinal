<?php

namespace App\Filament\Resources\ComparisonResource\Pages;

use App\Filament\Resources\ComparisonResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class ListComparisons extends ListRecords
{
    protected static string $resource = ComparisonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('newComparison')->label('Nova Busca')->action('newComparison'),
        ];
    }

    public function newComparison()
    {
        return redirect()->route('filament.admin.pages.verificacao-de-similaridade');
    }
}
