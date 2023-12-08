<?php

namespace App\Filament\Resources\BossResource\Pages;

use App\Filament\Resources\BossResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBosses extends ListRecords
{
    protected static string $resource = BossResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
