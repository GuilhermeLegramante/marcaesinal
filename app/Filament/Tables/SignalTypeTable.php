<?php

namespace App\Filament\Tables;

use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class SignalTypeTable
{
    public static function table(): array
    {
        return [
            ImageColumn::make('path')
                ->label('Desenho'),
            TextColumn::make('name')
                ->label('Nome')
                ->sortable(),
            Columns::createdAt(),
            Columns::updatedAt(),
        ];
    }
}
