<?php

namespace App\Filament\Resources\Prototypes\Pages;

use App\Filament\Resources\Prototypes\PrototypeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPrototype extends EditRecord
{
    protected static string $resource = PrototypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
