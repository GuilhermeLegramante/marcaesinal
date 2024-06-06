<?php

namespace App\Filament\Tables;

use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class SignalTable
{
    public static function table(): array
    {
        return [
            TextColumn::make('farmer.name')
                ->label('Produtor')
                ->sortable(),
            ImageColumn::make('signalType.path')
                ->label('Desenho'),
            TextColumn::make('signalType.name')
                ->label('Tipo de Sinal')
                ->sortable(),
            TextColumn::make('position')
                ->label('Posição')
                ->sortable(),
            Columns::createdAt(),
            Columns::updatedAt(),
        ];
    }
}
