<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExpenseResource\Pages;
use App\Filament\Resources\ExpenseResource\RelationManagers;
use App\Models\Category;
use App\Models\Expense;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExpenseResource extends Resource
{
    protected static ?string $model = Expense::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                DateTimePicker::make('date_time')
                    ->label("Date and time")
                    ->default(now())
                    ->seconds(false)
                    ->native(false),
                Select::make('category_id')
                    ->label(__("Category"))
                    ->required()
                    ->options(Category::orderByMostUsed()->pluck('name', 'id'))
                    ->searchable()
                    ->createOptionForm([
                        TextInput::make('name')
                            ->string()
                            ->required(),
                    ])
                    ->createOptionUsing(function ($data) {
                        return Category::create($data);
                    }),
                TextInput::make('ammount')
                    ->label(__("Ammount"))
                    ->numeric()
                    ->inputMode('decimal')

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('date_time'),
                TextColumn::make('user.name'),
                TextColumn::make('category.name'),
                TextColumn::make('ammount')
                    ->money()
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
            'index' => Pages\ListExpenses::route('/'),
            'create' => Pages\CreateExpense::route('/create'),
            'edit' => Pages\EditExpense::route('/{record}/edit'),
        ];
    }
}
