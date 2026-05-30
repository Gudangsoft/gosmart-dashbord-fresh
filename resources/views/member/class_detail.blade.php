@extends('member.layouts.master')
@section('content')
<div class="single-channel-page" id="content-wrapper">
    <div class="single-channel-nav">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="channel-brand" href="#">{{strtoupper($class->name)}} <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Verified"></a>
            @if ($data['premium_cek'] != null)
                <a class="btn btn-info btn-sm border-none ml-4" href="/learning/class_detail/premium/{{$class->class_id}}"><i class="fas fa-check-circle"></i>&nbsp;&nbsp;Your Premium <strong></strong></a>
            @else
                <a class="btn btn-danger btn-sm ml-4" href="/learning/get_class/premium/{{$class->class_id}}/{{auth()->user()->id}}"><i class="fas fa-credit-card"></i>&nbsp;&nbsp;Get Premium <strong></strong></a>
            @endif
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
                    <li class="nav-item @if($data['menu'] == 'mentor') active @endif">
                        <a class="nav-link" href="/learning/mentor/{{$class->class_id}}">Mentor</a>
                    </li>
                </ul>
                <!-- <form ation="/learning/class="form-inline my-2 my-lg-0"> -->
                    <!-- <button class="btn btn-outline-secondary btn-sm" type="button"><i class="fas fa-credit-card"></i>  BERHENTI LANGGANAN <strong></strong></button> -->
                <!-- </form> -->
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
                    <div class="btn-group float-right right-action">
                        <a href="#" class="right-action-link text-gray" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Sort by <i class="fa fa-caret-down" aria-hidden="true"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#"><i class="fas fa-fw fa-star"></i> &nbsp; Top Rated</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-fw fa-signal"></i> &nbsp; Viewed</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-fw fa-times-circle"></i> &nbsp; Close</a>
                        </div>
                    </div>
                    <h6>@if($data['menu'] == 'premium') PREMIUM @else MATERI @endif</h6>
                </div>
                </div>
                @foreach($materi as $m)
                    <div class="col-xl-3 col-sm-6 mb-3">
                        <div class="video-card">
                            <div class="video-card-image">
                                <a class="play-icon" href="/learning/materi/{{$m->slug}}"><i class="fas fa-play-circle"></i></a>
                                <a href="#"><img class="img-fluid" src="https://i2.ytimg.com/vi/{{$m->slug}}/hqdefault.jpg" alt=""></a>
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
                                    <a href="/learning/materi/{{$m->slug}}">{!!$m->judul!!}</a>
                                </div>
                                <div class="video-page text-success">
                                    <a title="" data-placement="top" data-toggle="tooltip" href="/learning/channel/{{$m->chanel->id}}" data-original-title="Verified" class="text-success">{{$m->chanel->nama_chanel}} <i class="fas fa-check-circle text-success"></i></a>
                                </div>
                                <div class="video-view">
                                    {{$m->visitor}} view
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center pagination-sm mb-0">
                    <li class="page-item">{{$materi->links()}}</li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- /.container-fluid -->
    <!-- Sticky Footer -->

    @include('member.layouts.footer-mini')
</div>
    <!-- /.content-wrapper -->
@endsection
