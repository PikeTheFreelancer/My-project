<?php

namespace App\Filament\Resources\BossResource\Pages;

use App\Filament\Resources\BossResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBoss extends EditRecord
{
    protected static string $resource = BossResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
