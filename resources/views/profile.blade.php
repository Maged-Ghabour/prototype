@extends('layouts.public')
@section('content')
<!-- ══════════════════════════════════
     ABOUT HERO
══════════════════════════════════ -->
<section class="about">
  <div class="about-grid-bg"></div>
  <div class="about-blob1"></div>
  <div class="about-blob2"></div>

  <div class="about-inner">

    <!-- LEFT -->
    <div>
      <div class="about-badge reveal">
        <span class="badge-pulse"></span>
        وكالة تسويق رقمي متخصصة &nbsp;·&nbsp; جدة، المملكة العربية السعودية
      </div>

      <div class="about-logo-wrap reveal">
        <img src="https://fkretk.com/wp-content/uploads/2026/02/download-1-2.png"
             alt="فكرتك الرقمية" class="about-logo-img"
             onerror="this.style.display='none';document.getElementById('ab-fb').style.display='flex'">
        <div id="ab-fb" class="about-logo-fb">
          <div class="about-logo-icon">ف</div>
          <div>
            <div class="about-logo-name">فكرتك الرقمية</div>
            <div class="about-logo-en2">Fkretk Digital Agency · Jeddah</div>
          </div>
        </div>
      </div>

      <h1 class="about-h1 reveal">
        أفضل شركة<br>
        <span class="c-or">تسويق إلكتروني</span><br>
        في <span class="c-bl">المملكة العربية السعودية</span>
      </h1>

      <p class="about-body reveal">
        فكرتك الرقمية — وكالة تسويق سعودية مقرّها جدة، تفهم التاجر ورائد
        الأعمال السعودي من الداخل. لا نبيع وعوداً فارغة، بل نبني نتائج
        موثّقة بالأرقام والبيانات. من إعلانات الأداء وتصدّر محركات البحث
        إلى إنشاء المتاجر والهويات البصرية — نحوّل ميزانيتك التسويقية
        إلى مبيعات حقيقية وعلامة راسخة في ذهن عميلك.
      </p>

      <div class="about-stats reveal">
        <div class="stat-item">
          <div class="stat-num">+50</div>
          <div class="stat-lbl">عميل ناجح</div>
        </div>
        <div class="stat-divider"></div>
        <div class="stat-item">
          <div class="stat-num">×55</div>
          <div class="stat-lbl">أعلى ROAS حققناه</div>
        </div>
        <div class="stat-divider"></div>
        <div class="stat-item">
          <div class="stat-num">+15</div>
          <div class="stat-lbl">قطاع مختلف</div>
        </div>
        <div class="stat-divider"></div>
        <div class="stat-item">
          <div class="stat-num">100%</div>
          <div class="stat-lbl">نتائج موثّقة</div>
        </div>
      </div>
    </div>

    <!-- RIGHT PANEL -->
    <div class="about-panel reveal">
      <div class="panel-label">خدماتنا الأساسية</div>
      <div class="svc-list">

        @foreach($marketingServices->take(6) as $service)
          @php
             $link = $service->category ? route('category.show', $service->category->slug) : '#services';
             $colorClass = $service->color_theme == 'bl' ? 'si-bl' : 'si-or';
             $strokeColor = $service->color_theme == 'bl' ? '#2B5BA8' : '#F26522';
          @endphp
          <a href="{{ $link }}" class="svc-item" style="text-decoration: none; color: inherit;">
            <div class="svc-icon-box {{ $colorClass }}">
              <svg viewBox="0 0 24 24" fill="none" stroke="{{ $strokeColor }}" stroke-width="1.8">
                {!! $service->icon_svg !!}
              </svg>
            </div>
            <span class="svc-name">{{ $service->title }}</span>
          </a>
        @endforeach

      </div>
      <div class="panel-cta">
        <span class="panel-cta-text">جدة · المملكة العربية السعودية</span>
        <a href="https://fkretk.com" target="_blank" class="panel-cta-link">
          الموقع الرسمي
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
      </div>
    </div>

  </div>
</section>

<!-- ══════════════════════════════════
     SERVICES ICONS SECTION
