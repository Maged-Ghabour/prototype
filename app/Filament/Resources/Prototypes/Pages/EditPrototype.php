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

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (!empty($data['html_file_upload'])) {
            $filePath = is_array($data['html_file_upload']) ? array_values($data['html_file_upload'])[0] : $data['html_file_upload'];
            $contents = \Illuminate\Support\Facades\Storage::disk('local')->get($filePath);
            if ($contents !== null) {
                $data['html_code'] = $contents;
            }
            unset($data['html_file_upload']);
        } else {
            // Remove the key so it doesn't cause a SQL error if left empty
            unset($data['html_file_upload']);
        }
        
        return $data;
    }
}
