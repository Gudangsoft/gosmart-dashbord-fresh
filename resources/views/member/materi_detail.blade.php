@extends('member.layouts.master')
@section('content')
<style type="text/css">
    /*
        Use :not with impossible condition so inputs are only hidden
        if pseudo selectors are supported. Otherwise the user would see
        no inputs and no highlighted stars.
    */
    .rating input[type="radio"]:not(:nth-of-type(0)) {
        /* hide visually */
        border: 0;
        clip: rect(0 0 0 0);
        height: 1px;
        margin: -1px;
        overflow: hidden;
        padding: 0;
        position: absolute;
        width: 1px;
    }
    .rating [type="radio"]:not(:nth-of-type(0)) + label {
        display: none;
    }

    label[for]:hover {
        cursor: pointer;
    }

    .rating .stars label:before {
        content: "★";
    }

    .stars label {
        color: lightgray;
    }

    .stars label:hover {
        text-shadow: 0 0 1px #000;
    }

    .rating [type="radio"]:nth-of-type(1):checked ~ .stars label:nth-of-type(-n+1),
    .rating [type="radio"]:nth-of-type(2):checked ~ .stars label:nth-of-type(-n+2),
    .rating [type="radio"]:nth-of-type(3):checked ~ .stars label:nth-of-type(-n+3),
    .rating [type="radio"]:nth-of-type(4):checked ~ .stars label:nth-of-type(-n+4),
    .rating [type="radio"]:nth-of-type(5):checked ~ .stars label:nth-of-type(-n+5) {
        color: orange;
    }

    .rating [type="radio"]:nth-of-type(1):focus ~ .stars label:nth-of-type(1),
    .rating [type="radio"]:nth-of-type(2):focus ~ .stars label:nth-of-type(2),
    .rating [type="radio"]:nth-of-type(3):focus ~ .stars label:nth-of-type(3),
    .rating [type="radio"]:nth-of-type(4):focus ~ .stars label:nth-of-type(4),
    .rating [type="radio"]:nth-of-type(5):focus ~ .stars label:nth-of-type(5) {
        color: darkorange;
    }
