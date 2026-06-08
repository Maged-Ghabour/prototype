<?php
/**
 * أداة طوارئ: إنشاء رابط storage على الاستضافة المشتركة
 * ⚠️ احذف هذا الملف فور الانتهاء من استخدامه
 *
 * الاستخدام: افتح المتصفح على https://yourdomain.com/create_storage_link.php
 */

// ── حماية بسيطة: مفتاح سري ──────────────────────────
$secret = 'fkretk_setup_2026'; // غيّر هذا المفتاح
$provided = $_GET['key'] ?? '';

if ($provided !== $secret) {
    http_response_code(403);
    die('403 Forbidden. Add ?key=YOUR_SECRET to the URL.');
}

// ── المسارات ─────────────────────────────────────────
$target = __DIR__ . '/../storage/app/public';  // المجلد الحقيقي
$link   = __DIR__ . '/storage';                // الرابط الرمزي

echo '<html dir="rtl"><head><meta charset="UTF-8">
<style>body{font-family:Arial;padding:40px;direction:rtl;background:#f5f5f5;}
.box{background:#fff;border-radius:12px;padding:30px;max-width:600px;margin:auto;box-shadow:0 2px 16px #0001;}
.ok{color:#16a34a;font-weight:bold;} .err{color:#dc2626;font-weight:bold;} .info{color:#2563eb;}
pre{background:#1e1e2e;color:#cdd6f4;padding:16px;border-radius:8px;font-size:13px;}
</style></head><body><div class="box">
<h2>🔧 إعداد Storage Link</h2>';

// ── تحقق من الوضع الحالي ──────────────────────────────
if (is_link($link)) {
    echo '<p class="ok">✅ الرابط موجود بالفعل! المسار: <code>' . $link . '</code></p>';
    echo '<p>جرب فتح: <a href="/storage/" target="_blank">/storage/</a></p>';
} elseif (file_exists($link)) {
    echo '<p class="err">⚠️ يوجد مجلد باسم <code>storage</code> بدلاً من رابط رمزي.</p>';
    echo '<p>احذفه يدوياً من File Manager ثم أعد تحميل الصفحة.</p>';
} else {
    // ── إنشاء الرابط الرمزي ──────────────────────────
    if (!is_dir($target)) {
        mkdir($target, 0755, true);
        echo '<p class="info">📁 تم إنشاء مجلد: ' . $target . '</p>';
    }

    $result = symlink($target, $link);

    if ($result) {
        echo '<p class="ok">✅ تم إنشاء رابط storage بنجاح!</p>';
        echo '<pre>Link : ' . $link . '
Target: ' . $target . '</pre>';
        echo '<p>الآن يمكن رؤية الصور المرفوعة عبر: <code>/storage/logos/...</code></p>';
    } else {
        echo '<p class="err">❌ فشل إنشاء الرابط. جرب الطريقة اليدوية أدناه.</p>';
        
        echo '<h3>📋 الطريقة اليدوية (File Manager)</h3>
<p>1. افتح File Manager في Hostinger<br>
2. اذهب إلى مجلد <code>public_html</code><br>
3. أنشئ مجلد جديد باسم <code>storage</code><br>
4. هذا المجلد يجب أن يشير إلى: <code>' . $target . '</code><br>
5. أو استخدم SSH: <code>php artisan storage:link</code></p>';
    }
}

// ── فحص الصور الموجودة ────────────────────────────────
$logosDir = $target . '/logos';
echo '<h3>📸 الصور الموجودة في logos:</h3>';
if (is_dir($logosDir)) {
    $files = scandir($logosDir);
    $files = array_filter($files, fn($f) => !in_array($f, ['.', '..']));
    if ($files) {
        echo '<ul>';
        foreach ($files as $f) {
            echo '<li>' . htmlspecialchars($f) . ' — <a href="/storage/logos/' . urlencode($f) . '" target="_blank">معاينة</a></li>';
        }
        echo '</ul>';
    } else {
        echo '<p class="info">المجلد فارغ. ارفع اللوجو من لوحة الإعدادات.</p>';
    }
} else {
    echo '<p class="info">مجلد logos غير موجود بعد. ارفع صورة من لوحة التحكم لإنشائه.</p>';
}

echo '<hr><p style="color:#888;font-size:12px;">⚠️ <strong>مهم:</strong> احذف هذا الملف فور الانتهاء من استخدامه لأسباب أمنية.</p>';
echo '</div></body></html>';
