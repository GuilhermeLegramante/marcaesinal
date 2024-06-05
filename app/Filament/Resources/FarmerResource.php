<?php

namespace App\Filament\Resources;

use App\Filament\Forms\FarmerForm;
use App\Filament\Resources\FarmerResource\Pages;
use App\Filament\Resources\FarmerResource\RelationManagers;
use App\Filament\Tables\Columns;
use App\Models\Farmer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FarmerResource extends Resource
{
    protected static ?string $model = Farmer::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $modelLabel = 'produtor';

    protected static ?string $pluralModelLabel = 'produtores';

    protected static ?string $slug = 'produtor';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(FarmerForm::form());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('cpf_cnpj')
                    ->label('Documento')
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->searchable(),
                TextColumn::make('name')
                    ->label('Nome')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('E-mail')
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->searchable(),
                TextColumn::make('phone')
                    ->label('Telefone')
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->searchable(),
                TextColumn::make('whatsapp')
                    ->label('Whatsapp')
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->searchable(),
                TextColumn::make('birth_date')
                    ->label('Data de Nascimento')
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->date()
                    ->sortable(),
                TextColumn::make('gender')
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->label('Gênero')
                    ->searchable(),
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
            'index' => Pages\ListFarmers::route('/'),
            'create' => Pages\CreateFarmer::route('/criar'),
            'edit' => Pages\EditFarmer::route('/{record}/editar'),
        ];
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\BrandsRelationManager::class,
            RelationManagers\PropertiesRelationManager::class,
            RelationManagers\SignalsRelationManager::class,
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
