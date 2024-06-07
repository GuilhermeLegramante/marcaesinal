<?php

namespace App\Filament\Pages;

use App\Filament\Forms\GeneralFields;
use Exception;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Saade\FilamentAutograph\Forms\Components\SignaturePad;

class BrandComparison extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-magnifying-glass';

    protected static string $view = 'filament.pages.brand-comparison';

    protected static ?string $navigationGroup = 'Consulta';

    protected static ?string $title = 'Verificação de Similaridade';

    protected static ?string $slug = 'verificacao-de-similaridade';

    protected ?string $heading = 'Verificação de Similaridade de Marca';

    protected ?string $subheading = 'Busca com apoio de inteligência artificial';

    public ?array $data = [];

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Comparação de imagem')
                    ->columns([
                        'sm' => 2,
                        'xl' => 2,
                        '2xl' => 2,
                    ])
                    ->description('Envie um arquivo OU desenho para ser verificado')
                    ->schema([
                        FileUpload::make('file')
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
                        Group::make([
                            SignaturePad::make('draw')
                                ->label('Desenho da Marca')
                                ->requiredWithout('file')
                                ->dotSize(4.0)
                                ->lineMaxWidth(4.0)
                                ->lineMinWidth(4.0)
                                ->backgroundColor('rgb(255,255,255)')
                                ->backgroundColorOnDark('rgb(255,255,255)')
                                ->penColor('#000')
                                ->penColorOnDark('#000')
                        ])->extraAttributes(['style' => 'width: 200px; height: 200px; ']),
                    ]),
            ])->statePath('data');
    }

    public function submit(): void
    {
        $data = $this->form->getState();

        try {
            if (isset($data['draw'])) {
                $uuid = uniqid();

                $image_parts = explode(";base64,", $data['draw']);
                $image_base64 = base64_decode($image_parts[1]);

                $path = '_python-verification/' . $uuid . '.png';

                Storage::disk('s3')->put(
                    $path,
                    $image_base64,
                    'public'
                );

                $url = Storage::disk('s3')->url($path);

                Http::withHeaders([
                    'Accept' => 'application/json',
                ])->post(env('QUEUE_URL'), [
                    'imagePath' => $url,
                    'clientCode' => env('CLIENT_IDENTIFIER'),
                ]);
            }

            Notification::make()
                ->title('Sucesso!')
                ->body('Verificação enviada para a análise da inteligência artificial')
                ->success()
                ->send();
        } catch (Exception $e) {
            Notification::make()
                ->title('Erro ao enviar a imagem!')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }
}
