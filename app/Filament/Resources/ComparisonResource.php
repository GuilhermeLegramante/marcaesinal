<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComparisonResource\Pages;
use App\Filament\Resources\ComparisonResource\RelationManagers;
use App\Filament\Tables\Columns;
use App\Forms\Components\ComparisonImages;
use App\Forms\Components\ComparisonImageToForm;
use App\Models\Comparison;
use App\Tables\Columns\ComparisonImage;
use App\Utils\ArrayHandler;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ComparisonResource extends Resource
{
    protected static ?string $model = Comparison::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-magnifying-glass';

    protected static ?string $recordTitleAttribute = 'id';

    protected static ?string $modelLabel = 'busca inteligente';

    protected static ?string $pluralModelLabel = 'busca inteligente';

    protected static ?string $slug = 'busca-inteligente';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Comparação de imagem')
                    // ->columns([
                    //     'sm' => 2,
                    //     'xl' => 2,
                    //     '2xl' => 2,
                    // ])
                    ->description('Detalhes da verificação')
                    ->schema([
                        ComparisonImageToForm::make('imagem'),
                        ComparisonImages::make('Resultado')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ComparisonImage::make('imagem')
                    ->label('Imagem'),
                Columns::createdAt(),
                Tables\Columns\IconColumn::make('finalizada')
                    ->alignCenter()
                    ->boolean(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\DeleteAction::make(),
                ]),
            ], position: ActionsPosition::BeforeColumns)
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->poll('3s')
            ->modifyQueryUsing(fn (Builder $query) => $query->where('identificador_do_cliente', env('CLIENT_IDENTIFIER')));
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListComparisons::route('/'),
            // 'create' => Pages\CreateComparison::route('/create'),
            // 'edit' => Pages\EditComparison::route('/{record}/edit'),
            'view' => Pages\ViewComparison::route('/{record}/detalhes'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('identificador_do_cliente', env('CLIENT_IDENTIFIER'))->count();
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
