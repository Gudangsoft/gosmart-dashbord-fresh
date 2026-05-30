<div class="courses-wrapper-02">
    @if(Session::has('msg'))
        <div class="alert alert-primary" role="alert">
            {{session()->get('msg')}}
        </div>
    @endif
    @if(Session::has('verified'))
    <div class="alert alert-success" role="alert">
        Verifikasi email berhasil
    </div>
    @endif
    <div class="row">
        @if (isset($data['live']))
            @foreach ($data['live'] as $k=>$v)
                <div class="col-lg-4 col-md-6">
                    <!-- Single Courses Start -->
                    <div class="single-courses">
                        <div class="courses-images">
                            <a href="https://www.youtube.com/watch?v={{ $v['youtube_id'] }}" class="play video-popup"><img src="{{$v['image']}}" alt="Courses"></a>
                            <div class="courses-option dropdown">
                                <div class="free_badge">
                                    LIVE
                                </div>
                            </div>
                        </div>
                        <div class="courses-content">

                            <h4 class="title"><a href="#">{!!strtoupper($v['title'])!!}</a></h4>

                        </div>
                    </div>
                    <!-- Single Courses End -->
                </div>
            @endforeach
            <div class="row mt-3">
                <div class="d-flex justify-content-center">
                    {{ $data['rows']->onEachSide(2)->links() }}
                </div>
            </div>
        @endif

    </div>
</div>
