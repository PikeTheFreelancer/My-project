<?php

namespace App\Filament\Resources\ReportReasonResource\Pages;

use App\Filament\Resources\ReportReasonResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReportReasons extends ListRecords
{
    protected static string $resource = ReportReasonResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
