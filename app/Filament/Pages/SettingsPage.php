<?php

namespace App\Filament\Pages;

use App\Models\AppSetting;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

/**
 * SettingsPage — صفحة الإعدادات العامة
 *
 * تسمح بتعديل:
 *  - لوجو التطبيق (رفع صورة)
 *  - اسم التطبيق
 *  - الاسم الكامل والبريد الإلكتروني للمدير
 *  - كلمة المرور (مع التأكيد)
 */
class SettingsPage extends Page
{
    // في Filament v5: navigationIcon هو BackedEnum|string|null
    protected static \BackedEnum|string|null $navigationIcon = Heroicon::OutlinedCog6Tooth;
    protected static ?string $navigationLabel = 'الإعدادات';
    protected static ?string $title           = 'إعدادات التطبيق';
    protected static ?int    $navigationSort  = 99;

    // في Filament v5: $view ليس static
    protected string $view = 'filament.pages.settings-page';

    // ── حالة الفورم ────────────────────────────────────────────────
    public array $data = [];

    public function mount(): void
    {
        $user = Auth::user();

        $defaultGtmHeader = <<<HTML
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-M2ML2DWB');</script>
<!-- End Google Tag Manager -->
<meta name="facebook-domain-verification" content="2ygo84e4pywlboz7gszbpqkvk9noc7" />
HTML;

        $defaultGtmBody = <<<HTML
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TX2N9P7J"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
HTML;

        $this->form->fill([
            'app_name' => AppSetting::get('app_name', config('app.name')),
            'logo'     => AppSetting::get('logo_path'),
            'gtm_header' => AppSetting::get('gtm_header', $defaultGtmHeader),
            'gtm_body'   => AppSetting::get('gtm_body', $defaultGtmBody),
            'name'     => $user->name,
            'email'    => $user->email,
            'password' => null,
            'password_confirmation' => null,
        ]);
    }

    /**
     * تعريف مخطط الفورم.
     */
    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([

                // ── إعدادات التطبيق ────────────────────────────────────
                Section::make('إعدادات التطبيق')
                    ->description('تخصيص اسم التطبيق ولوجو اللوحة.')
                    ->icon('heroicon-o-paint-brush')
                    ->schema([
                        TextInput::make('app_name')
                            ->label('اسم التطبيق')
                            ->required()
                            ->maxLength(100)
                            ->placeholder('مدير النماذج'),

                        FileUpload::make('logo')
                            ->label('لوجو التطبيق')
                            ->image()
                            ->imagePreviewHeight('80')
                            ->disk('public')
                            ->directory('logos')
                            ->helperText('PNG, JPG, SVG, WEBP'),
                    ])
                    ->columns(2),

                // ── إعدادات التتبع (GTM) ──────────────────────────────────
                Section::make('أكواد التتبع و Google Tag Manager')
                    ->description('أضف أكواد GTM أو Meta tags ليتم إدراجها في جميع صفحات الموقع.')
                    ->icon('heroicon-o-code-bracket')
                    ->schema([
                        Textarea::make('gtm_header')
                            ->label('كود Header')
                            ->rows(6)
                            ->placeholder('أدخل الكود الذي سيوضع في الـ <head>...'),

                        Textarea::make('gtm_body')
                            ->label('كود Body')
                            ->rows(6)
                            ->placeholder('أدخل الكود الذي سيوضع بعد فتح <body>...'),
                    ])
                    ->columns(1),

                // ── بيانات الحساب ──────────────────────────────────────
                Section::make('بيانات حساب المدير')
                    ->description('تحديث الاسم والبريد الإلكتروني.')
                    ->icon('heroicon-o-user-circle')
                    ->schema([
                        TextInput::make('name')
                            ->label('الاسم الكامل')
                            ->required()
                            ->maxLength(100),

                        TextInput::make('email')
                            ->label('البريد الإلكتروني')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->unique('users', 'email', ignorable: Auth::user()),
                    ])
                    ->columns(2),

                // ── تغيير كلمة المرور ──────────────────────────────────
                Section::make('تغيير كلمة المرور')
                    ->description('اتركها فارغة إذا لا تريد تغيير كلمة المرور.')
                    ->icon('heroicon-o-lock-closed')
                    ->schema([
                        TextInput::make('password')
                            ->label('كلمة المرور الجديدة')
                            ->password()
                            ->revealable()
                            ->minLength(8)
                            ->maxLength(128)
                            ->nullable()
                            ->placeholder('اتركها فارغة للإبقاء على الحالية'),

                        TextInput::make('password_confirmation')
                            ->label('تأكيد كلمة المرور')
                            ->password()
                            ->revealable()
                            ->nullable()
                            ->same('password')
                            ->placeholder('أعد كتابة كلمة المرور'),
                    ])
                    ->columns(2),
            ]);
    }

    /**
     * حفظ جميع الإعدادات.
     */
    public function save(): void
    {
        $data = $this->form->getState();

        // ── حفظ إعدادات التطبيق ─────────────────────────────────────
        AppSetting::set('app_name', $data['app_name']);
        AppSetting::set('gtm_header', $data['gtm_header'] ?? '');
        AppSetting::set('gtm_body', $data['gtm_body'] ?? '');

        if (!empty($data['logo'])) {
            AppSetting::set('logo_path', $data['logo']);
        }

        // ── تحديث بيانات المستخدم ────────────────────────────────────
        $user = Auth::user();
        $user->name  = $data['name'];
        $user->email = $data['email'];

        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        // ── إشعار النجاح ─────────────────────────────────────────────
        Notification::make()
            ->title('تم الحفظ بنجاح ✅')
            ->body('تم تحديث إعدادات التطبيق وبيانات حسابك.')
            ->success()
            ->send();
    }
}
