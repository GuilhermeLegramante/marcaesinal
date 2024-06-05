<?php

namespace App\Filament\Resources;

use App\Filament\Forms\SignalForm;
use App\Filament\Resources\SignalResource\Pages;
use App\Filament\Resources\SignalResource\RelationManagers;
use App\Filament\Tables\SignalTable;
use App\Models\Signal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SignalResource extends Resource
{
    protected static ?string $model = Signal::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $modelLabel = 'sinal';

    protected static ?string $pluralModelLabel = 'sinais';

    protected static ?string $slug = 'sinal';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(SignalForm::form());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(SignalTable::table())
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
            'index' => Pages\ManageSignals::route('/'),
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
