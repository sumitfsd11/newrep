<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PictureResource\Pages;
use App\Models\Picture;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class PictureResource extends Resource
{
    protected static ?string $model = Picture::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->autofocus()
                    ->required(),
                Forms\Components\FileUpload::make('path')
                    ->label('Picture')
                    ->required()
                    ->directory('pictures')
                    ->acceptedFileTypes(['image/*']),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('Unique ID')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\ImageColumn::make('path')
                    ->label('Picture')
                    ->size(200),
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
            'index' => Pages\ListPictures::route('/'),
            'create' => Pages\CreatePicture::route('/create'),
            'view' => Pages\ViewPicture::route('/{record}'),
            'edit' => Pages\EditPicture::route('/{record}/edit'),
        ];
    }
}
