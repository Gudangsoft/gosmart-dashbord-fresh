@extends('backend.layouts.master')
@section('content')
    <div class="content-header sty-one">
      <h1 class="text-black">{{ $data['meta']['title'] }}</h1>
      <ol class="breadcrumb">
        <li><a href="#">Dashboard</a></li>
        <li class="sub-bread"><i class="fa fa-angle-right"></i> {{ $data['meta']['title'] }}</li>
        <li class="sub-bread"><i class="fa fa-angle-right"></i> Tambah</li>
      </ol>
    </div>

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
                  </div>
                  <div class="col">
                    <div class="card ">
                      <div class="card-body">
                        <form action="{{ isset($data['data']) ? route('announcement-update') : route('announcement-save') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group has-feedback">
                                        <label class="control-label">Judul</label>
                                        <input class="form-control" hidden name="id" type="text" value="{{ isset($data['data']) ? $data['data']->id : '' }}">
                                        <input class="form-control" name="title" type="text" value="{!! isset($data['data']) ? $data['data']->title : '' !!}">
                                        <span class="fa fa-pencil form-control-feedback" aria-hidden="true"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group has-feedback">
                                        <label class="control-label">Akses</label>
                                        <select class="form-control"  name="akses">
                                            @if (isset($data['data']))
                                                <option value="{{ $data['data']->status }}">
                                                    @if ($data['data']->status == 1)
                                                        Semua
                                                    @elseif($data['data']->status == 2)
                                                        Dashboard
                                                    @elseif($data['data']->status == 3)
                                                        Member
                                                    @endif
                                                </option>
                                            @else
                                                <option value="">-- Pilih --</option>
                                            @endif
                                            <option value="1">Semua</option>
                                            <option value="2">Dashboard</option>
                                            <option value="3">Member</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group has-feedback">
                                        <label class="control-label">Pop Up</label>
                                        <select class="form-control" name="type">
                                            @if (isset($data['data']))
                                                <option value="{{ $data['data']->type }}">
                                                    @if ($data['data']->type == 1)
                                                        Aktif
                                                    @elseif($data['data']->type == 2)
                                                        Nonaktif
                                                    @endif
                                                </option>
                                            @else
                                                <option value="">-- Pilih --</option>
                                            @endif
                                            <option value="1">Aktif</option>
                                            <option value="2">Nonaktif</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group has-feedback">
                                        <label class="control-label">Content</label>
                                        <textarea class="form-control" name="content" id="placeTextarea" rows="3" placeholder="Bio">
                                            {!! isset($data['data']) ? $data['data']->content : '' !!}
                                        </textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                <button type="submit" class="btn btn-success">Submit</button>
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

    <div class="content">

    </div>
@endsection
