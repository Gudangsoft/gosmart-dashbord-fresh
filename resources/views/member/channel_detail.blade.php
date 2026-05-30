@extends('member.layouts.master')
@section('content')
<div class="single-channel-page" id="content-wrapper">
    <div class="single-channel-image">
        <img class="img-fluid" alt="" src="/img/banner_class.png">
        <div class="channel-profile">
            <img class="channel-profile-img" alt="" src="/chanel-image/{{$channel->chanel_img}}">
            <div class="social hidden-xs">
                Social &nbsp;
                <a class="fb" href="#">Facebook</a>
                <a class="tw" href="#">Twitter</a>
                <a class="gp" href="#">Google</a>
            </div>
        </div>
    </div>
    <div class="single-channel-nav">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="channel-brand" href="#">{{strtoupper($channel->nama_chanel)}} <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Verified"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item @if($data['menu'] == 'video') active @endif">
                    <a class="nav-link" href="/learning/channel_detail/{{$channel->id}}">Videos <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item @if($data['menu'] == 'premium') active @endif">
                    <a class="nav-link" href="/learning/channel_detail/premium/{{$channel->id}}">Premium</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item dropdown">
                    <!-- <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Donate
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div> -->
                </li>
                </ul>
                <!-- <form class="form-inline my-2 my-lg-0">
                <input class="form-control form-control-sm mr-sm-1" type="search" placeholder="Search" aria-label="Search"><button class="btn btn-outline-success btn-sm my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button> &nbsp;&nbsp;&nbsp; <button class="btn btn-outline-danger btn-sm" type="button">Subscribe <strong>1.4M</strong></button>
                </form> -->
            </div>
        </nav>
    </div>
    <div class="container-fluid">
        <div class="video-block section-padding">
            @if(Session::has('msg'))
            <div class="modal fade" id="startClass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                Ayo ikuti kelas <span class="badge badge-warning badge-pill p-2"><strong>PREMIUM</strong></span> dan dapatakan materi lebih banyak untuk meningkatkan skill dan kemampuan kamu
                            </p> 
                            </p> 
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-primary" href="/learning/class_detail/">Ikuti</a>
                        </div>
                    </div>
                </div>
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
                    <h6>Content</h6>
                </div>
                </div>
                @foreach($materi as $m)
                    <div class="col-xl-3 col-sm-6 mb-3">
                        <div class="video-card">
                            <div class="video-card-image">
                                <a class="play-icon" href="#"><i class="fas fa-play-circle"></i></a>
                                <a href="#"><img class="img-fluid" src="/home-images/{{$m->gambar}}" alt=""></a>
                                <div class="time">3:50</div>
                            </div>
                            <div class="video-card-body">
                                <div class="video-title">
                                    <a href="#">{{$m->judul}}</a>
                                </div>
                                <div class="video-page text-success">
                                    {{$m->chanel->nama_chanel}}  <a title="" data-placement="top" data-toggle="tooltip" href="#" data-original-title="Verified"><i class="fas fa-check-circle text-success"></i></a>
                                </div>
                                <div class="video-view">
                                    1.8M views &nbsp;<i class="fas fa-calendar-alt"></i> 11 Months ago
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