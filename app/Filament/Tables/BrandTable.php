<?php

namespace App\Filament\Tables;

use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class BrandTable
{
    public static function table(): array
    {
        return [
            ImageColumn::make('filename')
                ->label('Marca'),
            TextColumn::make('number')
                ->label('N°')
                ->sortable(),
            TextColumn::make('year')
                ->label('Ano')
                ->sortable(),
            TextColumn::make('farmer.name')
                ->label('Produtor')
                ->searchable()
                ->sortable(),
            TextColumn::make('situation')
                ->label('Situação')
                ->searchable(),
            Columns::createdAt(),
            Columns::updatedAt(),
        ];
    }
}