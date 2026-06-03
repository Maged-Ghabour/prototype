<?php

namespace App\Filament\Widgets;

use App\Models\Prototype;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class PrototypesChart extends ChartWidget
{
    protected ?string $heading = 'معدل إضافة النماذج (آخر 7 أيام)';
    protected static ?int $sort = 2; // الظهور تحت الإحصاءات العلوية

    protected function getData(): array
    {
        $data = [];
        $labels = [];

        // جمع البيانات لآخر 7 أيام
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            
            // حساب النماذج المضافة في هذا اليوم
            $count = Prototype::whereDate('created_at', $date)->count();

            $labels[] = $date->translatedFormat('D (d M)'); // مثال: السبت (15 مايو)
            $data[] = $count;
        }

        return [
            'datasets' => [
                [
                    'label' => 'النماذج المضافة',
                    'data' => $data,
                    'borderColor' => '#8b5cf6', // لون Violet ليتماشى مع التطبيق
                    'backgroundColor' => 'rgba(139, 92, 246, 0.1)',
                    'fill' => true,
                    'tension' => 0.3, // لجعل الخط منحنياً قليلاً (Smooth)
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        // نوع الرسم البياني (line, bar, pie, etc.)
        return 'line';
    }
}