</style>
<div id="content-wrapper">
    <div class="container-fluid pb-0">
        @if(Session::has('msg'))
            <div class="alert alert-success" role="alert">{{session()->get('msg')}}  </div>
        @endif
        @if(Session::has('delete'))
            <div class="alert alert-danger" role="alert">{{session()->get('delete')}}  </div>
        @endif
        <div class="video-block-right-list section-padding">
            <div class="row mb-4">
                <div class="col-md-8">
                    <div class="single-video">
                        <!-- emmbed video youtube berdasarkan ID Video -->
                        {{-- <iframe width="100%" height="315" src="https://www.youtube.com/embed/{{$view_stream->link}}?autoplay=1&mute=1&loop=1&color=white&controls=0&modestbranding=1&playsinline=1&rel=0&enablejsapi=1&playlist=WhY7uyc56ms" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> --}}
                        <iframe width="100%" height="315" src="https://www.youtube.com/embed/{{$view_stream->slug}}?modestbranding=1&autohide=1&autoplay=1&controls=1&showinfo=0" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
                    </div>

                <!-- SIDEBAR VIDEO KANAN  -->
                </div>
                <div class="col-md-4">
                    {{-- <div class="video-card video-card-list mt-2" style="background-color: blueviolet;padding:5px 3px 5px 10px;color:#fff;">
                        <strong>Total Materi : {{$total_materi}}</strong>
                    </div> --}}
                    @if(isset($right_sidebar))
                        @if ($hidden_playlist == 'n')
                            <div class="video-slider-right-list" style="display:block">
                                @php
                                    $no = 0;
                                @endphp
                                @foreach($right_sidebar as $k=>$v)
                                {{-- {{dd($right_sidebar['title'])}} --}}
                                <div class="video-card video-card-list" style="@if($count_class_history == 0) background:#dddddd; @else {{$v['background']}}border-radius:3px; @endif">
                                    <div class="video-card-image">
                                        <a class="play-icon" href="#"><i class="fas fa-play-circle"></i></a>
                                        <a href="#"><img class="img-fluid" src="/home-images/materi/{{$v['picture']}}" alt=""></a>
                                        <div class="time">
                                            @if ($v['premium'] == 1)
                                                PREMIUM
                                            @else
                                                FREE
                                            @endif
                                        </div>
                                    </div>
                                    <div class="video-title">
                                        <a href="/learning/materi/{{$v['slug']}}" style="{{$v['disable']}} display: inline-block;" active>{!!$v['title']!!}</a>
                                    </div>
                                    <div class="video-page text-success" style="@php $no++; if($no > $count_class_history){echo 'display:none;';}else{'display:inline;';} @endphp">
                                        Selesai  <a title="" data-placement="top" data-toggle="tooltip" href="#" data-original-title="Verified"><i class="fas fa-check-circle text-success"></i></a>
                                    </div>
                                    <div class="video-view">
                                        {{$v['view']}} view &nbsp;<i class="fas fa-clock" aria-hidden="true"></i> {{ Carbon\Carbon::parse($v['time'])->diffForHumans() }}
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="video-slider-right-list" style="display:block">
                                @foreach($free_materi as $v)
                                {{-- {{dd($right_sidebar['title'])}} --}}
                                <div class="video-card video-card-list">
                                    <div class="video-card-image">
                                        <a class="play-icon" href="#"><i class="fas fa-play-circle"></i></a>
                                        <a href="#"><img class="img-fluid" src="/home-images/materi/{{$v->gambar}}" alt=""></a>
                                        <div class="time">
                                                FREE
                                        </div>
                                    </div>
                                    <div class="video-title">
                                        <a href="/learning/materi/{{$v['slug']}}">{!!$v->judul!!}</a>
                                    </div>
                                    <div class="video-view">
                                        {{$v->visitor}} view &nbsp;<i class="fas fa-clock" aria-hidden="true"></i> {{ Carbon\Carbon::parse($v->created_at)->diffForHumans() }}
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        <div class="video-block section-padding">
            <div class="row">
                <div class="col-md-8">
                    <div class="single-video-left">
                        <div class="single-video-title box mb-3">
                            <div class="float-right">
                                {{-- <input type="text" id="time" value=""> --}}
                                <!-- <button id="next" style="display:none;" class="btn btn-danger" type="button">Follow <strong>77K</strong></button> -->
                            </div>
                            <h2><a href="#">{!!$view_stream->judul!!}</a></h2>
                            <div class="row">
                                <div class="col-6">
                                    <p class="mb-0">
                                        <i class="fas fa-eye"></i> {{$view_stream->visitor}} views
                                        <i class="fas fa-book" style="margin-left: 4px;"></i> {{$total_materi}} Materi
                                        <i class="fas fa-star" style="margin-left: 4px;"></i> {{$get_rating ? number_format($get_rating, 1) : '5'}}
                                    </p>
                                </div>
                                <div class="col-6 text-right">
                                    @if (!empty($duration))
                                        <i class="fa fa-clock text-danger" style="margin-left: 4px;font-size:20px;"></i>&nbsp;<span style="margin-left: 4px;font-size:20px;font-weight:bold;" id='timer'></span><i> Detik lagi selesai</i>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-2 pr-2">
                                @if ($view_stream->premium == true)
                                    <a href="#" style="background-color: #555555;color:#ffffff;" class="btn btn-sm border-none" data-toggle="modal" data-target="#toolsMateri">TOOLS KELAS</a>
                                    <a href="#" class="btn btn-sm btn-dark border-none">ASSET BELAJAR</a>
                                    <a href="#" class="btn btn-sm btn-dark border-none">KONSULTASI</a>
                                @endif
                            </div>
                        </div>
                        <div class="single-video-author box mb-3">
                            <div class="float-right"><button class="btn btn-danger" type="button">Follow <strong></strong></button></div>
                            <img class="img-fluid" src="{{$data['channel_img']}}" alt="">
                            <p><a href="#"><strong>{{$data['class']}}</strong></a> <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Verified"></span></p>
                            <small>Bergabung sejak {{$data['date']}}</small>
                        </div>
                        {{-- <div class="single-video-info-content box mb-3">
                            <h6>Deskripsi:</h6>
                            <p>{!!html_entity_decode($view_stream->keterangan)!!}</p>
                            <h6>Tags :</h6>
                            <p class="tags mb-0">
                                @foreach($data['tags'] as $tag)
                                    <span><a href="/learning/tags/{{$tag}}">{{$tag}}</a></span>
                                @endforeach

                            </p>
                        </div> --}}
                        <div class="box mb-3 single-video-comment-tabs">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                <a class="nav-link active" id="retro-comments-tab" data-toggle="tab" href="#retro-comments" role="tab" aria-controls="retro" aria-selected="false">Ulasan</a>
                                </li>

                            </ul>
                            <div class="tab-content">
                                {{-- <div class="tab-pane fade" id="disqus-comments" role="tabpanel" aria-labelledby="disqus-comments-tab">
                                    <h1>Soon...</h1>
                                </div>
                                <div class="tab-pane fade" id="facebook-comments" role="tabpanel" aria-labelledby="facebook-comments-tab">
                                    <h1>Soon...</h1>
                                </div> --}}
                                <div class="tab-pane fade show active" id="retro-comments" role="tabpanel" aria-labelledby="retro-comments-tab">
                                    @if (empty($data['review']))
                                        <h3>Belum ada ulasan</h3>
                                    @else
                                        @foreach ($data['review'] as $v)
                                        <div class="reviews-members">
                                            <div class="media">
                                                <a href="#"><img class="mr-3" src="{{$v['photo']}}" alt="Generic placeholder image"></a>
                                                <div class="media-body">
                                                    <div class="reviews-members-header">
                                                        <h6 class="mb-1"><a class="text-black" href="#">{{$v['username']}} </a> <small class="text-gray">{{$v['date']}}</small></h6>
                                                    </div>
                                                    <div class="reviews-members-body">
                                                        <p>{!!$v['review']!!}</p>
                                                    </div>
                                                    <div class="reviews-members-footer">
                                                        @if (auth()->user()->role == "admin" || auth()->user()->role == $v['add_by'])
                                                        {{-- <a class="total-like" href="/dashboard/delete_review/{{$v['id']}}"><i class="fas fa-trash"></i> hidden</a> --}}
                                                        <a class="total-like" href="/dashboard/delete_review/{{$v['id']}}" onclick="return confirm('Yakin sembunyikan ?')"><i class="fas fa-low-vision"></i> hidden</a>
                                                        @if ($v['show'] == true)
                                                            <a class="total-like" href="/dashboard/show_review/{{$v['id']}}" onclick="return confirm('Tampilkan sekarang ?')"><i class="fas fa-eye"></i> show</a>
                                                        @endif
                                                        @endif
                                                    </div>
                                                </div>
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
</div>
<!-- /.container-fluid -->
@include('member.layouts.footer')

