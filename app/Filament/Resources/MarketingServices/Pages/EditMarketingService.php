<?php

namespace App\Filament\Resources\MarketingServices\Pages;

use App\Filament\Resources\MarketingServices\MarketingServiceResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMarketingService extends EditRecord
{
    protected static string $resource = MarketingServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
