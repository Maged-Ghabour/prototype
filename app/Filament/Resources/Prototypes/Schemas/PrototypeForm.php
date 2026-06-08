<?php

namespace App\Filament\Resources\Prototypes\Schemas;

use App\Models\Category;
use App\Models\Tag;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

/**
 * PrototypeForm — مخطط نموذج Filament للنماذج التجريبية
 *
 * Filament v5:
 *   - Section  → Filament\Schemas\Components\Section
 *   - TextInput, Textarea, Toggle, Select → Filament\Forms\Components\*
 */
class PrototypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            // ── قسم المعلومات الأساسية ─────────────────────────────────
            Section::make('تفاصيل النموذج')
                ->description('المعلومات الأساسية للنموذج التجريبي.')
                ->icon('heroicon-o-information-circle')
                ->schema([
                    TextInput::make('title')
                        ->label('العنوان')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (string $operation, $state, callable $set) {
                            if ($operation === 'create' && filled($state)) {
                                $set('slug', Str::slug($state));
                            }
                        })
                        ->placeholder('نموذج تجريبي رائع'),

                    TextInput::make('slug')
                        ->label('المعرّف (Slug)')
                        ->required()
                        ->maxLength(255)
                        ->unique(ignoreRecord: true)
                        ->helperText('يُستخدم في رابط المعاينة: /p/{slug}')
                        ->prefix('/p/')
                        ->placeholder('my-awesome-prototype')
                        ->extraInputAttributes(['dir' => 'ltr']),

                    Toggle::make('is_public')
                        ->label('متاح للعموم')
                        ->helperText('عند التفعيل، يمكن لأي شخص لديه الرابط مشاهدة هذا النموذج.')
                        ->default(true)
                        ->onColor('success')
                        ->offColor('danger'),

                    \Filament\Forms\Components\Select::make('status')
                        ->label('حالة النموذج')
                        ->options(\App\Enums\PrototypeStatus::class)
                        ->default(\App\Enums\PrototypeStatus::Draft)
                        ->required(),

                    \Filament\Forms\Components\FileUpload::make('thumbnail')
                        ->label('الصورة المصغرة (Thumbnail)')
                        ->image()
                        ->disk('public')
                        ->directory('prototypes/thumbnails')
                        ->columnSpanFull(),
                ])
                ->columns(2),

            // ── قسم التصنيف والوسوم ────────────────────────────────────
            Section::make('التصنيف والوسوم')
                ->description('صنّف نموذجك وأضف وسوماً لتسهيل البحث والتصفية.')
                ->icon('heroicon-o-tag')
                ->schema([
                    Select::make('category_id')
                        ->label('التصنيف')
                        ->relationship('category', 'name')
                        ->searchable()
                        ->preload()
                        ->placeholder('اختر تصنيفاً...')
                        ->nullable()
                        ->createOptionForm([
                            TextInput::make('name')
                                ->label('اسم التصنيف')
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                            TextInput::make('slug')
                                ->label('المعرّف')
                                ->required()
                                ->extraInputAttributes(['dir' => 'ltr']),
                        ])
                        ->native(false),

                    Select::make('tags')
                        ->label('الوسوم')
                        ->relationship('tags', 'name')
                        ->multiple()
                        ->searchable()
                        ->preload()
                        ->placeholder('أضف وسوماً...')
                        ->createOptionForm([
                            TextInput::make('name')
                                ->label('اسم الوسم')
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                            TextInput::make('slug')
                                ->label('المعرّف')
                                ->required()
                                ->extraInputAttributes(['dir' => 'ltr']),
                        ])
                        ->native(false),
                ])
                ->columns(2),

            // ── قسم كود HTML ──────────────────────────────────────────
            Section::make('كود HTML')
                ->description('هيكل HTML للنموذج التجريبي.')
                ->icon('heroicon-o-code-bracket')
                ->schema([
                    Textarea::make('html_code')
                        ->label('')
                        ->rows(18)
                        ->placeholder("<!DOCTYPE html>\n<html>\n<body>\n  <!-- ضع كود HTML هنا -->\n</body>\n</html>")
                        ->extraInputAttributes([
                            'style' => 'font-family: monospace; font-size: 13px;',
                            'spellcheck' => 'false',
                            'dir' => 'ltr',
                        ])
                        ->columnSpanFull(),
                ]),

            // ── قسم كود CSS ──────────────────────────────────────────
            Section::make('كود CSS')
                ->description('تنسيقات وأنماط النموذج التجريبي.')
                ->icon('heroicon-o-paint-brush')
                ->schema([
                    Textarea::make('css_code')
                        ->label('')
                        ->rows(15)
                        ->placeholder("/* ضع كود CSS هنا */\nbody {\n  margin: 0;\n  padding: 0;\n}")
                        ->extraInputAttributes([
                            'style' => 'font-family: monospace; font-size: 13px;',
                            'spellcheck' => 'false',
                            'dir' => 'ltr',
                        ])
                        ->columnSpanFull(),
                ]),

            // ── قسم كود JavaScript ────────────────────────────────────
            Section::make('كود JavaScript')
                ->description('السلوك التفاعلي للنموذج التجريبي.')
                ->icon('heroicon-o-bolt')
                ->schema([
                    Textarea::make('js_code')
                        ->label('')
                        ->rows(15)
                        ->placeholder("// ضع كود JavaScript هنا\nconsole.log('مرحباً بالعالم!');")
                        ->extraInputAttributes([
                            'style' => 'font-family: monospace; font-size: 13px;',
                            'spellcheck' => 'false',
                            'dir' => 'ltr',
                        ])
                        ->columnSpanFull(),
                ]),
        ]);
    }
}
