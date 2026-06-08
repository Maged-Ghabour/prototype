<?php
/**
 * سكربت لحل مشكلة 403 Forbidden للصور على Hostinger
 * هذا السكربت يقوم بتصحيح تصاريح (Permissions) المجلدات والملفات داخل storage/app/public
 */

$targetDir = __DIR__ . '/../storage/app/public';

echo "<html dir='rtl'><head><meta charset='UTF-8'><style>body{font-family:Arial;padding:20px;direction:rtl;} .ok{color:green;} .err{color:red;}</style></head><body>";
echo "<h2>🛠 أداة إصلاح تصاريح الصور (403 Forbidden)</h2>";

if (!is_dir($targetDir)) {
    echo "<p class='err'>❌ مجلد التخزين غير موجود: $targetDir</p>";
    exit;
}

$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($targetDir, RecursiveDirectoryIterator::SKIP_DOTS),
    RecursiveIteratorIterator::SELF_FIRST
);

$fixedDirs = 0;
$fixedFiles = 0;

foreach ($iterator as $item) {
    if ($item->isDir()) {
        chmod($item->getRealPath(), 0755);
        $fixedDirs++;
    } else {
        chmod($item->getRealPath(), 0644);
        $fixedFiles++;
    }
}

// تصحيح المجلد الرئيسي أيضاً
chmod($targetDir, 0755);

echo "<p class='ok'>✅ تم تصحيح التصاريح بنجاح!</p>";
echo "<ul>";
echo "<li>تم فحص وتعديل <b>$fixedDirs</b> مجلد إلى (755).</li>";
echo "<li>تم فحص وتعديل <b>$fixedFiles</b> ملف إلى (644).</li>";
echo "</ul>";

echo "<h3>🔗 التأكد من الرابط الرمزي (Symlink):</h3>";
$link = __DIR__ . '/storage';
if (is_link($link)) {
    echo "<p class='ok'>✅ الرابط الرمزي (public/storage) موجود بالفعل.</p>";
} elseif (file_exists($link)) {
    echo "<p class='err'>⚠️ يوجد مجلد حقيقي باسم storage داخل مجلد public بدلاً من الرابط الرمزي! يجب حذفه وإنشاء الرابط.</p>";
} else {
    if (symlink($targetDir, $link)) {
         echo "<p class='ok'>✅ تم إنشاء الرابط الرمزي بنجاح الآن.</p>";
    } else {
         echo "<p class='err'>❌ تعذر إنشاء الرابط الرمزي، جرب استخدام php artisan storage:link</p>";
    }
}

echo "<hr><p>جرب الآن تحديث صفحة الصور. <b>يرجى حذف هذا الملف (fix_images.php) بعد الانتهاء لأسباب أمنية.</b></p>";
echo "</body></html>";
