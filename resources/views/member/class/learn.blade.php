@extends('member.layouts.dashboard')
@section('content')
    <div class="section">
        <div class="section section-padding mt-n10">
            <div class="container">
                <div class="row gx-10">
                    @if(Session::has('msg'))
                    <!-- Message Start -->
                        <div class="message mb-2">
                            <span class="message-icon">
                                <img src="{{asset('assets')}}/images/menu-icon/icon-6.png" alt="">
                            </span>
                            <span class="message-content">
                                <p><strong>{{ session()->get('msg') }}</strong></p>
                            </span>
                        </div>

                        <div class="modal" id="getCertificate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">G-Academy</h5>
                                    </div>
                                    <form action="{{route('end_materi')}}" method="POST">
                                    @csrf
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                                        <button class="btn btn-primary" type="submit">Konfirmasi</a>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <!-- Message End -->
                    @endif
                    <div class="col-lg-8 mb-4">
                        <div class="courses-details">
                            <div class="courses-details-images">
                                <img src="{{ $data['contents']['video_now']['image'] }}" alt="Courses Details">
                                <div class="courses-play">
                                    <img src="{{asset('assets')}}/images/courses/circle-shape.png" alt="Play">
                                    <a class="play video-popup" href="{{ $data['contents']['video_now']['url'] }}"><i class="flaticon-play"></i></a>
                                </div>
                            </div>

                            <h2 class="title">{{ $data['contents']['video_now']['title'] }} {!! $data['contents']['video_now']['badge'] !!}</h2>

                            <div class="courses-details-admin">
                                <div class="admin-author">
                                    <div class="author-thumb">
                                        <img src="{{ $data['learn']['class']['author_image'] }}" class="author_thumb" alt="Author">
                                    </div>
                                    <div class="author-content">
                                        <a class="name" href="/mentor/{{ $data['learn']['class']['author'] }}">{{ $data['learn']['class']['author'] }}</a>
                                        <span class="Enroll">{{ $data['learn']['class']['total_subscribe'] }}</span>

                                        @if (isset($data['contents']['video_now']['last_id_learn']))
                                            @if ($data['contents']['video_now']['id'] == $data['contents']['video_now']['last_id_learn'] && $data['contents']['video_now']['is_premium'] == 1)
                                                || <a class="certificate-button"  href="/learning/tab-menu/certificate">Print Certificate</a>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>

                            @include('member.class.content_tab')

                        </div>

                    </div>

                    <div class="courses-video-playlist">
                        <div class="playlist-title mt-4 mb-2">
                            <h3 class="title">Course Contents</h3>
                            <span>{!! $data['learn']['class']['total_materi'] !!} Lesson</span>
                        </div>

                        <div class="video-playlist">
                            <div class="accordion" id="videoPlaylist">

                                <div class="accordion-item">
                                    <button class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                        <p>{!! $data['learn']['class']['title'] !!}</p>
                                    </button>

                                    <div id="collapseOne" data-bs-parent="#videoPlaylist">
                                        <nav class="vids">
                                            @foreach ($data['contents']['content'] as $k=>$v)
                                                <a href="{{ $v['url'] }}" class="{{ $v['bg_disable'] }}">
                                                    <p>{!! $v['title'] !!}</p>
                                                    <span class="total-duration">Duration : {{ $v['time']['data'] }} </span>
                                                    {!! isset($v['in_completed']) ? $v['in_completed'] : $v['un_completed']!!}
                                                </a>
                                            @endforeach
                                        </nav>
                                    </div>
                                </div>

                                @if (isset($data['contents']['sub_class']))
                                    @foreach ($data['contents']['sub_class'] as $a=>$b)
                                        <div class="accordion-item">
                                            <button class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{ $b['id'] }}">
                                                <p>{!! $b['title'] !!}</p>
                                            </button>

                                            <div id="collapseOne{{ $b['id'] }}" class="accordion-collapse collapse" data-bs-parent="#videoPlaylist">
                                                <nav class="vids">
                                                    @if (isset($data['contents']['sub_content']))
                                                        @foreach ($data['contents']['sub_content'] as $c=>$d)
                                                            <a href="/learning/content/{{ $d['slug'] }}">
                                                                <p>{!! $d['title'] !!}</p>
                                                                <span class="total-duration">{{ $d['time']['data'] }} </span>
                                                            </a>
                                                        @endforeach
                                                    @endif
                                                </nav>
                                            </div>
                                        </div>
                                    @endforeach

                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($data['contents']['review'] == false)
        <div class="modal" id="nextAlert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">G-Academy</h5>

                    </div>
                    <form action="{{route('end_materi')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>
                            <h6>Halo, {{ucfirst(auth()->user()->name)}}</h6>
                            <p>
                                Kamu telah menyelesaikan materi <strong>{!!$data['contents']['video_now']['title']!!}</strong>. Klik konfirmasi bahwa kamu sudah mengikuti materi dengan benar.
                            </p>
                            <input type="hidden" name="materi_id" value="{{$data['contents']['video_now']['id']}}" required="required">
                            <input type="hidden" name="class_id" value="{{$data['contents']['video_now']['class_id']}}" required="required">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit">Konfirmasi</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="modal" id="nextAlert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">G-Academy</h5>

                    </div>
                    <div class="modal-body">
                        <p>
                            <h6>Halo, {{ucfirst(auth()->user()->name)}}</h6>
                            <p>
                                Kamu telah menyelesaikan materi <strong>{!!$data['contents']['video_now']['title']!!}</strong>. Klik konfirmasi bahwa kamu sudah mengikuti materi dengan benar.
                            </p>
                            <input type="hidden" name="materi_id" value="{{$data['contents']['video_now']['id']}}" required="required">
                            <input type="hidden" name="class_id" value="{{$data['contents']['video_now']['class_id']}}" required="required">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                        <a href="/learning/end_materi_rate/{{$data['contents']['video_now']['id']}}/{{$data['contents']['video_now']['class_id']}}" class="btn btn-primary" type="submit">Konfirmasi</a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @php
        $duration = $data['contents']['video_now']['time'];
    @endphp
    <script>
        var h = {{$duration ? $duration : '0'}};
        // var h = 3;
        var d;
        var duration = 0;
        var htgon = 0;
            function timeAdd(){
                h--;
                if(h == duration){
                    $('#nextAlert').modal('show');
                    $('#comment').focus();
                }
                d = setTimeout("timeAdd()", 1000);
            }
            function mulai(){
                if(!htgon){
                    $htgon = 1;
                    timeAdd();
                }else{

                }
                // document.getElementById('list-materi').style.cursor = 'not-allowed';
            }
        window.onload = mulai;
        window.addEventListener('beforeunload', function (e) {
        // Cancel the event
        e.preventDefault(); // If you prevent default behavior in Mozilla Firefox prompt will always be shown
        // Chrome requires returnValue to be set
        e.returnValue = 'Apakah anda akan keluar dari kelas ?';
        });
    </script>
@endsection
