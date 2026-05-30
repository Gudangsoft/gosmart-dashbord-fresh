@extends('backend.layouts.master')
@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header sty-one">
      <h1 class="text-black">HASIL PENCARIAN</h1>

    </div>
    <!-- Main content -->
    <div class="content">
        <div class="info-box">
            <!-- <h4 class="text-black">Cards</h4>
            <p>A <strong>card</strong> is a flexible and extensible content container. It includes options for headers and footers, a wide variety of content, contextual background colors, and powerful display options.</p> -->
            <div class="row">
                @if(!empty($view_stream))
                    @foreach($view_stream as $row)
                        <div class="col-lg-4 m-b-3">
                            <!-- Card -->
                            <div class="card"> <img class="card-img-top img-responsive" src="{{asset('/home-images/materi')}}/{{$row->gambar}}" alt="Card image cap">
                                <div class="card-body">
                                    <h4 class="card-title">{{$row->judul}}</h4>
                                    <p class="card-text">{{$row->keterangan}}</p>
                                    <a href="/dashboard/{{str_replace(' ', '_', $row->judul)}}/{{$row->id}}" class="btn btn-primary">View</a>
                                    <a href="/dashboard/channel/{{$row->chanel_id}}" class="btn btn-primary">{{$row->nama_chanel}}</a>
                                </div>
                            </div>
                            <!-- Card -->
                        </div>
                    @endforeach
                @else
                    <h3>Hasil pencarian {{$cari}} tidak ditemukan</h3>
                @endif
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
