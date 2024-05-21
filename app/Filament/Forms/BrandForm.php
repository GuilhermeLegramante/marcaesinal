<?php

namespace App\Filament\Forms;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class BrandForm
{
    public static function form(): array
    {
        return [
            Section::make('Dados da Marca')
                ->description(
                    fn (string $operation): string => $operation === 'create' || $operation === 'edit' ? 'Informe os campos solicitados' : ''
                )
                ->collapsible()
                ->schema([
                    Select::make('farmer_id')
                        ->label('Produtor')
                        ->live()
                        ->columnSpanFull()
                        ->preload()
                        ->searchable()
                        ->required()
                        ->relationship('farmer', 'name')
                        ->disabledOn('edit')
                        ->createOptionForm(FarmerForm::form()),
                    TextInput::make('number')
                        ->label('N°')
                        ->required()
                        ->numeric(),
                    TextInput::make('year')
                        ->label('Ano')
                        ->required()
                        ->numeric(),
                    FileUpload::make('filename')
                        ->label('Arquivo')
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
                    GeneralFields::note(),
                ])
                ->columns(2)
        ];
    }
}
