<?php

namespace App\Filament\Resources\FarmerResource\RelationManagers;

use App\Filament\Forms\BrandForm;
use App\Filament\Tables\BrandTable;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BrandsRelationManager extends RelationManager
{
    protected static string $relationship = 'brands';

    protected static ?string $title = 'Marcas';

    protected static ?string $label = 'Marca';

    protected static ?string $pluralLabel = 'Marcas';

    public function form(Form $form): Form
    {
        return $form
            ->schema(BrandForm::form());
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('number')
            ->columns(BrandTable::table())
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
