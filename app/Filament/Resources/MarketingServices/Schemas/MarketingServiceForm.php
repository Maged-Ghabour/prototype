<?php

namespace App\Filament\Resources\MarketingServices\Schemas;

use Filament\Schemas\Schema;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;

class MarketingServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('معلومات الخدمة')
                    ->schema([
                        TextInput::make('title')
                            ->label('اسم الخدمة')
                            ->required()
                            ->maxLength(255),
                            
                        Select::make('category_id')
                            ->label('التصنيف المرتبط (رابط الخدمة)')
                            ->relationship('category', 'name')
                            ->nullable(),
                            
                        Textarea::make('description')
                            ->label('الوصف')
                            ->maxLength(500)
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('الأيقونة والمظهر')
                    ->schema([
                        Textarea::make('icon_svg')
                            ->label('كود الأيقونة SVG')
                            ->helperText('يمكنك لصق مسارات SVG الخاصة بك هنا. (فقط وسوم path و circle وما إلى ذلك).')
                            ->columnSpanFull(),
                            
                        Select::make('color_theme')
                            ->label('لون الأيقونة')
                            ->options([
                                'or' => 'برتقالي',
                                'bl' => 'أزرق',
                            ])
                            ->default('or')
                            ->required(),
                            
                        TextInput::make('sort_order')
                            ->label('ترتيب العرض')
                            ->numeric()
                            ->default(0),
                            
                        Toggle::make('is_active')
                            ->label('مفعل')
                            ->default(true),
                    ])->columns(2),
            ]);
    }
}
