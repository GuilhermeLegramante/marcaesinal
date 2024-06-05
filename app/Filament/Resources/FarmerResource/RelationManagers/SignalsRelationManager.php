<?php

namespace App\Filament\Resources\FarmerResource\RelationManagers;

use App\Filament\Forms\SignalForm;
use App\Filament\Tables\SignalTable;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SignalsRelationManager extends RelationManager
{
    protected static string $relationship = 'signals';

    protected static ?string $title = 'Sinais';

    protected static ?string $label = 'Sinal';

    protected static ?string $pluralLabel = 'Sinais';

    public function form(Form $form): Form
    {
        return $form
            ->schema(SignalForm::form());
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('farmer_id')
            ->columns(SignalTable::table())
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->modalWidth(MaxWidth::FiveExtraLarge),
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make()->modalWidth(MaxWidth::FiveExtraLarge),
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
