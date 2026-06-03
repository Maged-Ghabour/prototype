<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('معلومات التصنيف')
                ->icon('heroicon-o-folder')
                ->schema([
                    TextInput::make('name')
                        ->label('اسم التصنيف')
                        ->required()
                        ->maxLength(100)
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (string $operation, $state, callable $set) {
                            if ($operation === 'create' && filled($state)) {
                                $set('slug', Str::slug($state));
                            }
                        })
                        ->placeholder('مثال: واجهات المستخدم'),

                    TextInput::make('slug')
                        ->label('المعرّف')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(100)
                        ->extraInputAttributes(['dir' => 'ltr'])
                        ->prefix('/cat/'),

                    ColorPicker::make('color')
                        ->label('اللون')
                        ->default('#6d28d9')
                        ->required(),

                    TextInput::make('sort_order')
                        ->label('الترتيب')
                        ->numeric()
                        ->default(0)
                        ->minValue(0),

                    Textarea::make('description')
                        ->label('الوصف')
                        ->rows(3)
                        ->maxLength(500)
                        ->placeholder('وصف اختياري للتصنيف...')
                        ->columnSpanFull(),
                ])
                ->columns(2),
        ]);
    }
}
