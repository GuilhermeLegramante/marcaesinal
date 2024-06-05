<?php

namespace App\Filament\Forms;

use App\Forms\Components\CowHead;
use App\Forms\Components\SelectSignalType;
use App\Models\SignalType;
use Filament\Forms\Components\Select;

class SignalForm
{
    public static function form(): array
    {
        return [
            Select::make('signal_type_id')
                ->label('Tipo de Sinal')
                ->options(static::getOptions())
                ->columnSpanFull()
                ->required()
                ->searchable()
                ->allowHtml(),
            CowHead::make('cowHead')
                ->label(''),
            Select::make('position')
                ->label('Posição (Escolha de acordo com a imagem)')
                ->options([
                    'E1' => 'Orelha Esquerda (E1)',
                    'E2' => 'Orelha Esquerda (E2)',
                    'E3' => 'Orelha Esquerda (E3)',
                    'E4' => 'Orelha Esquerda (E4)',
                    'E5' => 'Orelha Esquerda (E5)',
                    'E6' => 'Orelha Esquerda (E6)',
                    'D1' => 'Orelha Direita (D1)',
                    'D2' => 'Orelha Direita (D2)',
                    'D3' => 'Orelha Direita (D3)',
                    'D4' => 'Orelha Direita (D4)',
                    'D5' => 'Orelha Direita (D5)',
                    'D6' => 'Orelha Direita (D6)',

                ]),
            GeneralFields::note(),
        ];
    }

    private static function getOptions()
    {
        $signalTypes = SignalType::select(
            'id',
            'name',
            'path',
        )->get();

        $options = [];

        foreach ($signalTypes as $signalType) {
            $span = '<img src=' . url('/storage/') . '/' . $signalType->path .  ' style="margin-right: 10px; height: 5rem; width: 5rem;">
                        <p style="margin-left: 1rem;">
                        <strong>  ' . $signalType->name . ' </strong> 
                        </p>';

            $options[$signalType->id] = $span;
        }

        return $options;
    }
}
