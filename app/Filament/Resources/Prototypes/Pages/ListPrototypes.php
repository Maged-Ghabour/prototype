<?php

namespace App\Filament\Resources\Prototypes\Pages;

use App\Filament\Resources\Prototypes\PrototypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPrototypes extends ListRecords
{
    protected static string $resource = PrototypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
