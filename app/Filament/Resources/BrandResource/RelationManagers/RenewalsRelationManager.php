<?php

namespace App\Filament\Resources\BrandResource\RelationManagers;

use App\Filament\Forms\RenewalForm;
use App\Filament\Tables\RenewalTable;
use App\Models\Brand;
use App\Models\Renewal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RenewalsRelationManager extends RelationManager
{
    protected static string $relationship = 'renewals';

    protected static ?string $title = 'Renovações';

    protected static ?string $label = 'Renovação';

    protected static ?string $pluralLabel = 'Renovações';

    public function form(Form $form): Form
    {
        return $form
            ->schema(RenewalForm::form());
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('number')
            ->columns(RenewalTable::table())
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $brand = $this->getOwnerRecord();

                        Brand::where('id', $brand->id)
                            ->update([
                                'number' => $data['number'],
                                'year' => $data['year']
                            ]);

                        return $data;
                    })
                    ->successRedirectUrl(route('filament.admin.resources.marca.index'))
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
