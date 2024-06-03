<?php

namespace App\Filament\Resources\BrandResource\RelationManagers;

use App\Filament\Forms\TransferForm;
use App\Filament\Tables\TransferTable;
use App\Models\Brand;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransfersRelationManager extends RelationManager
{
    protected static string $relationship = 'transfers';

    protected static ?string $title = 'Transferências';

    protected static ?string $label = 'Transferência';

    protected static ?string $pluralLabel = 'Transferências';

    public function form(Form $form): Form
    {
        return $form
            ->schema(TransferForm::form());
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('brand_id')
            ->columns(TransferTable::table())
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->mutateFormDataUsing(function (array $data): array {
                    $brand = $this->getOwnerRecord();

                    Brand::where('id', $brand->id)
                        ->update([
                            'farmer_id' => $data['to_id'],
                        ]);

                    $data['from_id'] = $brand->farmer->id;

                    return $data;
                })->successRedirectUrl(route('filament.admin.resources.marca.index'))
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
