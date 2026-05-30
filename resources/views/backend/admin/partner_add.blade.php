@extends('backend.layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header sty-one">
        <h1 class="text-black">Partner Form</h1>
        <ol class="breadcrumb">
            <li><a href="#">Dashboard</a></li>
            <li class="sub-bread"><i class="fa fa-angle-right"></i> Admin</li>
            <li class="sub-bread"><i class="fa fa-angle-right"></i> Partner</li>
        </ol>
    </div>

    <!-- Main content -->
    <div class="content">
      <div class="info-box">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

          <div class="panel panel-default">
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
                        <form action="/dashboard/partner_save" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group">
                                <label>Title</label>
                                <div class="input-group">
                                    <input class="form-control" name="id" id="exampleInputuname" placeholder="x" type="hidden" value="{{$data['id']}}">
                                    <input class="form-control" name="action" id="exampleInputuname" placeholder="x" type="hidden" value="{{$data['action']}}">
                                    <input class="form-control" name="title" id="exampleInputuname" placeholder="Nama partner" type="text" value="{{$data['title']}}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Link</label>
                                <div class="input-group">
                                    <input class="form-control" name="url" id="exampleInputuname" placeholder="https://" type="text" value="{{$data['url']}}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    {{-- <input type="hidden" value="{{}}"> --}}
                                    <div class="form-group">
                                        <label class="control-label">Logo Partner</label>
                                            <i for="input-file-now" class="text-danger">* Maksimal 1000 x 1000 pixel</i>
                                            <input type="file" name="partner_image" id="input-file-now" class="dropify" data-default-file="{{ isset($data['path_image']) ? $data['path_image'] : ''}}" {{ $data['action'] == 'edit' ? '' : 'required' }}/>
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
                        <p><i class="fa fa-exclamation text-warning"></i>&nbsp;&nbsp;Tambakan partner dengan logo dan link untuk saling terhubung </p>

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
@endsection
