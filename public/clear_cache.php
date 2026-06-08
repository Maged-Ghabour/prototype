<?php
/**
 * أداة طوارئ: مسح الـ Cache على الاستضافة المشتركة
 * ⚠️ احذف هذا الملف فور الانتهاء منه
 *
 * الاستخدام: افتح https://yourdomain.com/clear_cache.php?key=fkretk_setup_2026
 */

$secret   = 'fkretk_setup_2026';
$provided = $_GET['key'] ?? '';

if ($provided !== $secret) {
    http_response_code(403);
    die('403 Forbidden.');
}

$basePath      = dirname(__DIR__);
$bootstrapCache = $basePath . '/bootstrap/cache';
$storagePaths  = [
    $basePath . '/storage/framework/cache/data',
    $basePath . '/storage/framework/sessions',
    $basePath . '/storage/framework/views',
];

$results = [];

// ── 1. مسح bootstrap/cache (config, routes, services, packages) ──
$cacheFiles = ['config.php', 'routes.php', 'routes-v7.php',
               'services.php', 'packages.php', 'events.php'];

foreach ($cacheFiles as $file) {
    $path = $bootstrapCache . '/' . $file;
    if (file_exists($path)) {
        unlink($path);
        $results[] = ['✅', "تم حذف: bootstrap/cache/{$file}"];
    } else {
        $results[] = ['ℹ️', "غير موجود: bootstrap/cache/{$file}"];
    }
}

// ── 2. مسح storage/framework/cache ──
foreach ($storagePaths as $dir) {
    if (is_dir($dir)) {
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::CHILD_FIRST
        );
        $count = 0;
        foreach ($files as $file) {
            if ($file->isFile() && $file->getFilename() !== '.gitignore') {
                unlink($file->getPathname());
                $count++;
            }
        }
        $shortPath = str_replace($basePath, '', $dir);
        $results[] = ['✅', "تم مسح {$count} ملف من: {$shortPath}"];
    }
}

// ── 3. تحقق من ملف .env ──
$envFile = $basePath . '/.env';
$envExists = file_exists($envFile);
$appEnv = 'غير معروف';
$appDebug = 'غير معروف';
$appKey = 'غير معروف';

if ($envExists) {
    $envContent = file_get_contents($envFile);
    preg_match('/^APP_ENV=(.+)$/m',   $envContent, $m1); $appEnv   = $m1[1] ?? '—';
    preg_match('/^APP_DEBUG=(.+)$/m', $envContent, $m2); $appDebug = $m2[1] ?? '—';
    preg_match('/^APP_KEY=(.+)$/m',   $envContent, $m3); $appKey   = empty($m3[1]) ? '❌ فارغ!' : '✅ موجود';
}

// ── 4. تحقق من صلاحيات المجلدات ──
$permChecks = [
    $basePath . '/storage'           => '755/775',
    $basePath . '/bootstrap/cache'   => '755/775',
    $basePath . '/storage/logs'      => '755/775',
];

