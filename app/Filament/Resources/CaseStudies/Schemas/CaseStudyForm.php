<?php

namespace App\Filament\Resources\CaseStudies\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CaseStudyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('المعلومات الأساسية')
                ->schema([
                    TextInput::make('project_name')
                        ->label('اسم المشروع')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (string $operation, $state, callable $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                    TextInput::make('client_name')
                        ->label('اسم العميل')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('slug')
                        ->label('المعرّف (Slug)')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(255)
                        ->extraInputAttributes(['dir' => 'ltr']),

                    TextInput::make('industry')
                        ->label('مجال العمل (Industry)')
                        ->maxLength(255),

                    Select::make('prototype_id')
                        ->label('النموذج المرتبط')
                        ->relationship('prototype', 'title')
                        ->searchable()
                        ->preload()
                        ->nullable(),

                    Toggle::make('is_published')
                        ->label('منشور عام')
                        ->default(false),
                ])->columns(2),

            Section::make('التفاصيل والمحتوى')
                ->schema([
                    Textarea::make('short_description')
                        ->label('وصف قصير')
                        ->rows(3)
                        ->maxLength(65535)
                        ->columnSpanFull(),

                    RichEditor::make('challenge')
                        ->label('التحدي (Challenge)')
                        ->columnSpanFull(),

                    RichEditor::make('solution')
                        ->label('الحل (Solution)')
                        ->columnSpanFull(),

                    RichEditor::make('results')
                        ->label('النتائج (Results)')
                        ->columnSpanFull(),
                ]),

            Section::make('الوسائط')
                ->schema([
                    FileUpload::make('featured_image')
                        ->label('الصورة البارزة')
                        ->image()
                        ->directory('case-studies/featured')
                        ->columnSpanFull(),

                    FileUpload::make('gallery_images')
                        ->label('معرض الصور')
                        ->image()
                        ->multiple()
                        ->directory('case-studies/gallery')
                        ->reorderable()
                        ->columnSpanFull(),
                ]),
        ]);
    }
}
