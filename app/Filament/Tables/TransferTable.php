<?php

namespace App\Filament\Tables;

use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class TransferTable
{
    public static function table(): array
    {
        return [
            ImageColumn::make('brand.filename')
                ->label('Marca'),
            TextColumn::make('brand.number')
                ->label('N°')
                ->sortable(),
            TextColumn::make('brand.year')
                ->label('Ano')
                ->sortable(),
            TextColumn::make('from.name')
                ->label('De')
                ->sortable(),
            TextColumn::make('to.name')
                ->label('Para')
                ->sortable(),
            Columns::createdAt(),
            Columns::updatedAt(),
        ];
    }
}
