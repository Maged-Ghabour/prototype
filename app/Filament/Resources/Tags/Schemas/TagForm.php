<?php

namespace App\Filament\Resources\Tags\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class TagForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('معلومات الوسم')
                ->icon('heroicon-o-tag')
                ->schema([
                    TextInput::make('name')
                        ->label('اسم الوسم')
                        ->required()
                        ->maxLength(50)
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (string $operation, $state, callable $set) {
                            if ($operation === 'create' && filled($state)) {
                                $set('slug', Str::slug($state));
                            }
                        })
                        ->placeholder('مثال: React'),

                    TextInput::make('slug')
                        ->label('المعرّف')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(50)
                        ->extraInputAttributes(['dir' => 'ltr']),

                    ColorPicker::make('color')
                        ->label('اللون')
                        ->default('#0ea5e9')
                        ->required(),
                ])
                ->columns(3),
        ]);
    }
}
