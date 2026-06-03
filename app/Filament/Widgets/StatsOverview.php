<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Prototype;
use App\Models\Tag;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    /**
     * تحديث البيانات كل 15 ثانية تلقائياً
     */
    protected ?string $pollingInterval = '15s';

    protected function getStats(): array
    {
        $totalPrototypes = Prototype::count();
        $publishedCaseStudies = \App\Models\CaseStudy::where('is_published', true)->count();
        
        $draftPrototypes = Prototype::where('status', \App\Enums\PrototypeStatus::Draft)->count();
        $approvedPrototypes = Prototype::where('status', \App\Enums\PrototypeStatus::Approved)->count();

        return [
            Stat::make('إجمالي النماذج', $totalPrototypes)
                ->description('إجمالي النماذج التجريبية المسجلة')
                ->descriptionIcon('heroicon-m-code-bracket-square')
                ->color('primary')
                ->chart([7, 2, 10, 3, 15, 4, 17]),

            Stat::make('دراسات الحالة المنشورة', $publishedCaseStudies)
                ->description('دراسات الحالة المتاحة للجمهور')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('success'),

            Stat::make('نماذج قيد المسودة', $draftPrototypes)
                ->description('نماذج لم يتم نشرها بعد')
                ->descriptionIcon('heroicon-m-pencil-square')
                ->color('gray'),

            Stat::make('نماذج معتمدة', $approvedPrototypes)
                ->description('نماذج جاهزة للتسليم')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success'),
        ];
    }
}