?>
<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>مسح الـ Cache — فكرتك</title>
<style>
  body{font-family:Arial,sans-serif;background:#f0f4f8;padding:30px;direction:rtl;}
  .box{background:#fff;border-radius:14px;padding:28px;max-width:680px;margin:auto;box-shadow:0 4px 24px #0001;}
  h2{color:#1B3F72;margin-bottom:6px;}
  .sub{color:#7A8FA8;font-size:13px;margin-bottom:24px;}
  table{width:100%;border-collapse:collapse;margin:16px 0;}
  th{background:#f6f8fc;color:#334869;font-size:12px;padding:10px 14px;text-align:right;border-bottom:2px solid #DDE5F0;}
  td{padding:9px 14px;font-size:13px;border-bottom:1px solid #f0f4f8;}
  .ok{color:#16a34a;} .err{color:#dc2626;font-weight:600;} .info{color:#2563eb;}
  .env-box{background:#f6f8fc;border:1px solid #DDE5F0;border-radius:10px;padding:16px;margin:16px 0;}
  .env-row{display:flex;justify-content:space-between;padding:6px 0;border-bottom:1px solid #eef2f8;font-size:13px;}
  .env-row:last-child{border-bottom:none;}
  .env-key{color:#334869;font-weight:600;}
  .env-val{font-family:monospace;color:#F26522;}
  .warn{background:#FEF2EA;border:1px solid #FDDEC8;border-radius:10px;padding:14px 18px;color:#92400e;font-size:13px;margin:16px 0;line-height:1.8;}
  .next-steps{background:#EBF2FB;border:1px solid #C8D6EA;border-radius:10px;padding:16px 18px;margin:16px 0;}
  .next-steps h3{color:#1B3F72;margin:0 0 10px;}
  .next-steps li{font-size:13px;color:#334869;margin-bottom:6px;line-height:1.7;}
  .badge{display:inline-block;padding:2px 10px;border-radius:20px;font-size:11px;font-weight:700;}
  .badge-prod{background:#fef2ea;color:#c2410c;}
  .badge-local{background:#ebf2fb;color:#1d4ed8;}
  .del-warn{background:#fef2f2;border:1px solid #fca5a5;border-radius:10px;padding:12px 16px;color:#991b1b;font-size:12px;margin-top:20px;}
</style>
</head>
<body>
<div class="box">
  <h2>🧹 مسح الـ Cache</h2>
  <p class="sub">تم مسح جميع ملفات الـ Cache والتخزين المؤقت</p>

  <table>
    <tr><th>الحالة</th><th>الملف / المجلد</th></tr>
    <?php foreach ($results as [$icon, $msg]): ?>
    <tr><td><?= $icon ?></td><td><?= htmlspecialchars($msg) ?></td></tr>
    <?php endforeach; ?>
  </table>

  <div class="env-box">
    <strong>📋 إعدادات .env الحالية:</strong>
    <div class="env-row">
      <span class="env-key">APP_ENV</span>
      <span class="env-val">
        <?= htmlspecialchars($appEnv) ?>
        <span class="badge <?= $appEnv === 'production' ? 'badge-prod' : 'badge-local' ?>">
          <?= $appEnv === 'production' ? 'Production' : 'Local' ?>
        </span>
      </span>
    </div>
    <div class="env-row">
      <span class="env-key">APP_DEBUG</span>
      <span class="env-val <?= $appDebug === 'true' && $appEnv === 'production' ? 'err' : '' ?>">
        <?= htmlspecialchars($appDebug) ?>
        <?php if ($appDebug === 'true' && $appEnv === 'production'): ?>
          ⚠️ يجب أن يكون false في production
        <?php endif; ?>
      </span>
    </div>
    <div class="env-row">
      <span class="env-key">APP_KEY</span>
      <span class="env-val"><?= $appKey ?></span>
    </div>
  </div>

  <?php if ($appEnv === 'production' && $appDebug === 'true'): ?>
  <div class="warn">
    ⚠️ <strong>تحذير:</strong> أنت في وضع production لكن <code>APP_DEBUG=true</code>.<br>
    هذا يعرض معلومات حساسة للزوار. غيّره إلى <code>APP_DEBUG=false</code> في ملف .env
  </div>
  <?php endif; ?>

  <?php if ($appKey === '❌ فارغ!'): ?>
  <div class="warn">
    ❌ <strong>APP_KEY فارغ!</strong> هذا سبب رئيسي للـ 403.<br>
    شغّل: <code>php artisan key:generate</code> أو أضف مفتاح يدوياً.
  </div>
  <?php endif; ?>

  <div class="next-steps">
    <h3>📋 الخطوات التالية للتأكد من عمل الموقع:</h3>
    <ol>
      <li>✅ تم مسح الـ Cache — أعد تحميل الموقع الآن</li>
      <li>تأكد أن <code>APP_KEY</code> موجود في .env</li>
      <li>في production: <code>APP_DEBUG=false</code></li>
      <li>تأكد من صلاحيات المجلدات: <code>storage/</code> و <code>bootstrap/cache/</code> = 755</li>
      <li>تأكد أن <code>APP_URL</code> يساوي رابط موقعك الفعلي</li>
      <li><strong>احذف هذا الملف فوراً بعد الانتهاء!</strong></li>
    </ol>
  </div>

  <div class="del-warn">
    🗑️ <strong>مهم جداً:</strong> احذف ملف <code>clear_cache.php</code> من الاستضافة فور الانتهاء منه.
  </div>
</div>
</body>
</html>
