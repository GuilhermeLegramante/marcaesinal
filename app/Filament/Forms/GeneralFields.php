<?php

namespace App\Filament\Forms;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class GeneralFields
{
    public static function note(): Textarea
    {
        return  Textarea::make('note')
            ->label('Observação')
            ->maxLength(65535)
            ->columnSpanFull();
    }

    public static function name(): TextInput
    {
        return TextInput::make('name')
            ->label('Nome')
            ->required()
            ->columnSpanFull()
            ->maxLength(255);
    }

   
}
