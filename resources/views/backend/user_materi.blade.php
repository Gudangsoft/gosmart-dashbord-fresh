@extends('backend.layouts.master')
@section('content')
@include('sweetalert::alert')

<!-- Content Header (Page header) -->
    <div class="content-header sty-one">
      <h1 class="text-black">Semua Materi</h1>
      <ol class="breadcrumb">
        <li><a href="#">Dashboard</a></li>
        <li class="sub-bread"><i class="fa fa-angle-right"></i> Materi</li>
      </ol>
    </div>


<!-- Main content -->
<div class="content">
    {{-- @if(Session::has('sukses'))
        <div class="alert alert-success" role="alert">Data berhasil diupdate  </div>
    @endif
    @if(Session::has('hidden'))
        <div class="alert alert-warning" role="alert">Data berhasil dihidden  </div>
    @endif --}}
    {{-- @if(Session::has('delete'))
        <div class="alert alert-danger" role="alert">Data berhasil dihapus  </div>
    @endif --}}


    <div class="info-box">
        <p>
            <a class="btn btn-success" href="/dashboard/materi_add/0"><i class="fa fa-plus"></i> Tambah</a>
        </p>
        <div class="table-responsive">
            <div class="row mb-2">
                <div class="col-md-9">
                </div>
                <div class="col-md-3">
                    <form action="/dashboard/class_filter" method="post">
                    @csrf
                        <select name="class_filter" class="form-control" id="" onchange="if(this.value != 0) {this.form.submit();}">
                            <option value="">filter kelas</option>
                            @if (isset($data['class']))
                                @foreach ($data['class'] as $k=>$v)
                                    <option value="{{ $v['class_id'] }}">{!! strtoupper($v['class_name']) !!}</option>
                                @endforeach
                            @endif
                        </select>
                    </form>
                </div>
            </div>
            <table id="all-materi" class="table table-bordered table-hover" data-name="cool-table">
            <thead>
                <tr>
                <th>ID #</th>
                <th>Title</th>
                <th>Status</th>
                <th>Created at</th>
                {{-- <th>Mentor</th> --}}
                <th>Show/Hide</th>
                <th>ٍAction</th>
                </tr>
            </thead>
            <tbody>
            @if (isset($view_stream))
                @foreach($view_stream as $row)
                <tr>
                <td>{{$row->id}}</td>
                <td>{{$row->judul}}</td>
                <!-- <td>Sed cursus dapibus diam</td> -->
                @if($row->getClass->premium == true)
                    <td><span class="label label-warning">premium</span></td>
                @else
                    <td><span class="label label-danger">free</span></td>
                @endif
                <td>{{$row->created_at}}</td>
                <td class="text-center">
                    @if($row->status == 'h')
                        <a href="/dashboard/video_status/{{$row->id}}/{{$row->status}}"><i class="fa fa-ban text-red"></i></a>
                    @else
                        <a href="/dashboard/video_status/{{$row->id}}/{{$row->status}}"><i class="fa fa-check"></i></a>
                    @endif
                </td>
                <td>
                    <div class="btn-group m-1">
                        {{-- <a href="/dashboard/add_to_channel/{{$row->id}}" title="Add to channel" class="btn btn-sm btn-default p-2"><i class="fa fa-plus"></i></a> --}}
                        <a href="/dashboard/materi_add/{{$row->id}}" class="btn btn-sm btn-success p-2"><i class="fa fa-pencil"></i></a>
                        <a href="/dashboard/video_delete/{{$row->id}}" class="btn btn-sm btn-danger p-2" onclick="return confirm('Menghapus dapat menghilangkan semua data terkait   . Yakin hapus ?')"><i class="fa fa-trash"></i></a>

                    </div>

                </td>
                </tr>
                @endforeach
            @endif

            </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.content -->
@endsection
