@extends('member.layouts.master')
@section('content')
<div class="single-channel-page" id="content-wrapper">
    <div class="single-channel-nav">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="channel-brand" href="#">{{strtoupper($class->name)}} <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Verified"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item @if($data['menu'] == 'video') active @endif">
                        <a class="nav-link" href="/learning/class_detail/{{$class->class_id}}">Videos <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item @if($data['menu'] == 'premium') active @endif">
                        <a class="nav-link" href="/learning/class_detail/premium/{{$class->class_id}}">Premium</a>
                    </li>
                    <li class="nav-item @if($data['menu'] == 'panduan') active @endif">
                        <a class="nav-link" href="/learning/class_detail/premium/{{$class->class_id}}">Panduan</a>
                    </li>
                    <li class="nav-item @if($data['menu'] == 'mentor') active @endif">
                        <a class="nav-link" href="/learning/mentor/{{$class->class_id}}">Mentor</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="container-fluid">
        <div class="video-block section-padding">
            @if(Session::has('msg'))
            <div class="alert alert-warning" role="alert">
                {{session()->get('msg')}}
            </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                <div class="main-title">
                    <h6>@if($data['menu'] == 'premium') PREMIUM @else MATERI @endif</h6>
                </div>
                </div>
                @if (!empty($data['materi'][0]))
                    @foreach($data['materi'] as $m)
                        <div class="col-xl-3 col-sm-6 mb-3">
                            <div class="video-card">
                                <div class="video-card-image">
                                    <a class="play-icon" href="/learning/materi_detail/{{$m->materi_id}}"><i class="fas fa-play-circle"></i></a>
                                    <a href="#"><img class="img-fluid" src="/home-images/materi/materi/{{$m->getMateri->gambar}}" alt=""></a>
                                    <div class="time">
                                        @if($m->premium == false)
                                            FREE
                                        @else
                                            PREMIUM
                                        @endif
                                    </div>
                                </div>
                                <div class="video-card-body">
                                    <div class="video-title">
                                        <a href="/learning/materi_detail/{{$m->materi_id}}">{!!$m->getMateri->judul!!}</a>
                                    </div>
                                    <div class="video-page text-success">
                                    </div>
                                    <div class="video-view">
                                        {{$m->getMateri->visitor}} view
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    @if (isset($first))
                        <div class="col-xl-3 col-sm-6 mb-3">
                            <div class="video-card">
                                <div class="video-card-image">
                                    <a class="play-icon" href="/learning/materi/{{$first->slug}}"><i class="fas fa-play-circle"></i></a>
                                    <a href="#"><img class="img-fluid" src="/home-images/materi/{{$first->gambar}}" alt=""></a>
                                    <div class="time">
                                            PREMIUM
                                    </div>
                                </div>
                                <div class="video-card-body">
                                    <div class="video-title">
                                        <a href="/learning/materi/{{$first->slug}}">{!!$first->judul!!}</a>
                                    </div>
                                    <div class="video-page text-success">
                                        <a title="" data-placement="top" data-toggle="tooltip" href="/learning/channel/{{$first->chanel_id}}" data-original-title="Verified" class="text-success">{{$first->chanel->nama_chanel}} <i class="fas fa-check-circle text-success"></i></a>
                                    </div>
                                    <div class="video-view">
                                        {{$first->visitor}} view
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                    <div class="col-6">
                        <b>Materi tidak tersedia</b>
                    </div>
                    @endif
                @endif
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center pagination-sm mb-0">
                </ul>
            </nav>
        </div>
    </div>

    @include('member.layouts.footer-mini')
</div>
@endsection
