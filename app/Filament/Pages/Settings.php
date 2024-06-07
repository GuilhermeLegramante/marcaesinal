<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Exception;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Leandrocfe\FilamentPtbrFormFields\Document;
use Leandrocfe\FilamentPtbrFormFields\PhoneNumber;
use Saade\FilamentAutograph\Forms\Components\SignaturePad;

class Settings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $view = 'filament.pages.settings';

    protected static ?string $navigationGroup = 'Configurações';

    protected static ?string $title = 'Definições Gerais';

    protected static ?string $slug = 'definicoes-gerais';

    protected ?string $heading = 'Definições Gerais';

    protected ?string $subheading = 'Ajuste as definições gerais do sistema';

    public ?array $data = [];

    public function mount(): void
    {
        $setting = Setting::get()->first();

        if (isset($setting)) {
            $this->form->fill([
                "city" => $setting->city,
                "state" => $setting->state,
                "cnpj" => $setting->cnpj,
                "phone" => $setting->phone,
                "address" => $setting->address,
                "department_name" => $setting->department_name,
                "years_validity" => $setting->years_validity,
                "renewal_deadline" => $setting->renewal_deadline,
                "show_note_on_brand_title" => $setting->show_note_on_brand_title,
                "suggest_brand_number" => $setting->suggest_brand_number,
                "show_signals_on_brand_title" => $setting->show_signals_on_brand_title,
                "show_report_header" => $setting->show_report_header,
                "show_report_watermark" => $setting->show_report_watermark,
            ]);
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Dados do Cliente')
                    ->columns([
                        'sm' => 2,
                        'xl' => 2,
                        '2xl' => 2,
                    ])
                    ->description('Informações Gerais do Órgão')
                    ->schema([
                        Group::make([
                            SignaturePad::make('draw')
                                ->label('Desenho da Marca')
                                ->live()
                                ->dotSize(4.0)
                                ->lineMaxWidth(4.0)
                                ->lineMinWidth(4.0)
                                ->backgroundColor('rgb(255,255,255)')
                                ->backgroundColorOnDark('rgb(255,255,255)')
                                ->penColor('#000')
                                ->penColorOnDark('#000')
                        ])->extraAttributes(['style' => 'width: 200px; height: 200px; ']),
                        TextInput::make('city')
                            ->label('Nome do Município')
                            ->required(),
                        TextInput::make('state')
                            ->label('UF')
                            ->required()
                            ->maxLength(2),
                        Document::make('cnpj')
                            ->label('CNPJ do Órgão')
                            ->required()
                            ->validation(false)
                            ->cnpj(),
                        PhoneNumber::make('phone')
                            ->label('Telefone'),
                        TextInput::make('address')
                            ->label('Endereço')
                            ->columnSpanFull(),
                        TextInput::make('department_name')
                            ->label('Nome do Departamento ou Setor responsável pelas Marcas e Sinais')
                            ->columnSpanFull(),
                    ]),
                Section::make('Marcas e Sinais')
                    ->description('Configurações do cadastro de Marcas e Sinais')
                    ->columns([
                        'sm' => 2,
                        'xl' => 2,
                        '2xl' => 2,
                    ])
                    ->schema([
                        TextInput::make('years_validity')
                            ->numeric()
                            ->label('Validade das Marcas (em anos)'),
                        DatePicker::make('renewal_deadline')
                            ->label('Data limite para renovação das marcas'),
                        ToggleButtons::make('show_note_on_brand_title')
                            ->label('Observação no Título da Marca')
                            ->required()
                            ->boolean('SIM', 'NÃO')
                            ->grouped(),
                        ToggleButtons::make('suggest_brand_number')
                            ->label('Sugerir número da marca')
                            ->required()
                            ->boolean('SIM', 'NÃO')
                            ->grouped(),
                        ToggleButtons::make('show_signals_on_brand_title')
                            ->label('Sinais no Título da Marca')
                            ->required()
                            ->boolean('SIM', 'NÃO')
                            ->grouped(),
                    ]),
                Section::make('Relatórios')
                    ->description('Configurações dos Relatórios')
                    ->columns([
                        'sm' => 2,
                        'xl' => 2,
                        '2xl' => 2,
                    ])
                    ->schema([
                        ToggleButtons::make('show_report_header')
                            ->label('Cabeçalho')
                            ->required()
                            ->boolean('SIM', 'NÃO')
                            ->grouped(),
                        ToggleButtons::make('show_report_watermark')
                            ->label("Marca d'água")
                            ->required()
                            ->boolean('SIM', 'NÃO')
                            ->grouped(),
                    ])
            ])->statePath('data');
    }

    public function submit(): void
    {
        $data = $this->form->getState();
        dd($data);
        try {
            Setting::where('id', '>=', 1)->delete();

            Setting::create([
                "city" => $data['city'],
                "state" => $data['state'],
                "cnpj" => $data['cnpj'],
                "phone" => $data['phone'],
                "address" => $data['address'],
                "department_name" => $data['department_name'],
                "years_validity" => $data['years_validity'],
                "renewal_deadline" => $data['renewal_deadline'],
                "show_note_on_brand_title" => $data['show_note_on_brand_title'],
                "suggest_brand_number" => $data['suggest_brand_number'],
                "show_signals_on_brand_title" => $data['show_signals_on_brand_title'],
                "show_report_header" => $data['show_report_header'],
                "show_report_watermark" => $data['show_report_watermark'],
            ]);

            Notification::make()
                ->title('Sucesso!')
                ->body('Configurações salvas')
                ->success()
                ->send();
        } catch (Exception $e) {
            Notification::make()
                ->title('Erro ao salvar os dados!')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }
}
