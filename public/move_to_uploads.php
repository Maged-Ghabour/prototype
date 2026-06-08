<?php
/**
 * أداة الطوارئ النهائية: نقل الصور إلى مجلد uploads
 * لتخطي مشكلة حظر Hostinger لمجلد storage تماماً.
 */

echo "<html dir='rtl'><head><meta charset='UTF-8'><style>body{font-family:Arial;padding:30px;direction:rtl;line-height:1.8;} .box{background:#fff;border-radius:10px;padding:20px;box-shadow:0 0 10px #ccc;} .ok{color:green;font-weight:bold;} .info{color:blue;}</style></head><body><div class='box'>";
echo "<h2>🚀 خطوة أخيرة لتشغيل الصور فوراً</h2>";

$uploadsDir = __DIR__ . '/uploads';

// إنشاء مجلد uploads
if (!is_dir($uploadsDir)) {
    mkdir($uploadsDir, 0755, true);
    echo "<p class='ok'>✅ تم إنشاء مجلد uploads.</p>";
}

// دالة النسخ
function copyDirectoryToUploads($src, $dst) {
    if (!is_dir($src)) return;
    $dir = opendir($src);
    @mkdir($dst, 0755, true);
    while (false !== ($file = readdir($dir))) {
        if (($file != '.') && ($file != '..')) {
            if (is_dir($src . '/' . $file)) {
                copyDirectoryToUploads($src . '/' . $file, $dst . '/' . $file);
            } else {
                copy($src . '/' . $file, $dst . '/' . $file);
                chmod($dst . '/' . $file, 0644);
            }
        }
    }
    closedir($dir);
}

// مصادر الصور المحتملة
$sources = [
    __DIR__ . '/../storage/app/public',
    __DIR__ . '/storage',
];

// نسخ من المصادر المختلفة لتأكيد عدم ضياع أي صورة
foreach ($sources as $source) {
    if (is_dir($source)) {
        copyDirectoryToUploads($source, $uploadsDir);
        echo "<p class='info'>📦 تم نسخ الصور من المجلد: " . basename($source) . "</p>";
    }
}

// نسخ من ملفات الباك اب السابقة إن وجدت
$filesInDir = scandir(__DIR__);
foreach ($filesInDir as $folder) {
    if (strpos($folder, 'storage_backup_') === 0 && is_dir(__DIR__ . '/' . $folder)) {
        copyDirectoryToUploads(__DIR__ . '/' . $folder, $uploadsDir);
        echo "<p class='info'>📦 تم استرجاع الصور من مجلد: $folder</p>";
    }
}

echo "<hr><p class='ok'>🎉 تم تجهيز مجلد uploads بنجاح وتم نقل جميع الصور القديمة والجديدة إليه!</p>";
echo "</div></body></html>";
