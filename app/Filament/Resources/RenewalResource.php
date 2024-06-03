<?php

namespace App\Filament\Resources;

use App\Filament\Forms\RenewalForm;
use App\Filament\Resources\ClientResource\Pages\CreateRenewal;
use App\Filament\Resources\ClientResource\Pages\EditRenewal;
use App\Filament\Resources\ClientResource\Pages\ListRenewals;
use App\Filament\Resources\RenewalResource\Pages;
use App\Filament\Resources\RenewalResource\Pages\ManageRenewals;
use App\Filament\Resources\RenewalResource\RelationManagers;
use App\Filament\Tables\Columns;
use App\Models\Renewal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RenewalResource extends Resource
{
    protected static ?string $model = Renewal::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $recordTitleAttribute = 'number';

    protected static ?string $modelLabel = 'renovação';

    protected static ?string $pluralModelLabel = 'renovações';

    protected static ?string $navigationGroup = 'Parâmetros';

    protected static ?string $slug = 'renovacao';


    public static function form(Form $form): Form
    {
        return $form
            ->schema(RenewalForm::form());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('brand.id')
                    ->label('Marca')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('number')
                    ->label('Número')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('year')
                    ->label('Ano')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('validity')
                    ->label('Validade')
                    ->date()
                    ->sortable(),
                Columns::createdAt(),
                Columns::updatedAt(),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ], position: ActionsPosition::BeforeColumns)
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageRenewals::route('/'),
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
