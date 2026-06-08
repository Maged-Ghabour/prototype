<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Http\Kernel')->handle(
    Illuminate\Http\Request::capture()
);

echo "<html dir='rtl'><head><meta charset='UTF-8'></head><body style='font-family:Arial; direction:rtl; padding:20px;'>";
echo "<h2>🔍 أداة تشخيص المسارات</h2>";
echo "<b>public_path():</b> " . public_path() . "<br>";
echo "<b>storage_path():</b> " . storage_path() . "<br>";
echo "<b>base_path():</b> " . base_path() . "<br>";

$uploadsPath = public_path('uploads');
echo "<b>مسار الرفع الفعلي:</b> " . $uploadsPath . "<br>";

if (is_dir($uploadsPath)) {
    echo "<br><b style='color:green;'>✅ المجلد موجود</b><br>";
    $thumbnails = $uploadsPath . '/prototypes/thumbnails';
    if (is_dir($thumbnails)) {
        echo "<b style='color:green;'>✅ مجلد thumbnails موجود. الملفات:</b><ul>";
        $files = scandir($thumbnails);
        foreach($files as $f) {
            if ($f != '.' && $f != '..') echo "<li>$f</li>";
        }
        echo "</ul>";
    } else {
        echo "<b style='color:red;'>❌ مجلد thumbnails غير موجود داخل uploads!</b><br>";
    }
} else {
    echo "<b style='color:red;'>❌ المجلد uploads غير موجود!</b><br>";
}

echo "</body></html>";
