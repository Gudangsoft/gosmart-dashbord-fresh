<!-- Video Playlist End  -->
<div class="playlist-title mt-4 mb-2 mt-8">
    <h3 class="title">Class Free for you</h3>
    <span>{!! $data['learn']['class']['total_materi'] !!} Lesson</span>
</div>

<!-- Video Playlist Start  -->
<div class="video-playlist">
    <div class="accordion" id="videoPlaylist">

        <!-- Accordion Items Start  -->
        <div class="accordion-item">
            <button class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOnex">
                <p>{!! $data['learn']['class']['title'] !!}</p>
                {{-- <span class="total-duration">01 hour 48 minutes</span> --}}
            </button>

            <div id="collapseOnex" class="accordion-collapse collapse" data-bs-parent="#videoPlaylist">
                <nav class="vids">
                    @foreach ($data['contents']['content'] as $k=>$v)
                        <a class="link {{ $v['id']==$data['contents']['video_now']['id'] ? 'active':'' }}" href="/learning/content/{{ $v['slug'] }}">
                            <p>{!! $v['title'] !!}</p>
                            <span class="total-duration">{{ $v['time'] }} Minutes</span>
                        </a>
                    @endforeach
                </nav>
            </div>
        </div>
        <!-- Accordion Items End  -->

    </div>
</div>
<!-- Video Playlist End  -->