══════════════════════════════════ -->
<section class="svcs-section" id="services">
  <div class="svcs-inner">

    <div class="sec-head reveal">
      <span class="sec-eyebrow">ما نقدّمه لك</span>
      <h2 class="sec-h2">خدماتنا <span>التسويقية</span></h2>
      <p class="sec-body">حلول رقمية متكاملة مصمّمة لتحقيق نمو حقيقي وقابل للقياس</p>
    </div>

    <div class="svcs-grid">

      @foreach($marketingServices as $service)
        @php
           $link = $service->category ? route('category.show', $service->category->slug) : '#services';
           $iconClass = $service->color_theme == 'bl' ? 'icon-bl' : 'icon-or';
           $strokeColor = $service->color_theme == 'bl' ? '#2B5BA8' : '#F26522';
        @endphp
        <a href="{{ $link }}" class="svc-card reveal" style="text-decoration: none; color: inherit; display: block;">
          <div class="svc-card-icon {{ $iconClass }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="{{ $strokeColor }}" stroke-width="1.7">
              {!! $service->icon_svg !!}
            </svg>
          </div>
          <div class="svc-card-name">{{ $service->title }}</div>
          <div class="svc-card-desc">{{ $service->description }}</div>
        </a>
      @endforeach

    </div>
  </div>
</section>

<!-- ══════════════════════════════════
     TICKER
══════════════════════════════════ -->
<div class="ticker-section">
  <div class="ticker-badge">
    <span class="ticker-badge-line1">القطاعات</span>
    <span class="ticker-badge-line2">التي خدمناها</span>
  </div>
  <div class="ticker-fr"></div>
  <div class="ticker-fl"></div>
  <div class="ticker-track" id="tickerTrack"></div>
</div>

<!-- ══════════════════════════════════
     PROTOTYPES
══════════════════════════════════ -->
<section class="cases-section" id="cases">
  <div style="max-width:1200px;margin:0 auto;">

    <div class="sec-head reveal">
      <span class="sec-eyebrow">أعمالنا وإبداعاتنا</span>
      <h2 class="sec-h2">النماذج <span>التجريبية</span></h2>
      <p class="sec-body">استعرض أحدث النماذج التجريبية التي قمنا بتطويرها</p>
    </div>

    <div class="cases-grid" id="casesGrid">
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
        <a class="case-card reveal" href="{{ route('prototype.preview', $prototype->slug) }}" target="_blank" style="transition-delay:{{ $delay }}s">
          <div style="height:4px;background:{{ $color['band'] }};"></div>
          <div class="case-top">
            <span class="niche-pill {{ $color['nc'] }}">
              <svg width="9" height="9" viewBox="0 0 8 8" fill="currentColor"><circle cx="4" cy="4" r="4"/></svg>
              {{ $prototype->categories->first()?->name ?? 'عام' }}
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
                @if($prototype->thumbnail)
                  <img src="{{ asset('storage/' . $prototype->thumbnail) }}" style="width:100%;height:100%;object-fit:cover;border-radius:11px;">
                @elseif($prototype->icon)
                  @svg($prototype->icon, '', ['style' => 'width: 24px; height: 24px; color: ' . $color['band']])
                @else
                  <svg viewBox="0 0 24 24" fill="none" stroke="{{ $color['band'] }}" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                  </svg>
                @endif
              </div>
              <div>
                <div class="case-client">{{ Str::limit($prototype->title, 25) }}</div>
                <div class="case-sub">نموذج تجريبي</div>
              </div>
            </div>
            <div class="case-divider"></div>
            <div style="font-size:13px; color:var(--muted); line-height:1.6; flex:1; margin-bottom:12px;">
              {{ $prototype->title }} - تم تطويره باستخدام أحدث التقنيات
            </div>
            <div class="stags">
               <span class="stag">معاينة النموذج</span>
            </div>
          </div>
        </a>
      @endforeach
    </div>
  </div>
</section>

