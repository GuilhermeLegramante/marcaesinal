<?php

namespace App\Filament\Forms;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Saade\FilamentAutograph\Forms\Components\SignaturePad;


class SignalTypeForm
{
    public static function form(): array
    {
        return [
            GeneralFields::name(),
            FileUpload::make('path')
                ->label('')
                ->columnSpanFull()
                ->previewable()
                ->openable()
                ->downloadable()
                ->moveFiles()
                ->imageEditor()
                ->imageEditorEmptyFillColor('#000000')
                ->imageEditorAspectRatios([
                    null,
                    '16:9',
                    '4:3',
                    '1:1',
                ]),
            Group::make([
                SignaturePad::make('draw')
                    ->label('Desenhe o Tipo de Sinal')
                    ->dotSize(4.0)
                    ->lineMaxWidth(4.0)
                    ->lineMinWidth(4.0)
                    // ->confirmable()
                    // ->downloadable()
                    ->backgroundColor('rgb(255,255,255)')
                    ->backgroundColorOnDark('rgb(255,255,255)')
                    ->penColor('#000')
                    ->penColorOnDark('#000')
            ])->extraAttributes(['style' => 'width: 200px; height: 200px; ']),

            GeneralFields::note(),
        ];
    }
}
