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
                        ->placeholder('دراسة حالة رائعة'),

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

                    Toggle::make('is_visible_on_home')
                        ->label('عرض في الرئيسية')
                        ->helperText('عند التفعيل، سيتم عرض هذا النموذج في الصفحة الرئيسية.')
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
                        ->maxSize(2048)
                        ->helperText('صورة تظهر في كروت العرض (اختياري)')
                        ->columnSpanFull(),

                    \Filament\Forms\Components\Select::make('icon')
                        ->label('أيقونة النموذج (اختياري)')
                        ->helperText('اختر أيقونة في حال عدم رفع صورة مصغرة')
                        ->options([
                            'heroicon-o-home' => 'الرئيسية (Home)',
                            'heroicon-o-shopping-cart' => 'متجر إلكتروني (Cart)',
                            'heroicon-o-academic-cap' => 'تعليم (Academic)',
                            'heroicon-o-briefcase' => 'أعمال (Briefcase)',
                            'heroicon-o-building-office' => 'عقارات (Building)',
                            'heroicon-o-camera' => 'تصوير (Camera)',
                            'heroicon-o-code-bracket' => 'برمجة (Code)',
                            'heroicon-o-computer-desktop' => 'شاشة (Desktop)',
                            'heroicon-o-device-phone-mobile' => 'جوال (Mobile)',
                            'heroicon-o-heart' => 'صحة (Health)',
                            'heroicon-o-truck' => 'توصيل (Truck)',
                            'heroicon-o-users' => 'مجتمع (Users)',
                            'heroicon-o-sparkles' => 'تصميم / إبداع (Sparkles)',
                            'heroicon-o-bolt' => 'تكنولوجيا (Bolt)',
                            'heroicon-o-rocket-launch' => 'انطلاق / شركة ناشئة (Rocket)',
                        ])
                        ->searchable()
                        ->columnSpanFull(),
                ])
                ->columns(2),

            // ── قسم التصنيف والوسوم ────────────────────────────────────
            Section::make('التصنيف والوسوم')
                ->description('صنّف نموذجك وأضف وسوماً لتسهيل البحث والتصفية.')
                ->icon('heroicon-o-tag')
                ->schema([
                    Select::make('categories')
                        ->label('التصنيفات')
                        ->relationship('categories', 'name')
                        ->multiple()
                        ->searchable()
                        ->preload()
                        ->placeholder('اختر تصنيفات...')
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
                    \Filament\Forms\Components\FileUpload::make('html_file_upload')
                        ->label('رفع ملف HTML (اختياري - بديل للنسخ واللصق)')
                        ->helperText('إذا كان الكود كبيراً ويتم حظره من قبل حماية السيرفر (ModSecurity)، قم بحفظ الكود في ملف .html وارفعه هنا وسنقوم نحن بسحب الكود منه تلقائياً.')
                        ->acceptedFileTypes(['text/html', 'text/plain'])
                        ->disk('local')
                        ->directory('temp-html')
                        ->columnSpanFull(),

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

            Section::make('الوسائط وفيديوهات يوتيوب')
                ->description('إضافة فيديوهات يوتيوب مع إخفاء الشعار أو أي بيانات عن يوتيوب.')
                ->icon('heroicon-o-video-camera')
                ->schema([
                    \Filament\Forms\Components\Repeater::make('youtube_videos')
                        ->label('فيديوهات يوتيوب')
                        ->schema([
                            TextInput::make('url')
                                ->label('رابط الفيديو')
                                ->url()
                                ->required()
                                ->placeholder('https://www.youtube.com/watch?v=...')
                                ->extraInputAttributes(['dir' => 'ltr']),
                        ])
                        ->addActionLabel('إضافة فيديو جديد')
                        ->reorderable()
                        ->collapsible()
                        ->columnSpanFull(),
                ]),
        ]);
    }
}
