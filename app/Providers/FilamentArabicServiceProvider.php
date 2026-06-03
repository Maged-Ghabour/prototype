<?php

namespace App\Providers;

use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\ServiceProvider;

/**
 * FilamentArabicServiceProvider
 *
 * يُضيف دعم RTL لواجهة Filament عند تعيين اللغة العربية.
 * يُحقن CSS مخصص يُجبر الاتجاه RTL على جميع عناصر اللوحة.
 */
class FilamentArabicServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // تطبيق RTL فقط عندما تكون اللغة عربية
        if (in_array(app()->getLocale(), ['ar', 'he', 'fa', 'ur'])) {
            $this->applyRtlStyles();
        }
    }

    /**
     * تطبيق اتجاه RTL عبر إضافة attribute على html element
     */
    private function applyRtlStyles(): void
    {
        // إضافة CSS مخصص لـ RTL
        FilamentAsset::register([
            Css::make('rtl-overrides', __DIR__ . '/../../public/css/filament-rtl.css'),
        ]);
    }
}
