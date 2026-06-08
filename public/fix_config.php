<?php
/**
 * أداة الطوارئ النهائية: ضبط الروابط وإعدادات التخزين على الاستضافة المشتركة
 * تقوم بتعديل config/filesystems.php وإصلاح الروابط برمجياً.
 */

$configFile = __DIR__ . '/../config/filesystems.php';

echo "<html dir='rtl'><head><meta charset='UTF-8'><style>body{font-family:Arial;padding:30px;direction:rtl;line-height:1.8;} .box{background:#fff;border-radius:10px;padding:20px;box-shadow:0 0 10px #ccc;} .ok{color:green;font-weight:bold;} .err{color:red;font-weight:bold;}</style></head><body><div class='box'>";
echo "<h2>🛠 أداة الإصلاح التلقائي لإعدادات الملفات</h2>";

if (!file_exists($configFile)) {
    die("<p class='err'>❌ لم يتم العثور على ملف filesystems.php في المسار المتوقع.</p>");
}

$content = file_get_contents($configFile);

// البحث عن إعدادات الـ public disk
// سنقوم بتغيير 'url' ليصبح مرتبط بـ public/storage ليتوافق مع رابط استضافتك
if (strpos($content, "'url' => env('APP_URL').'/storage'") !== false || strpos($content, "'url' => env('APP_URL').'/public/storage'") === false) {
    
    // استبدال كود الـ url
    $content = preg_replace(
        "/'url'\s*=>\s*env\('APP_URL'\)\.'\/storage'/",
        "'url' => rtrim(env('APP_URL', 'http://localhost'), '/').'/public/storage'",
        $content
    );
    
    // أو إذا كان بصيغة مختلفة
    $content = preg_replace(
        "/'url'\s*=>\s*rtrim\(env\('APP_URL', 'http:\/\/localhost'\), '\/'\)\.'\/storage'/",
        "'url' => rtrim(env('APP_URL', 'http://localhost'), '/').'/public/storage'",
        $content
    );

    // تغيير مسار الحفظ (root)
    $content = preg_replace(
        "/'root'\s*=>\s*storage_path\('app\/public'\)/",
        "'root' => public_path('storage')",
        $content
    );
    
    // حفظ الملف
    file_put_contents($configFile, $content);
    echo "<p class='ok'>✅ تم تعديل ملف الإعدادات config/filesystems.php بنجاح.</p>";
} else {
    echo "<p class='ok'>✅ ملف الإعدادات معدل مسبقاً.</p>";
}

// إنشاء المجلد الحقيقي
$publicStorage = __DIR__ . '/storage';
if (is_link($publicStorage)) {
    unlink($publicStorage);
    echo "<p class='ok'>✅ تم حذف الرابط الرمزي.</p>";
}
if (!is_dir($publicStorage)) {
    mkdir($publicStorage, 0755, true);
    echo "<p class='ok'>✅ تم إنشاء المجلد الحقيقي للصور.</p>";
}

// مسح الـ Cache
$bootstrapCacheConfig = __DIR__ . '/../bootstrap/cache/config.php';
if (file_exists($bootstrapCacheConfig)) {
    unlink($bootstrapCacheConfig);
    echo "<p class='ok'>✅ تم مسح ذاكرة التخزين المؤقت للإعدادات (Cache).</p>";
}

echo "<hr><p><b>الآن كل شيء مضبوط!</b> قم بالعودة للوحة التحكم وارفع صورة جديدة لتجربتها.</p>";
echo "</div></body></html>";
