{{--
    filament/brand-logo.blade.php
    يُعرض في شريط التنقل العلوي ويحتوي على اللوجو والاسم.
--}}
<div class="flex items-center gap-2" style="font-family: 'Cairo', sans-serif;">
    <img
        src="{{ $logoUrl }}"
        alt="{{ $appName }}"
        style="height: 36px; width: auto; object-fit: contain;"
    >
    <span style="font-weight: 700; font-size: 1rem;">{{ $appName }}</span>
</div>
