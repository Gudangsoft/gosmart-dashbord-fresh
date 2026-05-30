@extends('backend.layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header sty-one">
      <h1 class="text-black">Tools Materi</h1>
      <ol class="breadcrumb">
        <li><a href="#">Dashboard</a></li>
        <li class="sub-bread"><i class="fa fa-angle-right"></i> Tools Materi</li>
      </ol>
    </div>

    <!-- Main content -->
    <div class="content">
      <div class="info-box">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

          <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
              <h4 class="panel-title"> <a role="button" data-toggle="collapse" data-parent="#accordion" href="#" aria-expanded="true" aria-controls="collapseOne">Sertifikat Materi/Webinar</a> </h4>
            </div>
            <div id="materi">
              <div class="panel-body">
                <div class="row">
                  <div class="col-lg-12">
                    @if($errors->any())
                      @foreach($errors->all() as $error)
                        <div class="alert alert-danger" role="alert"> {{$error}} </div>
                      @endforeach
                    @endif
                  </div>
                  <div class="col-lg-6">
                    <div class="card ">
                      <div class="card-body">
                        <form action="/dashboard/tools_materi_save" method="POST" enctype="multipart/form-data">
                        @csrf
                          <div class="row">
                            <div class="col-md-12">
                                <div class="form-group has-feedback">
                                  <label class="control-label">Nama Tools/Aplikasi</label>
                                  <input class="form-control" name="id" type="hidden" value="{{ isset($tools->id) ? $tools->id : ''}}">
                                  <input class="form-control" name="title" type="text" placeholder="PHOTOSHOP" value="{{ isset($tools->link) ? $tools->title : ''}}" required>
                                  <label class="control-label mt-3">Link download</label>
                                  <input class="form-control" name="url" type="text" placeholder="https://" value="{{ isset($tools->link) ? $tools->link : ''}}" required>
                                </div>
                                <div class="form-group">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="text-black">Tambah Gambar</h4>
                                            <label for="input-file-now">Kosongkan jika tidak ada gambar</label>
                                            <input type="file" name="tools_img" id="input-file-now" class="dropify" data-default-file="/backend/image/tools-materi/default.png"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-4">
                              <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="card ">
                      <div class="card-body">
                        <p><i class="fa fa-exclamation text-warning"></i>&nbsp;&nbsp;Mentor dapat menambahkan tools atau aplikasi yang dibutuhkan materi dalam kelas </p>
                        <p>
                            {{-- <ol>
                                <li> File sertifikat dipack dalam bentuk zip/rar</li>
                                <li> File bisa diupload di Google Drive atau sejenisnya</li>
                                <li> Masukan link serifikat pada kolom yang sudah tersedia</li>
                                <li> Pilih matari terkait sertifikat</li>
                            </ol> --}}
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <div class="content">

    </div>
    <!-- /.content -->
@endsection
