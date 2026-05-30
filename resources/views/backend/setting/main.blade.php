@extends('backend.layouts.master')
@section('content')
<div class="content-header sty-one">
    <h1 class="text-black">Setting</h1>
    <ol class="breadcrumb">
    <li><a href="#">Dashboard</a></li>
    <li class="sub-bread"><i class="fa fa-angle-right"></i> setting</li>
    </ol>
</div>

<div class="content">
    <div class="info-box">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            @if(Session::has('success'))
            <div class="alert alert-success" role="alert">{{session()->get('success')}}  </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                <div class="card p-3">
                    <h4 class="text-black">List level <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><button class="btn btn-sm btn-dark"><li class="fa fa-plus"></li></button></a></h4>
                    <ul class="list-group">
                    @foreach($levels as $level)
                    <li class="list-group-item d-flex justify-content-between align-items-center">{{ucfirst($level->name)}} <span class="badge badge-danger badge-pill"><a href="/dashboard/admin/setting/level_delete/{{$level->id}}" style="color:#fff;"><i class="fa fa-minus"></i></a></span></li>
                    @endforeach
                    </ul>
                </div>
                    <h4 class="panel-title">  </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <div class="col-lg-4">
                            <fieldset class="form-group">
                            <label>Level</label>
                            <form action="/dashboard/admin/setting/level_add" method="post">
                            @csrf
                                <input class="form-control" name="level" id="basicInput" type="text">
                                <button type='submit' class='btn btn-sm btn-primary mt-2'>tambah</button>
                            </form>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="info-box">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            @if(Session::has('appname'))
            <div class="alert alert-success" role="alert">{{session()->get('appname')}}  </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                <div class="card p-3">
                    <h4 class="text-black">Profile G-Academy <a role="button" data-toggle="collapse" data-parent="#accordion" href="#profilegacademy" aria-expanded="true" aria-controls="collapseOne"><button class="btn btn-sm btn-dark"><li class="fa fa-plus"></li></button></a></h4>

                </div>
                    <h4 class="panel-title">  </h4>
                </div>
                <div id="profilegacademy" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <form action="/dashboard/admin/setting/appname" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                            </div>
                            <div class="col-12">
                            <fieldset class="form-group">
                                <label>App Name</label>
                                <input class="form-control" name="id" id="basicInput" type="text" value="{{ $data['app']['id'] }}" hidden>
                                <input class="form-control" name="name" id="basicInput" type="text" value="{{ $data['app']['name'] }}">
                            </fieldset>
                            <fieldset class="form-group">
                                <label>Deskripsi</label>
                                <textarea class="form-control" name="about" id="description">{!! $data['app']['about'] !!}</textarea>
                            </fieldset>
                            <fieldset class="form-group">
                                <label>Email</label>
                                <input class="form-control" name="email" id="basicInput" type="email" value="{{ $data['app']['email'] }}">
                            </fieldset>
                            <fieldset class="form-group">
                                <label>HP/Whatsapp</label>
                                <input class="form-control" name="hp" id="basicInput" type="number" value="{{ $data['app']['phone'] }}">
                            </fieldset>
                            <fieldset class="form-group">
                                <label>Diplay URL</label>
                                <input class="form-control" name="link" id="basicInput" type="text" value="{{ $data['app']['url'] }}">
                            </fieldset>
                            <fieldset class="form-group">
                                <label>Address</label>
                                <input class="form-control" name="address" id="basicInput" type="text" value="{{ $data['app']['address'] }}">
                            </fieldset>

                            <fieldset class="form-group">
                                <label>Logo</label>
                                <div class="card">
                                    <div class="card-body">
                                        <label for="input-file-now">Only image 180:50</label>
                                        <input type="file" name="image" id="input-file-now" class="dropify" data-default-file="{{ $data['app']['logo'] }}"/>
                                    </div>
                                </div>
                            </fieldset>
                            <button type='submit' class='btn btn-primary mt-2'>SIMPAN</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="info-box">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            @if(Session::has('rekening'))
            <div class="alert alert-success" role="alert">{{session()->get('rekening')}}  </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                <div class="card p-3">
                    <h4 class="text-black">Main Rekening <a role="button" data-toggle="collapse" data-parent="#accordion" href="#rekening" aria-expanded="true" aria-controls="collapseOne"><button class="btn btn-sm btn-dark"><li class="fa fa-plus"></li></button></a></h4>
                </div>
                    <h4 class="panel-title">  </h4>
                </div>
                <div id="rekening" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <form action="/dashboard/admin/setting/appname" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                            </div>
                            <div class="col-12">
                            <fieldset class="form-group">
                                <label>NAME</label>
                                <input class="form-control" name="id" id="basicInput" type="text" value="{{ $data['app']['id'] }}" hidden>
                                <input class="form-control" name="rekening_name" id="basicInput" type="text" value="{{ $data['app']['rekening_name'] }}">
                            </fieldset>
                            <fieldset class="form-group">
                                <label>NOMOR</label>
                                <input class="form-control" name="rekening_number" id="basicInput" type="number" value="{{ $data['app']['rekening_number'] }}">
                            </fieldset>
                            <fieldset class="form-group">
                                <label>BANK</label>
                                <input class="form-control" name="bank_name" id="basicInput" type="text" value="{{ $data['app']['bank_name'] }}">
                            </fieldset>

                            <button type='submit' class='btn btn-primary mt-2'>SIMPAN</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content -->
@endsection
