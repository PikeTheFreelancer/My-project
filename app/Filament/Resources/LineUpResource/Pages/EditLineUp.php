<?php

namespace App\Filament\Resources\LineUpResource\Pages;

use App\Filament\Resources\LineUpResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLineUp extends EditRecord
{
    protected static string $resource = LineUpResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