<script>
/* ─── TICKER SECTORS ─── */
const SECTORS = [
  {name:'متاجر إلكترونية', path:'M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z'},
  {name:'عيادات طبية', path:'M22 12h-4l-3 9L9 3l-3 9H2'},
  {name:'تعليم وكورسات', path:'M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2zM22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z'},
  {name:'تكييف وصيانة', path:'M9.59 4.59A2 2 0 1111 8H2m10.59 11.41A2 2 0 1010 16H2m15.73-8.27A2.5 2.5 0 1119.5 12H2'},
  {name:'مقاولات وبناء', path:'M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z'},
  {name:'تجميل وعناية', path:'M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z'},
  {name:'مطاعم وكافيهات', path:'M18 8h1a4 4 0 010 8h-1M2 8h16v9a4 4 0 01-4 4H6a4 4 0 01-4-4V8zM6 1v3M10 1v3M14 1v3'},
  {name:'سيارات وقطع غيار', path:'M5 17H3a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v9a2 2 0 01-2 2h-3'},
  {name:'عقارات وتأجير', path:'M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z'},
  {name:'أزياء وموضة', path:'M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z'},
  {name:'صيدليات ومكملات', path:'M8 21h12a2 2 0 002-2v-2H10v2a2 2 0 01-2 2zm14-8H2l2-9h16l2 9z'},
  {name:'صحة ولياقة', path:'M22 12h-4l-3 9L9 3l-3 9H2'},
  {name:'خدمات منزلية', path:'M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z'},
  {name:'سفر وسياحة', path:'M12 22s-8-4.5-8-11.8A8 8 0 0112 2a8 8 0 018 8.2c0 7.3-8 11.8-8 11.8z'},
  {name:'تقنية وبرمجيات', path:'M16 18l6-6-6-6M8 6l-6 6 6 6'},
  {name:'إبداع وتصميم', path:'M12 19l7-7 3 3-7 7-3-3zM18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5-5z'},
  {name:'تصوير وإنتاج', path:'M23 19a2 2 0 01-2 2H3a2 2 0 01-2-2V8a2 2 0 012-2h4l2-3h6l2 3h4a2 2 0 012 2z'},
  {name:'خدمات قانونية', path:'M12 22s-8-4.5-8-11.8A8 8 0 0112 2a8 8 0 018 8.2c0 7.3-8 11.8-8 11.8z'},
  {name:'أندية رياضية', path:'M18 20V10M12 20V4M6 20v-6'},
  {name:'فعاليات وترفيه', path:'M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2'},
  {name:'حلويات ومخبوزات', path:'M18 8h1a4 4 0 010 8h-1M2 8h16v9a4 4 0 01-4 4H6a4 4 0 01-4-4V8z'},
  {name:'مستحضرات تجميل', path:'M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z'},
  {name:'مواد البناء', path:'M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z'},
  {name:'الكترونيات', path:'M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18'},
  {name:'استشارات أعمال', path:'M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z'},
];

const track=document.getElementById('tickerTrack');
const all=[...SECTORS,...SECTORS];
track.innerHTML=all.map(s=>`
  <div class="t-item">
    <div class="t-icon">
      <svg viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,.8)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
        <path d="${s.path}"/>
      </svg>
    </div>
    <span class="t-name">${s.name}</span>
    <span class="t-dot"></span>
  </div>`).join('');

/* ─── CASES RENDERED VIA BLADE ─── */

/* ─── MOBILE DRAWER ─── */
const drawer=document.getElementById('mobDrawer');
const panel=document.getElementById('mobPanel');
const overlay=document.getElementById('mobOverlay');

function openDrawer(){
  drawer.style.display='block';
  document.body.style.overflow='hidden';
  setTimeout(()=>panel.classList.add('open'),10);
}

function closeDrawer(){
  panel.classList.remove('open');
  document.body.style.overflow='';
  setTimeout(()=>{ drawer.style.display='none'; },300);
}

document.getElementById('mobToggle').addEventListener('click',openDrawer);
document.getElementById('mobClose').addEventListener('click',closeDrawer);
overlay.addEventListener('click',closeDrawer);

/* ─── SCROLL REVEAL ─── */
const obs=new IntersectionObserver(entries=>{
  entries.forEach(e=>{if(e.isIntersecting){e.target.classList.add('visible');obs.unobserve(e.target);}});
},{threshold:.08});
document.querySelectorAll('.reveal').forEach(el=>obs.observe(el));
</script>
@endsection
