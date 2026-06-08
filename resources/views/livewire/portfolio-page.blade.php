<div>
    <!-- Hero Section -->
    <div class="bg-primary-900 py-16 sm:py-24">
        <div class="mx-auto max-w-7xl px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl" style="font-family: 'Cairo', sans-serif;">معرض الأعمال</h1>
            <p class="mt-6 text-lg leading-8 text-primary-200">استكشف دراسات الحالة والنماذج التجريبية التي قمنا بتطويرها لعملائنا.</p>
        </div>
    </div>

    <!-- Filters Section -->
    <div class="mx-auto max-w-7xl px-6 lg:px-8 py-8">
        <div class="flex flex-col md:flex-row gap-4 justify-between items-center bg-white p-4 rounded-xl shadow-sm border border-gray-100">
            <div class="w-full md:w-1/3">
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="ابحث باسم المشروع أو العميل..." class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
            </div>
            <div class="w-full md:w-1/4">
                <select wire:model.live="industry" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                    <option value="">جميع المجالات</option>
                    @foreach($industries as $ind)
                        <option value="{{ $ind }}">{{ $ind }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <!-- Case Studies Grid -->
    <div class="mx-auto max-w-7xl px-6 lg:px-8 pb-24">
        @if($caseStudies->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($caseStudies as $caseStudy)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-shadow duration-300 flex flex-col">
                        <div class="aspect-w-16 aspect-h-9 w-full bg-gray-100">
                            @if($caseStudy->featured_image)
                                <img src="{{ asset('uploads/' . $caseStudy->featured_image) }}" alt="{{ $caseStudy->project_name }}" class="object-cover w-full h-48">
                            @else
                                <div class="w-full h-48 flex items-center justify-center text-gray-400 bg-gray-50">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-medium px-2.5 py-0.5 rounded bg-primary-100 text-primary-800">{{ $caseStudy->industry ?? 'عام' }}</span>
                                <span class="text-sm text-gray-500">{{ $caseStudy->client_name }}</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $caseStudy->project_name }}</h3>
                            <p class="text-gray-600 line-clamp-3 mb-4 flex-grow">{{ $caseStudy->short_description }}</p>
                            <a href="{{ route('case-study.show', $caseStudy->slug) }}" class="mt-auto inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 w-full transition-colors">
                                عرض التفاصيل
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="mt-12">
                {{ $caseStudies->links() }}
            </div>
        @else
            <div class="text-center py-24 bg-white rounded-2xl border border-gray-100 border-dashed">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                </svg>
                <h3 class="mt-2 text-sm font-semibold text-gray-900">لا توجد دراسات حالة</h3>
                <p class="mt-1 text-sm text-gray-500">لم يتم العثور على أية مشاريع تطابق بحثك.</p>
                <div class="mt-6">
                    <button wire:click="$set('search', '')" type="button" class="inline-flex items-center rounded-md bg-primary-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600">
                        مسح البحث
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>
