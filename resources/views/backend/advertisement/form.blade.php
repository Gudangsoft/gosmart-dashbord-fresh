@extends('backend.layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header sty-one">
      <h1 class="text-black">{{ $data['meta']['title'] }}</h1>
      <ol class="breadcrumb">
        <li><a href="#">Dashboard</a></li>
        <li class="sub-bread"><i class="fa fa-angle-right"></i> {{ $data['meta']['title'] }}</li>
        <li class="sub-bread"><i class="fa fa-angle-right"></i> {{ $data['meta']['type'] }}</li>
      </ol>
    </div>

    <!-- Main content -->
    <div class="content">
      <div class="info-box">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

          <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
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
                    @if(Session::has('error'))
                      <div class="alert alert-error" role="alert">{{session()->get('error')}}  </div>
                    @endif
                    @if(Session::has('success'))
                      <div class="alert alert-success" role="alert">{{session()->get('success')}}  </div>
                    @endif
                  </div>
                  <div class="col">
                    <div class="card ">
                      <div class="card-body">
                        <form action="/dashboard/advertisement_save" method="POST" enctype="multipart/form-data">
                        @csrf
                          <div class="row">
                            <div class="col-md-12">
                                <div class="form-group has-feedback">
                                  <label class="control-label">Information or promotion</label>
                                  <input class="form-control" hidden name="type" type="text" value="{{ $data['meta']['type'] }}">
                                  <input class="form-control" hidden name="id" type="text" value="{{ $data['data']['id'] }}">
                                  <input class="form-control" name="title" type="text" placeholder="Diskon class laravel 10%" value="{!! $data['data']['text'] !!}" required>
                                  <label class="control-label mt-3">Url</label>
                                  <input class="form-control" name="url" type="text" placeholder="https://" value="{{ $data['data']['url'] }}" required>
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
