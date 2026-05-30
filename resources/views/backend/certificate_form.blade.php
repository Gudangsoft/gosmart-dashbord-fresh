@extends('backend.layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header sty-one">
      <h1 class="text-black">Sertifikat</h1>
      <ol class="breadcrumb">
        <li><a href="#">Dashboard</a></li>
        <li class="sub-bread"><i class="fa fa-angle-right"></i> sertifikat</li>
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
                    @if(Session::has('success'))
                      <div class="alert alert-success" role="alert">{{session()->get('success')}}  </div>
                    @endif
                    @if(Session::has('error'))
                      <div class="alert alert-error" role="alert">{{session()->get('error')}}  </div>
                    @endif
                  </div>
                  <div class="col-lg-6">
                    <div class="card ">
                      <div class="card-body">
                        <form action="/dashboard/certificate_save" method="POST" enctype="multipart/form-data">
                        @csrf
                          <div class="row">
                            <div class="col-md-12">
                                {{-- <input type="hidden" value="{{}}"> --}}
                                <div class="form-group">
                                    <label class="control-label">Logo Mitra</label>
                                        <i for="input-file-now" class="text-danger">* Maksimal 1000 x 1000 pixel</i>
                                        <input type="file" name="mitra" id="input-file-now" class="dropify" data-default-file="{{ isset($data['mitra_image']) ? $data['mitra_image'] : ''}}"/>
                                </div>
                                <div class="form-group">
                                  <label class="control-label">Kelas</label>
                                  <select class="form-control custom-select" name="class_id" required>
                                    @foreach($kelas as $k)
                                      <option value="{{$k->class_id}}">{{strtoupper($k->name)}}</option>
                                    @endforeach
                                  </select>

                                </div>
                            </div>
                            <div class="col-md-12 mt-4">
                              <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="card ">
                      <div class="card-body">
                        <p><i class="fa fa-exclamation text-warning"></i>&nbsp;&nbsp;Mentor dapat menambahkan logo mitra atau logo kolaborasi kerjasama dengan kententuan ukuran logo sesuai keterangan upload dan usahakan dalam format PNG agar gambar yang ditampilkan lebih jelas </p>

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
