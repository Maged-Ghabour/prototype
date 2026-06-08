<?php

namespace App\Providers\Filament;

use App\Models\AppSetting;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Assets\Css;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\Middleware\ShareErrorsFromSession;

/**
 * AdminPanelProvider
 *
 * يُهيّئ لوحة تحكم Filament لتطبيق "مدير النماذج".
 * يقرأ اسم التطبيق ولوجو ديناميكياً من جدول app_settings.
 */
class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        // ── قراءة الإعدادات من قاعدة البيانات (مع fallback آمن) ───
        $appName  = $this->getSettingsSafely('app_name', config('app.name', 'مدير النماذج'));
        $logoPath = $this->getSettingsSafely('logo_path');

        $panelBuilder = $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()

            // ── الألوان ──────────────────────────────────────────────
            ->colors([
                'primary' => Color::Orange,
            ])

            // ── اسم التطبيق (ديناميكي) ───────────────────────────────
            ->brandName($appName)

            // ── خط Cairo من Google Fonts ──────────────────────────────
            ->font('Cairo', 'https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap')

            // ── الاكتشاف التلقائي ─────────────────────────────────────
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
            ])
            ->navigationItems([
                \Filament\Navigation\NavigationItem::make('معرض الأعمال العام')
                    ->url(fn (): string => route('portfolio'))
                    ->icon('heroicon-o-globe-alt')
                    ->sort(100)
                    ->openUrlInNewTab(),
            ])

            // ── Middleware ────────────────────────────────────────────
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);

        // ── اللوجو الديناميكي ─────────────────────────────────────────
        // يُطبَّق فقط إذا كان اللوجو مرفوعاً من صفحة الإعدادات
        if ($logoPath) {
            $panelBuilder->brandLogo(fn () => view('filament.brand-logo', [
                'logoUrl' => \Storage::disk('public')->url($logoPath),
                'appName' => $appName,
            ]));
        }

        return $panelBuilder;
    }

    /**
     * يقرأ إعداداً من قاعدة البيانات بشكل آمن.
     * يتجنب الأخطاء إذا لم يكن الجدول موجوداً بعد (أثناء التثبيت).
     */
    private function getSettingsSafely(string $key, mixed $default = null): mixed
    {
        try {
            if (!Schema::hasTable('app_settings')) {
                return $default;
            }
            return AppSetting::get($key, $default);
        } catch (\Exception $e) {
            return $default;
        }
    }
}
