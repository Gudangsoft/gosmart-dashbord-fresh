@extends('member.layouts.master')
@section('content')
<div id="content-wrapper">
    <div class="container-fluid pb-0">
        <div class="top-mobile-search">
            <div class="row">
                <div class="col-md-12">
                <form class="mobile-search">
                    <div class="input-group">
                        <input type="text" placeholder="Search for..." class="form-control">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-dark"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <div class="top-category section-padding mb-4">
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
                <div class="col-md-12">
                    <div class="alert alert-warning" role="alert">
                        <strong>BETA TEST, REPORT BUG, ERROR KIRIM KE <a href="mailto:admin@g-academy.net">ADMIN@G-ACADEMY.NET</a></strong>
                    </div>
                    <div class="main-title">

                        <h6>Rekomendasi Kelas</h6>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="owl-carousel owl-carousel-category">
                        @foreach($count_class as $c)
                        <div class="item">
                            <div class="category-item">
                                <a href="/learning/class_detail/{{$c->class_id}}">
                                <img class="img-fluid" src="/home-images/kelas/{{$c->getClass->image}}" alt="">
                                <h6>{{strtoupper($c->getClass->name)}}</h6>
                                {{-- <p>{{$c->jumlah}} pelanggan</p> --}}
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="video-block section-padding">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-title">
                        <h6>Kelas Tersedia </h6>
                    </div>
                </div>
                <!-- video per materi -->
                @foreach($data['class'] as $k=>$v)
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="video-card">
                        <div class="video-card-image">
                            <a class="play-icon" href="{{$v['url']}}"><i class="fas fa-play-circle"></i></a>
                                <a href="{{$v['url']}}"><img class="img-fluid" src="{{asset('/home-images/kelas/')}}/{{$v['image']}}" alt=""></a>
                            <div class="time">
                                @if($v['premium'] == true)
                                    PREMIUM
                                @elseif($v['premium'] == false)
                                    FREE
                                @endif
                            </div>
                        </div>
                        <div class="video-card-body">
                            <div class="video-title">
                                <a href="{{$v['url']}}">{!!$v['name']!!}</a>
                            </div>

                        </div>
                    </div>
                </div>
                @endforeach

            </div>
            <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center pagination-sm mb-4">
                <li class="page-item"> {{$data['page']->onEachSide(2)->links()}}</li>
            </ul>
            </nav>
        </div>
    </div>
            <!-- /.container-fluid -->
            <!-- Sticky Footer -->
    @include('member.layouts.footer')
</div>
<!-- /.content-wrapper -->
@endsection
