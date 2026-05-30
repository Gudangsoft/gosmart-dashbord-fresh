@extends('backend.layouts.master')
@section('content')
<div class="content-header sty-one">
    <h1 class="text-black">Join Class</h1>
    <ol class="breadcrumb">
    <li><a href="#">Dashboard</a></li>
    <li class="sub-bread"><i class="fa fa-angle-right"></i>Join Class</li>
    </ol>
</div>

<!-- Main content -->
<div class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3">

        <!-- Profile Image -->
        <div class="box box-primary">
            <p class="text-right"><a href="/dashboard/channel_add/{{$data['id']}}" class="btn btn-sm btn-success m-2"><i class="fa fa-pencil"> </i> Edit</a></p>
            <div class="box-profile"> <img class="profile-user-img img-responsive img-circle" src="{{('/chanel-image')}}/{{$data['img']}}" alt="User profile picture">
            <h3 class="profile-username text-center">{{$data['name']}}</h3>
            <p class="text-muted text-center">{!!$channel_cek->deskripsi!!}</p>
            <ul class="list-group mt-5">
                @foreach($jumlah_data as $v)
                    <li class="list-group-item d-flex justify-content-between align-items-center"> {{$v->getClass->name}} <span class="badge badge-primary badge-pill">{{$v->jumlah}}</span> </li>
                @endforeach
            </ul>
            </div>
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
      <div class="col-lg-9">
        <div class="info-box">
          <div class="box-body">
            <div class="right-page-header">
              <div class="d-flex">
                <div class="align-self-center">
                  <h4 class="text-black m-b-1">Video Channel</h4>
                </div>
              </div>
            </div>
            @if (Session::has('msg'))
                <div class="alert alert-success alert-dismissible fade show" role="alert"> {{session()->get('msg')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                </div>
            @endif
            <div class="table-responsive">
              <table id="channel" class="table table-bordered table-hover no-wrap">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Visitor</th>
                    <th>Status</th>
                    <th>Class</th>
                    <th>Add Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @if (!empty($data['row']))
                        @foreach ($data['row'] as $k=>$v)
                            <tr>
                                <td>{!!$v['title']!!}</td>
                                <td>{{$v['visitor']}}</td>
                                <td>
                                    @if($v['premium'] == true)
                                        <span class="label label-warning">premium</span>
                                    @else
                                        <span class="label label-danger">free</span>
                                    @endif
                                </td>
                                <td><span class="label label-success">{{$v['class']}}</span></td>
                                <td>{{$v['date']}}</td>
                                <td>
                                    <div class="btn-group m-1">
                                        <a href="/learning/channel_detail/{{$v['id']}}" class="btn btn-sm btn-default p-2"><i class="fa fa-eye"></i></a>
                                        <a href="/dashboard/materi_add/{{$v['materi_id']}}" class="btn btn-sm btn-success p-2"><i class="fa fa-pencil"></i></a>
                                        <a href="/dashboard/channel/video_delete/{{$v['id']}}" onclick="return confirm('yakin hapus ?')" class="btn btn-sm btn-danger p-2"><i class="fa fa-trash"></i></a>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center"><h4>Belum ada materi terkait</h3></td>
                        </tr>
                    @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- Main row -->
  </div>
  <!-- /.content -->


@endsection
