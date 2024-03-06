<?php

namespace App\Filament\Resources\ReportReasonResource\Pages;

use App\Filament\Resources\ReportReasonResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditReportReason extends EditRecord
{
    protected static string $resource = ReportReasonResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
