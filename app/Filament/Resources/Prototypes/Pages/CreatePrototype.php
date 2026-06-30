<?php

namespace App\Filament\Resources\Prototypes\Pages;

use App\Filament\Resources\Prototypes\PrototypeResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePrototype extends CreateRecord
{
    protected static string $resource = PrototypeResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (!empty($data['html_file_upload'])) {
            $filePath = is_array($data['html_file_upload']) ? array_values($data['html_file_upload'])[0] : $data['html_file_upload'];
            $contents = \Illuminate\Support\Facades\Storage::disk('local')->get($filePath);
            if ($contents !== null) {
                $data['html_code'] = $contents;
            }
            unset($data['html_file_upload']);
        } else {
            unset($data['html_file_upload']);
        }
        
        return $data;
    }
}
