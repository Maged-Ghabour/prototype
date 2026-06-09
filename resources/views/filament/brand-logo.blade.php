{{--
    filament/brand-logo.blade.php
    يُعرض في شريط التنقل العلوي ويحتوي على اللوجو والاسم.
--}}
<div class="flex items-center" style="font-family: 'Cairo', sans-serif;">
    <img
        src="{{ $logoUrl }}"
        alt="{{ $appName }}"
        style="max-width: 250px; max-height: 60px; width: auto; height: auto; object-fit: contain;"
    >
</div>
