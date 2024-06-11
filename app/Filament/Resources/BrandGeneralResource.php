<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BrandGeneralResource\Pages;
use App\Filament\Resources\BrandGeneralResource\RelationManagers;
use App\Filament\Tables\Columns;
use App\Models\BrandGeneral;
use App\Tables\Columns\BrandGeneralImage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BrandGeneralResource extends Resource
{
    protected static ?string $model = BrandGeneral::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $recordTitleAttribute = 'number';

    protected static ?string $modelLabel = 'marca geral';

    protected static ?string $pluralModelLabel = 'marcas geral';

    // protected static ?string $navigationGroup = 'Parâmetros';

    protected static ?string $slug = 'marca-geral';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('number')
                    ->label('N°')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('year')
                    ->label('Ano')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('path')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('client_name')

                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('farmer_name')

                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                BrandGeneralImage::make('path')
                    ->label('Marca'),
                TextColumn::make('number')
                    ->label('N°')
                    ->sortable()
                    ->alignCenter()
                    ->formatStateUsing(fn (string $state, BrandGeneral $brand): string => $state . ' / ' . $brand->year),
                Tables\Columns\TextColumn::make('client_name')
                    ->label('Município')
                    ->searchable(),
                Tables\Columns\TextColumn::make('farmer_name')
                    ->label('Produtor')
                    ->searchable(),
                Columns::createdAt(),
                Columns::updatedAt(),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageBrandGenerals::route('/'),
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
