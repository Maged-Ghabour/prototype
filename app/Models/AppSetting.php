<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

/**
 * AppSetting Model
 *
 * نموذج بسيط لإدارة إعدادات التطبيق كأزواج key-value.
 * يدعم التخزين المؤقت (Cache) لتسريع القراءة.
 *
 * الاستخدام:
 *   AppSetting::get('app_name', 'مدير النماذج')
 *   AppSetting::set('app_name', 'اسم جديد')
 */
class AppSetting extends Model
{
    protected $table = 'app_settings';

    protected $fillable = ['key', 'value'];

    /**
     * اقرأ قيمة إعداد بمفتاح معين.
     *
     * @param  string $key      مفتاح الإعداد
     * @param  mixed  $default  قيمة افتراضية إذا لم يوجد الإعداد
     * @return mixed
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        return Cache::remember("setting_{$key}", 3600, function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }

    /**
     * اكتب قيمة إعداد (إنشاء أو تحديث).
     *
     * @param  string $key
     * @param  mixed  $value
     * @return void
     */
    public static function set(string $key, mixed $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);

        // مسح التخزين المؤقت عند التحديث
        Cache::forget("setting_{$key}");
    }
}
