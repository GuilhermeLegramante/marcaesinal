<?php

namespace App\Filament\Tables;

use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class RenewalTable
{
    public static function table(): array
    {
        return [
            ImageColumn::make('brand.filename')
                ->label('Marca'),
            TextColumn::make('number')
                ->label('N°')
                ->sortable(),
            TextColumn::make('year')
                ->label('Ano')
                ->sortable(),
            TextColumn::make('validity')
                ->label('Validade')
                ->date()
                ->sortable(),
            Columns::createdAt(),
            Columns::updatedAt(),
        ];
    }
}
