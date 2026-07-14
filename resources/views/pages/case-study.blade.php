<x-public-layout>
    @php
        function getYoutubeId($url) {
            preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i', $url, $match);
            return isset($match[1]) ? $match[1] : null;
        }
    @endphp

    <!-- Hero Section -->
    <div class="relative bg-gray-900 overflow-hidden">
        @if($caseStudy->featured_image)
            <img src="{{ asset('public/uploads/' . $caseStudy->featured_image) }}" alt="{{ $caseStudy->project_name }}" class="absolute inset-0 w-full h-full object-cover opacity-40">
        @endif
        <div class="relative mx-auto max-w-7xl px-6 py-24 sm:py-32 lg:px-8">
            <div class="flex flex-col gap-4">
                <span class="inline-flex w-fit items-center rounded-full bg-primary-500/10 px-3 py-1 text-sm font-medium text-primary-400 ring-1 ring-inset ring-primary-500/20">
                    {{ $caseStudy->industry ?? 'مجال عام' }}
                </span>
                <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl">{{ $caseStudy->project_name }}</h1>
                <p class="mt-4 max-w-2xl text-xl text-gray-300">العميل: {{ $caseStudy->client_name }}</p>
                @if($caseStudy->prototype)
                    <div class="mt-8">
                        <a href="{{ $caseStudy->prototype->getPreviewUrl() }}" target="_blank" class="rounded-md bg-primary-500 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-primary-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-400 transition-all inline-flex items-center gap-2">
                            <span>عرض النموذج التفاعلي</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Content Sections -->
    <div class="mx-auto max-w-7xl px-6 lg:px-8 py-16">
        @if($caseStudy->short_description)
            <div class="prose prose-lg prose-primary max-w-3xl mb-16 text-gray-600 text-xl leading-relaxed">
                <p>{{ $caseStudy->short_description }}</p>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            
            @if($caseStudy->challenge)
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <div class="flex items-center gap-3 mb-6 border-b border-gray-100 pb-4">
                    <div class="bg-red-100 p-2 rounded-lg text-red-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">التحدي</h2>
                </div>
                <div class="prose prose-sm text-gray-600">
                    {!! $caseStudy->challenge !!}
                </div>
            </div>
            @endif

            @if($caseStudy->solution)
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <div class="flex items-center gap-3 mb-6 border-b border-gray-100 pb-4">
                    <div class="bg-primary-100 p-2 rounded-lg text-primary-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">الحل</h2>
                </div>
                <div class="prose prose-sm text-gray-600">
                    {!! $caseStudy->solution !!}
                </div>
            </div>
            @endif

            @if($caseStudy->results)
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <div class="flex items-center gap-3 mb-6 border-b border-gray-100 pb-4">
                    <div class="bg-green-100 p-2 rounded-lg text-green-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">النتائج</h2>
                </div>
                <div class="prose prose-sm text-gray-600">
                    {!! $caseStudy->results !!}
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Videos Section -->
    @if($caseStudy->youtube_videos && is_array($caseStudy->youtube_videos) && count($caseStudy->youtube_videos) > 0)
    <div class="bg-gray-100 py-16">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-12 text-center">فيديوهات دراسة الحالة</h2>
            <div class="space-y-12">
                @foreach($caseStudy->youtube_videos as $index => $video)
                    @if(isset($video['url']))
                        <div class="relative w-full max-w-5xl mx-auto rounded-3xl overflow-hidden shadow-2xl group bg-black aspect-video border-4 border-gray-900">
                            <!-- YouTube Player Container -->
                            <div id="youtube-player-{{ $index }}" class="w-full h-full pointer-events-none scale-105"></div>
                            
                            <!-- Transparent Overlay Shield -->
                            <div class="absolute inset-0 z-10 cursor-pointer" onclick="togglePlay({{ $index }})">
                                <!-- Play/Pause Button Custom UI -->
                                <div class="absolute inset-0 flex items-center justify-center transition-opacity duration-300" id="play-btn-{{ $index }}">
                                    <div class="w-24 h-24 bg-primary-600/90 rounded-full flex items-center justify-center backdrop-blur-md text-white group-hover:bg-primary-500 group-hover:scale-110 transition-all shadow-2xl border border-white/10">
                                        <svg class="w-12 h-12 ml-2" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                    </div>
                                </div>
                                
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 transition-opacity duration-300 bg-black/20" id="pause-btn-{{ $index }}">
                                    <div class="w-24 h-24 bg-black/60 rounded-full flex items-center justify-center backdrop-blur-md text-white hover:bg-black/80 transition-all shadow-2xl border border-white/10">
                                        <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- Gallery -->
    @if($caseStudy->gallery_images && is_array($caseStudy->gallery_images) && count($caseStudy->gallery_images) > 0)
    <div class="bg-gray-50 py-16">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">معرض الصور</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($caseStudy->gallery_images as $image)
                    <div class="overflow-hidden rounded-xl shadow-sm hover:shadow-md transition-shadow">
                        <img src="{{ asset('public/uploads/' . $image) }}" alt="Gallery Image" class="w-full h-64 object-cover hover:scale-105 transition-transform duration-500">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- YouTube IFrame API Script -->
    @if($caseStudy->youtube_videos && is_array($caseStudy->youtube_videos) && count($caseStudy->youtube_videos) > 0)
    <script src="https://www.youtube.com/iframe_api"></script>
    <script>
        var players = [];
        var videoIds = [];
        
        @foreach($caseStudy->youtube_videos as $index => $video)
            @if(isset($video['url']))
                @php $vidId = getYoutubeId($video['url']); @endphp
                @if($vidId)
                    videoIds[{{ $index }}] = '{{ $vidId }}';
                @endif
            @endif
        @endforeach

        function onYouTubeIframeAPIReady() {
            videoIds.forEach(function(vidId, index) {
                if (vidId) {
                    players[index] = new YT.Player('youtube-player-' + index, {
                        videoId: vidId,
                        playerVars: {
                            'playsinline': 1,
                            'controls': 0,
                            'rel': 0,
                            'modestbranding': 1,
                            'disablekb': 1,
                            'fs': 0,
                            'iv_load_policy': 3,
                            'showinfo': 0
                        },
                        events: {
                            'onStateChange': function(event) {
                                onPlayerStateChange(event, index);
                            }
                        }
                    });
                }
            });
        }

        function togglePlay(index) {
            if (players[index] && typeof players[index].getPlayerState === 'function') {
                var state = players[index].getPlayerState();
                if (state === YT.PlayerState.PLAYING) {
                    players[index].pauseVideo();
                } else {
                    players[index].playVideo();
                }
            }
        }

        function onPlayerStateChange(event, index) {
            var playBtn = document.getElementById('play-btn-' + index);
            var pauseBtn = document.getElementById('pause-btn-' + index);
            var container = playBtn.parentElement;
            
            if (event.data == YT.PlayerState.PLAYING) {
                playBtn.style.opacity = '0';
                pauseBtn.style.opacity = '0';
                
                container.onmouseenter = function() {
                    if(players[index].getPlayerState() === YT.PlayerState.PLAYING) {
                        pauseBtn.style.opacity = '1';
                    }
                };
                container.onmouseleave = function() {
                    pauseBtn.style.opacity = '0';
                };

            } else if (event.data == YT.PlayerState.PAUSED || event.data == YT.PlayerState.ENDED) {
                playBtn.style.opacity = '1';
                pauseBtn.style.opacity = '0';
                
                container.onmouseenter = null;
                container.onmouseleave = null;
            }
        }
    </script>
    @endif
</x-public-layout>
