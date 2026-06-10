@extends('layouts.public')

@section('content')
<div class="bg-primary-900 py-16 sm:py-24">
    <div class="mx-auto max-w-7xl px-6 lg:px-8 text-center">
        <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl" style="font-family: 'Cairo', sans-serif;">{{ $category->name }}</h1>
        <p class="mt-6 text-lg leading-8 text-primary-200">{{ $category->description ?? 'تصفح دراسات الحالة لهذا التصنيف.' }}</p>
    </div>
</div>

<div class="mx-auto max-w-7xl px-6 lg:px-8 py-12 pb-24">
    @if($prototypes->count() > 0)
        <div class="cases-grid">
            @foreach($prototypes as $i => $prototype)
                @php
                   $delay = $i * 0.07;
                   $colors = [
                       ['nc' => 'np-or', 'band' => '#F26522'],
                       ['nc' => 'np-bl', 'band' => '#2B5BA8'],
                       ['nc' => 'np-tl', 'band' => '#0A8A7A'],
                       ['nc' => 'np-pu', 'band' => '#6D28D9'],
                   ];
                   $color = $colors[$i % count($colors)];
                @endphp
                <a class="case-card reveal visible" href="{{ $prototype->getPreviewUrl() }}" target="_blank" style="transition-delay:{{ $delay }}s">
                  <div style="height:4px;background:{{ $color['band'] }};"></div>
                  <div class="case-top">
                    <span class="niche-pill {{ $color['nc'] }}">
                      <svg width="9" height="9" viewBox="0 0 8 8" fill="currentColor"><circle cx="4" cy="4" r="4"/></svg>
                      {{ $category->name }}
                    </span>
                    <div class="case-arrow-icon">
                      <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M7 17L17 7M17 7H7M17 7v10"/>
                      </svg>
                    </div>
                  </div>
                  <div class="case-body">
                    <div class="case-avatar-row">
                      <div class="case-avatar" style="background:{{ $color['band'] }}18;border-color:{{ $color['band'] }}33;">
                        @if($prototype->icon)
                          @svg($prototype->icon, '', ['style' => 'width: 24px; height: 24px; color: ' . $color['band']])
                        @else
                          <svg viewBox="0 0 24 24" fill="none" stroke="{{ $color['band'] }}" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                          </svg>
                        @endif
                      </div>
                      <div>
                        <div class="case-client">{{ Str::limit($prototype->title, 25) }}</div>
                        <div class="case-sub">دراسة حالة</div>
                      </div>
                    </div>
                    <div class="case-divider"></div>
                    <div style="font-size:13px; color:var(--muted); line-height:1.6; flex:1; margin-bottom:12px;">
                      {{ $prototype->title }} - تم تطويره باستخدام أحدث التقنيات
                    </div>
                    <div class="stags">
                       <span class="stag">معاينة دراسة الحالة</span>
                    </div>
                  </div>
                </a>
            @endforeach
        </div>
        
        <div class="mt-12">
            {{ $prototypes->links() }}
        </div>
    @else
        <div class="text-center py-24 bg-white rounded-2xl border border-gray-100 border-dashed">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
            </svg>
            <h3 class="mt-2 text-sm font-semibold text-gray-900">لا توجد دراسات حالة</h3>
            <p class="mt-1 text-sm text-gray-500">لا توجد دراسات حالة منشورة في هذا التصنيف حالياً.</p>
        </div>
    @endif
</div>
@endsection
