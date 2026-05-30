@extends('backend.layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header sty-one">
      <h1 class="text-black">Live Streaming</h1>
      <ol class="breadcrumb">
        <li><a href="#">Dashboard</a></li>
        <li class="sub-bread"><i class="fa fa-angle-right"></i> Live Streaming</li>
      </ol>
    </div>

    <!-- Main content -->
    <div class="content">
      <div class="row">
        <div class="col-lg-12">
          @if($errors->any())
            @foreach($errors->all() as $error)
              <div class="alert alert-danger" role="alert"> {{$error}} </div>
            @endforeach
          @endif
        </div>
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              {{-- <h4>Tambahkan channel baru</h4> --}}
              <!-- <p>made with bootstrap elements</p> -->
                <form class="form" action="/dashboard/livestream_save" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputuname">Judul</label>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="ti-user"></i></div>
                            <input class="form-control" name="id" id="exampleInputuname" placeholder="" type="hidden" value="{{$data['id']}}">
                            <input class="form-control" name="title" id="exampleInputuname" placeholder="" type="text" value="{!!$data['title']!!}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputuname">Youtube ID</label>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="ti-user"></i></div>
                            <input class="form-control" name="youtube_id" id="exampleInputuname" placeholder="" type="text" value="{{$data['youtube_id']}}">
                        </div>
                    </div>

                    <input type="submit" class="btn btn-success waves-effect waves-light m-r-10" value="Tambah">
                    <button type="submit" class="btn btn-inverse waves-effect waves-light">Cancel</button>
                </form>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="panel panel-default m-3">
                    <div class="panel-heading" role="tab" id="headingTen">
                        <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTen" aria-expanded="false" aria-controls="collapseTen">Syarat dan ketentuan</a> </h4>
                    </div>
                    <div id="collapseTen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTen">
                        <div class="panel-body">
                            Masukan id video dari youtube
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
    <!-- /.content -->
@endsection
