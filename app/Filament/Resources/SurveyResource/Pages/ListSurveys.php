<?php

namespace App\Filament\Resources\SurveyResource\Pages;

use App\Filament\Resources\SurveyResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSurveys extends ListRecords
{
    protected static string $resource = SurveyResource::class;

    protected function getActions(): array
    {
        return [
            Actions\Action::make('create')->action('create'),
        ];
    }

    public function create()
    {
        return redirect()->route('surveys.create');
    }
}
