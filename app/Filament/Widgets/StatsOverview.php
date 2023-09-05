<?php

namespace App\Filament\Widgets;

use App\Models\Answer;
use App\Models\Picture;
use App\Models\Survey;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Users', User::count())
                ->url(route('filament.resources.users.index')),
            Card::make('Surveys', Survey::count())
                ->url(route('filament.resources.surveys.index')),
            Card::make('Answers', Answer::count())
                ->url(route('filament.resources.answers.index')),
            Card::make('Pictures', Picture::count())
                ->url(route('filament.resources.pictures.index')),
        ];
    }
}
