<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComparisonResource\Pages;
use App\Filament\Resources\ComparisonResource\RelationManagers;
use App\Models\Comparison;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ComparisonResource extends Resource
{
    protected static ?string $model = Comparison::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-magnifying-glass';

    protected static ?string $recordTitleAttribute = 'resultado';

    protected static ?string $modelLabel = 'busca inteligente';

    protected static ?string $pluralModelLabel = 'busca inteligente';

    protected static ?string $slug = 'busca-inteligente';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('identificador_do_cliente')
                    ->required()
                    ->numeric(),
                Forms\Components\Textarea::make('imagem')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('resultado')
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('usuario')
                    ->maxLength(100),
                Forms\Components\TextInput::make('progresso')
                    ->maxLength(100),
                Forms\Components\Toggle::make('finalizada'),
                Forms\Components\Toggle::make('geral'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('identificador_do_cliente')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('usuario')
                    ->searchable(),
                Tables\Columns\TextColumn::make('progresso')
                    ->searchable(),
                Tables\Columns\IconColumn::make('finalizada')
                    ->boolean(),
                Tables\Columns\IconColumn::make('geral')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'create' => Pages\CreateComparison::route('/create'),
            'edit' => Pages\EditComparison::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
