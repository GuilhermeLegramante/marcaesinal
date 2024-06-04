<?php

namespace App\Filament\Resources;

use App\Filament\Forms\SignalTypeForm;
use App\Filament\Resources\SignalTypeResource\Pages;
use App\Filament\Resources\SignalTypeResource\RelationManagers;
use App\Filament\Tables\SignalTypeTable;
use App\Models\SignalType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class SignalTypeResource extends Resource
{
    protected static ?string $model = SignalType::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $modelLabel = 'tipo de sinal';

    protected static ?string $pluralModelLabel = 'tipos de sinal';

    protected static ?string $navigationGroup = 'Parâmetros';

    protected static ?string $slug = 'tipo-de-sinal';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(SignalTypeForm::form());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(SignalTypeTable::table())
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $path = str()->random() . '.png';

                        $image_parts = explode(";base64,", $data['draw']);

                        if (isset($image_parts[1])) {
                            $image_base64 = base64_decode($image_parts[1]);

                            Storage::put('public/' . $path, $image_base64);

                            $data['path'] = $path;
                        }

                        return $data;
                    }),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSignalTypes::route('/'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
