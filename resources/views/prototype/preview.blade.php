@extends('layouts.public')

@section('content')
    <div class="prototype-preview-wrapper" style="min-height: 80vh; padding: 40px 20px; max-width: 1200px; margin: 0 auto; display: flex; flex-direction: column;">
        <div style="background: white; border: 1px solid var(--border); border-radius: 16px; overflow: hidden; box-shadow: var(--ss); flex-grow: 1; display: flex; flex-direction: column;">
            <iframe 
                src="{{ route('prototype.raw', $prototype->slug) }}" 
                frameborder="0"
                style="width: 100%; min-height: 600px; flex-grow: 1;"
                onload="this.style.height = this.contentWindow.document.documentElement.scrollHeight + 'px';"
            ></iframe>
        </div>
        </div>

        <!-- Videos Section -->
        @if($prototype->youtube_videos && is_array($prototype->youtube_videos) && count($prototype->youtube_videos) > 0)
        @php
            if (!function_exists('getYoutubeId')) {
                function getYoutubeId($url) {
                    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i', $url, $match);
                    return isset($match[1]) ? $match[1] : null;
                }
            }
        @endphp
        <div class="mt-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center" style="font-family: inherit;">فيديوهات النموذج</h2>
            <div class="space-y-12" style="display: flex; flex-direction: column; gap: 3rem;">
                @foreach($prototype->youtube_videos as $index => $video)
                    @if(isset($video['url']))
                        <div class="relative w-full max-w-5xl mx-auto rounded-3xl overflow-hidden shadow-2xl group bg-black aspect-video border-4 border-gray-900" style="position: relative; width: 100%; max-width: 1024px; margin: 0 auto; border-radius: 1.5rem; overflow: hidden; background: black; aspect-ratio: 16/9; border: 4px solid #111827; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);">
                            <!-- YouTube Player Container -->
                            <div id="youtube-player-{{ $index }}" class="w-full h-full pointer-events-none scale-105" style="width: 100%; height: 100%; pointer-events: none; transform: scale(1.05);"></div>
                            
                            <!-- Transparent Overlay Shield -->
                            <div class="absolute inset-0 z-10 cursor-pointer" onclick="togglePlay({{ $index }})" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; z-index: 10; cursor: pointer;">
                                <!-- Play/Pause Button Custom UI -->
                                <div class="absolute inset-0 flex items-center justify-center transition-opacity duration-300" id="play-btn-{{ $index }}" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; display: flex; align-items: center; justify-content: center; transition: opacity 0.3s;">
                                    <div class="w-24 h-24 bg-primary-600/90 rounded-full flex items-center justify-center backdrop-blur-md text-white shadow-2xl border border-white/10" style="width: 6rem; height: 6rem; background-color: rgba(242, 101, 34, 0.9); border-radius: 9999px; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(12px); color: white; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); border: 1px solid rgba(255, 255, 255, 0.1);">
                                        <svg style="width: 3rem; height: 3rem; margin-left: 0.5rem;" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                    </div>
                                </div>
                                
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 transition-opacity duration-300 bg-black/20" id="pause-btn-{{ $index }}" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s; background-color: rgba(0, 0, 0, 0.2);">
                                    <div class="w-24 h-24 bg-black/60 rounded-full flex items-center justify-center backdrop-blur-md text-white shadow-2xl border border-white/10" style="width: 6rem; height: 6rem; background-color: rgba(0, 0, 0, 0.6); border-radius: 9999px; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(12px); color: white; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); border: 1px solid rgba(255, 255, 255, 0.1);">
                                        <svg style="width: 3rem; height: 3rem;" fill="currentColor" viewBox="0 0 24 24"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <!-- YouTube IFrame API Script -->
        <script src="https://www.youtube.com/iframe_api"></script>
        <script>
            var players = [];
            var videoIds = [];
            
            @foreach($prototype->youtube_videos as $index => $video)
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
    </div>
@endsection
