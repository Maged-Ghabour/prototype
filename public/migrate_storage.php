<?php
/**
 * سكربت الحل النهائي الجذري لمشكلة 403 Forbidden للصور على Hostinger.
 * يعمل هذا السكربت على نقل جميع الصور إلى مجلد حقيقي (بدون استخدام الرابط الرمزي Symlink)
 * مما يضمن عرضها بشكل سليم دائماً.
 */

echo "<html dir='rtl'><head><meta charset='UTF-8'><style>body{font-family:Arial;padding:20px;direction:rtl;line-height:1.6;} .ok{color:green;font-weight:bold;} .info{color:blue;}</style></head><body>";
echo "<h2>🚀 الحل النهائي لمشكلة الصور على Hostinger</h2>";

$publicStorage = __DIR__ . '/storage';
$laravelStorage = __DIR__ . '/../storage/app/public';

// 1. حذف الرابط الرمزي إذا كان موجوداً
if (is_link($publicStorage)) {
    unlink($publicStorage);
    echo "<p class='info'>🔄 تم حذف الرابط الرمزي القديم.</p>";
}

// 2. إنشاء المجلد الحقيقي
if (!is_dir($publicStorage)) {
    mkdir($publicStorage, 0755, true);
    echo "<p class='info'>📁 تم إنشاء مجلد storage الحقيقي.</p>";
}

// دالة لنسخ المجلدات بمحتوياتها
function copyDirectory($src, $dst) {
    if (!is_dir($src)) return;
    $dir = opendir($src);
    @mkdir($dst, 0755, true);
    while (false !== ($file = readdir($dir))) {
        if (($file != '.') && ($file != '..')) {
            if (is_dir($src . '/' . $file)) {
                copyDirectory($src . '/' . $file, $dst . '/' . $file);
            } else {
                copy($src . '/' . $file, $dst . '/' . $file);
                chmod($dst . '/' . $file, 0644); // إعطاء تصريح آمن
            }
        }
    }
    closedir($dir);
}

// 3. نسخ الصور من storage/app/public
if (is_dir($laravelStorage)) {
    copyDirectory($laravelStorage, $publicStorage);
    echo "<p class='ok'>✅ تم نسخ الصور من مجلد التخزين الداخلي إلى المجلد العام بنجاح.</p>";
}

// 4. استرجاع الصور من النسخ الاحتياطية (لو تم عمل backup من السكربت السابق)
$filesInDir = scandir(__DIR__);
foreach ($filesInDir as $folder) {
    if (strpos($folder, 'storage_backup_') === 0 && is_dir(__DIR__ . '/' . $folder)) {
        copyDirectory(__DIR__ . '/' . $folder, $publicStorage);
        echo "<p class='info'>📦 تم استرجاع الصور من مجلد النسخة الاحتياطية: $folder</p>";
    }
}

// 5. ضبط التصاريح النهائية للمجلد
$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($publicStorage, RecursiveDirectoryIterator::SKIP_DOTS),
    RecursiveIteratorIterator::SELF_FIRST
);

foreach ($iterator as $item) {
    if ($item->isDir()) {
        chmod($item->getRealPath(), 0755);
    } else {
        chmod($item->getRealPath(), 0644);
    }
}

echo "<p class='ok'>🎉 تم الانتهاء بنجاح! جميع الصور الآن داخل مجلد حقيقي ولها تصاريح (644/755) السليمة.</p>";
echo "<hr><p>جرب الآن تحديث صفحة النماذج وستجد أن الصور تظهر بشكل ممتاز.<br><b>(يرجى حذف ملف migrate_storage.php بعد نجاح العملية).</b></p>";
echo "</body></html>";
