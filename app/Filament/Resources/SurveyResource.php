<?php

namespace App\Filament\Resources;

use App\Enums\SurveyStatus;
use App\Filament\Resources\SurveyResource\Pages;
use App\Helpers\EnumHelper;
use App\Models\Survey;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class SurveyResource extends Resource
{
    protected static ?string $model = Survey::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('id')
                    ->visibleOn('view'),
                TextInput::make('name')
                    ->required(),
                Select::make('status')
                    ->options(SurveyStatus::class)
                    ->visibleOn('view'),
                TextInput::make('fields_count')
                    ->visibleOn('view'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('name'),
                TextColumn::make('status')
                    ->formatStateUsing(fn (int $state): string => EnumHelper::vk(SurveyStatus::cases())[$state]),
                TextColumn::make('fields_count'),
                TextColumn::make('answers_count')
                    ->getStateUsing(fn (Survey $record) => $record->answers()->count()),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListSurveys::route('/'),
            'create' => Pages\CreateSurvey::route('/create'),
            'view' => Pages\ViewSurvey::route('/{record}'),
            'edit' => Pages\EditSurvey::route('/{record}/edit'),
        ];
    }
}
