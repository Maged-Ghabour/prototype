@extends('layouts.public')

@section('content')
    <div class="prototype-preview-wrapper" style="padding: 40px 20px; max-width: 1200px; margin: 0 auto; display: flex; flex-direction: column; gap: 2rem;">
        @if($prototype->html_code || $prototype->css_code || $prototype->js_code || $prototype->html_file_upload)
        <div style="background: white; border: 1px solid var(--border); border-radius: 16px; overflow: hidden; box-shadow: var(--ss); flex-grow: 1; display: flex; flex-direction: column; min-height: 80vh;">
            <iframe 
                src="{{ route('prototype.raw', $prototype->slug) }}" 
                frameborder="0"
                style="width: 100%; min-height: 600px; flex-grow: 1;"
                onload="this.style.height = this.contentWindow.document.documentElement.scrollHeight + 'px';"
            ></iframe>
        </div>
        @endif
        <!-- Videos Section -->
        @if($prototype->youtube_videos && is_array($prototype->youtube_videos) && count($prototype->youtube_videos) > 0)
        @php
            if (!function_exists('getYoutubeId')) {
                function getYoutubeId($url) {
                    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?|shorts)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i', $url, $match);
                    return isset($match[1]) ? $match[1] : null;
                }
            }
        @endphp
        <div class="mt-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center" style="font-family: inherit;">فيديوهات النموذج</h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(500px, 1fr)); gap: 2rem;">
                @foreach($prototype->youtube_videos as $index => $video)
                    @if(isset($video['url']))
                        @php $vidId = getYoutubeId($video['url']); @endphp
                        @if($vidId)
                        <div class="relative w-full rounded-2xl overflow-hidden shadow-2xl group bg-black aspect-video" style="position: relative; width: 100%; border-radius: 1rem; overflow: hidden; background: black; aspect-ratio: 16/9; border: 1px solid #e5e7eb; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);">
                            <!-- YouTube Player Container -->
                            <div id="youtube-player-{{ $index }}" class="w-full h-full pointer-events-none" style="width: 100%; height: 100%; pointer-events: none;"></div>
                            
                            <!-- Solid Overlay Shield with Thumbnail (Hides YouTube UI entirely) -->
                            <div id="video-overlay-{{ $index }}" class="absolute inset-0 z-10 cursor-pointer transition-opacity duration-500" onclick="togglePlay({{ $index }})" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; z-index: 10; cursor: pointer; background-color: black; transition: opacity 0.5s ease;">
                                <!-- Thumbnail Image with Fallback -->
                                <img src="https://img.youtube.com/vi/{{ $vidId }}/maxresdefault.jpg" onerror="this.src='https://img.youtube.com/vi/{{ $vidId }}/hqdefault.jpg'" style="position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover;" alt="Video Thumbnail" />
                                
                                <!-- Dark overlay to make play button visible -->
                                <div style="position: absolute; inset: 0; background-color: rgba(0,0,0,0.3); transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='rgba(0,0,0,0.1)'" onmouseout="this.style.backgroundColor='rgba(0,0,0,0.3)'"></div>

                                <!-- Play Button -->
                                <div class="absolute inset-0 flex items-center justify-center" style="position: absolute; inset: 0; display: flex; align-items: center; justify-content: center;">
                                    <div class="bg-primary-600/90 rounded-full flex items-center justify-center text-white shadow-xl" style="width: 5rem; height: 5rem; background-color: rgba(242, 101, 34, 0.9); border-radius: 9999px; display: flex; align-items: center; justify-content: center; color: white; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                                        <svg style="width: 2.5rem; height: 2.5rem; margin-left: 0.25rem;" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Invisible click shield for pausing (Appears when video is playing) -->
                            <div id="playing-shield-{{ $index }}" class="absolute inset-0 cursor-pointer" onclick="togglePlay({{ $index }})" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; z-index: 0; cursor: pointer; display: none;">
                                <!-- Pause Button (appears on hover when playing) -->
                                <div id="pause-btn-{{ $index }}" style="position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; background-color: rgba(0,0,0,0.3); opacity: 0; transition: opacity 0.3s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0'">
                                    <div style="width: 5rem; height: 5rem; background-color: rgba(0, 0, 0, 0.7); border-radius: 9999px; display: flex; align-items: center; justify-content: center; color: white; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);">
                                        <svg style="width: 2.5rem; height: 2.5rem;" fill="currentColor" viewBox="0 0 24 24"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
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
                var overlay = document.getElementById('video-overlay-' + index);
                var shield = document.getElementById('playing-shield-' + index);
                
                if (event.data == YT.PlayerState.PLAYING) {
                    // Start fading out instantly so it doesn't feel slow
                    overlay.style.transition = 'opacity 1s ease';
                    overlay.style.opacity = '0';
                    setTimeout(function() { 
                        if(players[index].getPlayerState() === YT.PlayerState.PLAYING) {
                            overlay.style.display = 'none'; 
                        }
                    }, 1000);
                    shield.style.display = 'block';
                    shield.style.zIndex = '20'; // bring above iframe
                } else if (event.data == YT.PlayerState.PAUSED || event.data == YT.PlayerState.ENDED || event.data == YT.PlayerState.UNSTARTED) {
                    // Show overlay again instantly to completely hide YouTube UI
                    overlay.style.transition = 'none';
                    overlay.style.display = 'block';
                    setTimeout(function() { overlay.style.opacity = '1'; }, 10);
                    shield.style.display = 'none';
                    shield.style.zIndex = '0';
                }
            }
        </script>
        @endif
    </div>
@endsection
