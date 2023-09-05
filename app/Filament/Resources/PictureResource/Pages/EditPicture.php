<?php

namespace App\Filament\Resources\PictureResource\Pages;

use App\Filament\Resources\PictureResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPicture extends EditRecord
{
    protected static string $resource = PictureResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
