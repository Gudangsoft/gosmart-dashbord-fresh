@extends('backend.layouts.master')
@section('content')
@include('sweetalert::alert')

<!-- Content Header (Page header) -->
    <div class="content-header sty-one">
      <h1 class="text-black">Semua Materi</h1>
      <ol class="breadcrumb">
        <li><a href="#">Dashboard</a></li>
        <li class="sub-bread"><i class="fa fa-angle-right"></i> Materi</li>
      </ol>
    </div>
    <!-- Main content -->
    <div class="content">
        <div class="info-box">
            <!-- <h4 class="text-black">Cards</h4>
            <p>A <strong>card</strong> is a flexible and extensible content container. It includes options for headers and footers, a wide variety of content, contextual background colors, and powerful display options.</p> -->
            <div class="row">
                @foreach($view_stream as $row)
                    <div class="col-lg-4 m-b-3">
                        <!-- Card -->
                        <div class="card">
                            <!-- <div class="embed-responsive embed-responsive-16by9">
                                <iframe src="{{asset('/home-images/')}}/{{$row->gambar}}" frameborder="0" class="embed-responsive-item"></iframe>
                            </div> -->
                            <img class="card-img-top img-responsive" src="{{asset('/home-images/')}}/{{$row->gambar}}" alt="Card image cap" style="">
                            <div class="card-body">
                                <h4 class="card-title">{{$row->judul}}</h4>
                                <p class="card-text">{{$row->keterangan}}</p>
                                <p>
                                <span style='background:#54436B;padding:3px 7px 3px 7px;border-radius:3px;margin-right:5px;'><a href="/dashboard/channel/{{$row->chanel_id}}" style='color:#fff;'>{{strtolower($row->nama_chanel)}}</a></span>
                                <span style='background:#50CB93;padding:3px 7px 3px 7px;border-radius:3px;margin-right:5px;'>
                                    <a href="/dashboard/channel/{{$row->chanel_id}}" style='color:#fff;'>
                                    @if($row->level == null)
                                        pemula
                                    @else
                                        {{strtolower($row->level)}}
                                    @endif
                                    </a>
                                </span>
                                </p>
                                <a href="/dashboard/{{str_replace(' ', '_', $row->judul)}}/{{$row->id}}" class="btn btn-lg btn-primary btn-block">Ikuti</a>
                            </div>
                        </div>
                        <!-- Card -->
                    </div>
                @endforeach
            </div>
            <!-- <div class="row">
                <div class="col">
                    {{$view_stream->currentPage()}}
                </div>
                <div class="col">
                    {{$view_stream->links()}}
                </div>
            </div> -->
            <div class="d-flex justify-content-center">
                {{$view_stream->links()}}
            </div>
        </div>
      <!-- Main row -->
    </div>
    <!-- /.content -->
@endsection
