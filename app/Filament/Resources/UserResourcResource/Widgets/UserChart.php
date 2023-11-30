<?php

namespace App\Filament\Resources\UserResourcResource\Widgets;

use Filament\Widgets\BarChartWidget;

class UserChart extends BarChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        return [
            //
        ];
    }
}
