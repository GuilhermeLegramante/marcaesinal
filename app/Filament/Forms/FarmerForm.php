<?php

namespace App\Filament\Forms;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Leandrocfe\FilamentPtbrFormFields\Document;
use Leandrocfe\FilamentPtbrFormFields\PhoneNumber;

class FarmerForm
{
    public static function form(): array
    {
        return [
            Section::make('Dados do Produtor')
                ->description(
                    fn (string $operation): string => $operation === 'create' || $operation === 'edit' ? 'Informe os campos solicitados' : ''
                )
                ->collapsible()
                ->schema([
                    Document::make('cpf_cnpj')
                        ->label('CPF ou CNPJ')
                        ->dynamic(),
                    GeneralFields::name(),
                    GeneralFields::email(),
                    PhoneNumber::make('phone')
                        ->label('Telefone'),
                    PhoneNumber::make('whatsapp')
                        ->label('Whatsapp'),
                    DatePicker::make('birth_date')
                        ->maxDate(now())
                        ->label('Data de Nascimento'),
                    Radio::make('gender')
                        ->label('Gênero')
                        ->options([
                            'M' => 'Masculino',
                            'F' => 'Feminino',
                        ]),
                    GeneralFields::address(),
                    GeneralFields::note(),
                ])
                ->columns(2)
        ];
    }
}
