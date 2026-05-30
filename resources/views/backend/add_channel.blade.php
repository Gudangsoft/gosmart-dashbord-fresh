@extends('backend.layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header sty-one">
      <h1 class="text-black">New Channel</h1>
      <ol class="breadcrumb">
        <li><a href="#">Dashboard</a></li>
        <li class="sub-bread"><i class="fa fa-angle-right"></i> channel</li>
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
              <h4>Tambahkan channel baru</h4>
              <!-- <p>made with bootstrap elements</p> -->
                <form class="form" action="/dashboard/add_chanel" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                    <label for="exampleInputuname">Channel Name</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="ti-user"></i></div>
                        <input class="form-control" name="id" id="exampleInputuname" placeholder="" type="hidden" value="{{$data['id']}}">
                        <input class="form-control" name="nama_chanel" id="exampleInputuname" placeholder="" type="text" value="{{$data['name']}}">
                    </div>
                    </div>
                    <div class="form-group">
                    <label for="exampleInputuname">Link Youtube</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="ti-link"></i></div>
                        <input class="form-control" name="link_chanel" id="exampleInputuname" placeholder="" type="text" value="{{$data['url']}}">
                    </div>
                    <div class="form-group">
                      <label class="control-label">Keterangan</label>
                      <textarea class="form-control" name ="deskripsi" id="placeTextarea" rows=6  required> {{$data['description']}}</textarea>
                    </div>
                    </div>
                    <div class="form-group">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="text-black">Tambah Gambar</h4>
                                <label for="input-file-now">Gambar dengan ukuran 1080 x 1080 pixel atau square 1:1 sangat direkomendasikan</label>
                                <input type="file" name="chanel_img" id="input-file-now" class="dropify" data-default-file="{{$data['picture']}}"/>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Tambah</button>
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
                            Channel hanya berisi video materi dengan status Free dari beberapa kelas yang dipilih mentor
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
    <!-- /.content -->
@endsection
