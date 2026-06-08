<?php

namespace App\Filament\Resources\MarketingServices\Pages;

use App\Filament\Resources\MarketingServices\MarketingServiceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMarketingServices extends ListRecords
{
    protected static string $resource = MarketingServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
