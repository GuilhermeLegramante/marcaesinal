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

class RenewalForm
{
    public static function form(): array
    {
        return [
            TextInput::make('number')
                ->label('N°')
                ->required()
                ->numeric(),
            TextInput::make('year')
                ->label('Ano')
                ->required()
                ->minLength(4)
                ->maxValue(date('Y'))
                ->numeric(),
            DatePicker::make('validity')
                ->label('Validade'),
            GeneralFields::note(),
        ];
    }
}
