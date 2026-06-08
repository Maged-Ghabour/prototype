<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarketingServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => 'إدارة الحملات الإعلانية',
                'description' => 'TikTok · Meta · Snapchat · Google Ads بأعلى ROAS ممكن',
                'icon_svg' => '<path d="M22 12h-4l-3 9L9 3l-3 9H2"/>',
                'color_theme' => 'or',
                'sort_order' => 1,
            ],
            [
                'title' => 'تحسين محركات البحث SEO',
                'description' => 'تصدّر جوجل بنتائج طبيعية 100% بلا إعلانات مدفوعة',
                'icon_svg' => '<circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/><path d="M11 8v3l2 2"/>',
                'color_theme' => 'bl',
                'sort_order' => 2,
            ],
            [
                'title' => 'إنشاء المتاجر الإلكترونية',
                'description' => 'سلّة، زد، WooCommerce — متجر يحوّل الزائر لمشترٍ',
                'icon_svg' => '<rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/>',
                'color_theme' => 'or',
                'sort_order' => 3,
            ],
            [
                'title' => 'إدارة السوشيال ميديا',
                'description' => 'محتوى منتظم، تفاعل حقيقي، نمو مستدام لحساباتك',
                'icon_svg' => '<path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>',
                'color_theme' => 'bl',
                'sort_order' => 4,
            ],
            [
                'title' => 'المونتاج والموشن جرافيك',
                'description' => 'فيديوهات تسويقية تحوّل المشاهد إلى عميل',
                'icon_svg' => '<circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/>',
                'color_theme' => 'or',
                'sort_order' => 5,
            ],
            [
                'title' => 'الهوية البصرية والجرافيك',
                'description' => 'هوية بصرية تجعل علامتك لا تُنسى في ذهن العميل',
                'icon_svg' => '<path d="M12 19l7-7 3 3-7 7-3-3z"/><path d="M18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5-5z"/><path d="M2 2l7.586 7.586"/><circle cx="11" cy="11" r="2"/>',
                'color_theme' => 'bl',
                'sort_order' => 6,
            ],
            [
                'title' => 'التسويق عبر المؤثرين',
                'description' => 'وصول مستهدف عبر مؤثرين موثوقين يبنون الثقة بعلامتك',
                'icon_svg' => '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>',
                'color_theme' => 'or',
                'sort_order' => 7,
            ],
            [
                'title' => 'إنشاء تطبيقات الجوال',
                'description' => 'تطبيق متجرك على iOS وAndroid بتجربة مستخدم سلسة',
                'icon_svg' => '<rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><path d="M12 18h.01"/>',
                'color_theme' => 'bl',
                'sort_order' => 8,
            ],
        ];

        foreach ($services as $service) {
            // Attempt to link to category if it exists
            $catId = \App\Models\Category::where('name', 'LIKE', '%' . explode(' ', $service['title'])[0] . '%')
                ->orWhere('name', 'LIKE', '%' . explode(' ', $service['title'])[1] . '%')
                ->first()?->id;

            \App\Models\MarketingService::create([
                'title' => $service['title'],
                'description' => $service['description'],
                'icon_svg' => $service['icon_svg'],
                'color_theme' => $service['color_theme'],
                'category_id' => $catId,
                'sort_order' => $service['sort_order'],
                'is_active' => true,
            ]);
        }
    }
}
