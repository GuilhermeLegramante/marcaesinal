<?php

namespace App\Filament\Forms;

use Dotswan\MapPicker\Fields\Map;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Forms\Set;

class TransferForm
{
    public static function form(): array
    {
        return [
            Select::make('to_id')
                ->label('Produtor')
                ->relationship('to', 'name')
                ->searchable()
                ->preload()
                ->columnSpanFull()
                ->required(),
            Textarea::make('note')
                ->label('Observação')
                ->maxLength(65535)
                ->columnSpanFull(),
        ];
    }
}
