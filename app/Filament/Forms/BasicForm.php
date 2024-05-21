<?php

namespace App\Filament\Forms;


class BasicForm
{
    public static function form(): array
    {
        return [
            GeneralFields::name(),
            GeneralFields::note(),
        ];
    }
}
