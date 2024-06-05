<?php

namespace App\Filament\Tables;

use App\Models\Brand;
use Filament\Forms\Get;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;

class BrandTable
{
    public static function table(): array
    {
        return [
            Stack::make([
                ImageColumn::make('filename')
                    ->size(120)
                    ->label('Marca')
                    ->alignCenter(),
                TextColumn::make('number')
                    ->label('N°')
                    ->weight(FontWeight::Bold)
                    ->size(TextColumn\TextColumnSize::Large)
                    ->sortable()
                    ->alignCenter()
                    ->formatStateUsing(fn (string $state, Brand $brand): string => $state . ' / ' . $brand->year),
                TextColumn::make('farmer.name')
                    ->label('Produtor')
                    ->weight(FontWeight::Bold)
                    ->searchable()
                    ->alignCenter()
                    ->sortable(),
                TextColumn::make('situation')
                    ->label('Situação')
                    ->badge()
                    ->alignCenter()
                    ->color(fn (string $state): string => match ($state) {
                        'ATIVA' => 'success',
                        'INATIVA' => 'danger',
                    })
                    ->searchable(),
                // Columns::createdAt(),
                // Columns::updatedAt(),
            ]),

        ];
    }
}
