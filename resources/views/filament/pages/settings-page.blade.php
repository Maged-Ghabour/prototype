<x-filament-panels::page>

    {{-- عرض اللوجو الحالي إذا كان موجوداً --}}
    @php
        $logoPath = \App\Models\AppSetting::get('logo_path');
    @endphp

    @if ($logoPath)
        <div class="mb-4 flex justify-end">
            <div class="p-3 bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700 inline-block">
                <p class="text-xs text-gray-500 mb-2 text-right">اللوجو الحالي:</p>
                    <img
                        src="{{ Storage::disk('public')->url($logoPath) }}"
                        alt="لوجو التطبيق"
                        class="h-16 max-w-[150px] object-contain"
                    >
            </div>
        </div>
    @endif

    {{-- فورم الإعدادات --}}
    <form wire:submit="save">
        {{ $this->form }}

        <div class="flex justify-start gap-3 mt-6">
            <x-filament::button
                type="submit"
                icon="heroicon-o-check"
                size="lg"
            >
                حفظ الإعدادات
            </x-filament::button>
        </div>
    </form>

</x-filament-panels::page>
