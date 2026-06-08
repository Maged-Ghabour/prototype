<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // ── Force Public Disk to /uploads (Bypassing config cache & Apache storage folder) ──
        config([
            'filesystems.disks.public.root' => public_path('uploads'),
            'filesystems.disks.public.url' => url('uploads'),
        ]);

        \Illuminate\Support\Facades\View::composer('layouts.public', function ($view) {
            $view->with('categories', \App\Models\Category::orderBy('sort_order')->get());
        });
    }
}