<div class="modal fade" id="{{$alert}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">G-Academy</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                   <h6>Halo, {{ucfirst(auth()->user()->name)}}</h6>
                   <p>
                       Ayo langganan kelas <span class="badge badge-dark badge-pill p-2"><strong>{{strtoupper($view_stream->getClass->name)}}</strong></span> dan mendapatakan materi premium selamanya
                   </p>
                </p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="/learning/class_detail/{{$view_stream->class_id}}">Ok</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="nextAlert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">G-Academy</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{route('end_materi')}}" method="POST">
            @csrf
            <div class="modal-body">
                <p>
                    <h6>Halo, {{ucfirst(auth()->user()->name)}}</h6>
                    <p>
                        Kamu telah menyelesaikan materi <strong>{!!$view_stream->judul!!}</strong>. Klik konfirmasi bahwa kamu sudah mengikuti materi dengan benar.
                    </p>
                    <div class="form-group text-center" id="rating-ability-wrapper">
                        <label class="control-label" for="rating">
                        <span class="field-label-header">Seberapa menarik materi ini ?</span><br>
                        <span class="field-label-info"></span>
                        <input type="hidden" name="materi_id" value="{{$view_stream->id}}" required="required">
                        <input type="hidden" name="class_id" value="{{$view_stream->class_id}}" required="required">
                        <input type="hidden" id="selected_rating" name="selected_rating" value="" required="required">
                        </label>
                        <h2 class="bold rating-header" style="">
                        <span class="selected-rating">0</span><small> / 5</small>
                        </h2>
                        <button type="button" class="btnrating btn btn-default btn-lg" data-attr="1" id="rating-star-1">
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btnrating btn btn-default btn-lg" data-attr="2" id="rating-star-2">
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btnrating btn btn-default btn-lg" data-attr="3" id="rating-star-3">
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btnrating btn btn-default btn-lg" data-attr="4" id="rating-star-4">
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btnrating btn btn-default btn-lg" data-attr="5" id="rating-star-5">
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label">Ulasan</label>
                                <textarea class="form-control border-form-control" name="review" rows="5">Tanggapan anda tentang materi {!!$view_stream->judul!!}</textarea>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" type="submit">Konfirmasi</a>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="toolsMateri" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tools yang dibutuhkan</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    <div class="row">
                        @foreach ($data['data_tools'] as $v)
                        <div class="col-sm-3 col-sm-6 mb-3">
                            <div class="category-item mt-0 mb-0">
                               <a href="{{url($v->url)}}">
                                  <img class="img-fluid" src="/backend/image/tools-materi/{{$v->image}}" alt="">
                                  <h6>{!!$v->title!!} <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Verified"></span></h6>
                                  <p><a href="{{$v->link}}" class="btn btn-sm btn-secondary">Download</a></p>
                               </a>
                            </div>
                         </div>
                        @endforeach
                    </div>
                </p>
            </div>
        </div>
    </div>
</div>
<script>
    var h = {{$duration}};
    var d;
    var duration = 0;
    var htgon = 0;
        function timeAdd(){
            // var t = document.getElementById("time").value = h;
            h--;
            if(h == duration){
                // document.getElementById("next").style.display = "inline";
                $('#nextAlert').modal('show');
            }
            d = setTimeout("timeAdd()", 1000);
            document.getElementById('timer').innerHTML = h;
        }
        function mulai(){
            if(!htgon){
                $htgon = 1;
                timeAdd();
            }
            // document.getElementById('list-materi').style.cursor = 'not-allowed';
        }
    window.onload = mulai;
</script>
@endsection
