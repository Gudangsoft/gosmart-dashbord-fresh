@extends('backend.layouts.master')
@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header sty-one">
      <h1 class="text-black">Live Streaming Youtube</h1>
      <ol class="breadcrumb">
        <li><a href="#">Dashboard</a></li>
        <li class="sub-bread"><i class="fa fa-angle-right"></i> Live Streaming</li>
      </ol>
    </div>


<!-- Main content -->
<div class="content">
    @if(Session::has('add'))
        <div class="alert alert-success" role="alert">Data berhasil ditambahkan </div>
    @endif
    @if(Session::has('sukses'))
        <div class="alert alert-success" role="alert">Data berhasil diupdate  </div>
    @endif
    @if(Session::has('hidden'))
        <div class="alert alert-warning" role="alert">Data berhasil dihidden  </div>
    @endif
    @if(Session::has('delete'))
        <div class="alert alert-danger" role="alert">Data berhasil dihapus  </div>
    @endif


    <div class="mb-2">
        <a href="/dashboard/livestream/0" class="btn btn-sm btn-success"> <i class="fa fa-plus"></i>&nbsp;&nbsp;tambah</a>
    </div>

    <div class="info-box">
        <div class="table-responsive">
            <table id="all-materi" class="table table-bordered table-hover" data-name="cool-table">
            <thead>
                <tr>
                <th>ID #</th>
                <th>Title</th>
                <th>Link</th>
                <th>Add By</th>
                <th>Created at</th>
                <th>ٍAction</th>
                </tr>
            </thead>
            <tbody>
            @if (isset($data))
                @if (empty($data))
                    <td colspan="8" class="text-center"> Data tidak tersedia</td>
                @else
                    @foreach($data as $k=>$v)
                    <tr>
                        <td>{{$v['id']}}</td>
                        <td>{{$v['title']}}</td>
                        <td><a href="https://www.youtube.com/watch?v={{$v['youtube_id']}}">https://www.youtube.com/watch?v={{$v['youtube_id']}}</a></td>
                        <td>{{$v['add_by']}}</td>
                        <td>{{$v['created_at']}}</td>
                        <td>
                            <div class="btn-group m-1">
                                <a href="/dashboard/livestream/{{$v['id']}}" class="btn btn-sm btn-success p-2"><i class="fa fa-pencil"></i></a>
                                @if($v['status'] == 'h')
                                    <a href="/dashboard/livestream_status/{{$v['id']}}/{{$v['status']}}" class="btn btn-sm btn-warning p-2"><i class="fa fa-ban"></i></a>
                                @else
                                    <a href="/dashboard/livestream_status/{{$v['id']}}/{{$v['status']}}" class="btn btn-sm btn-primary p-2"><i class="fa fa-check"></i></a>
                                @endif
                                <a href="/dashboard/livestream_delete/{{$v['id']}}" class="btn btn-sm btn-danger p-2" onclick="return confirm('Menghapus dapat menghilangkan semua data terkait   . Yakin hapus ?')"><i class="fa fa-trash"></i></a>

                            </div>
                        </td>
                        {{-- <td>{{$v['id']}}</td>
                        <td>{{$v->judul}}</td>
                        <td>{{$v->level}}</td>
                        <!-- <td>Sed cursus dapibus diam</td> -->
                        @if($v->premium == true)
                            <td><span class="label label-warning">premium</span></td>
                        @else
                            <td><span class="label label-danger">free</span></td>
                        @endif
                        <td>{{$v->created_at}}</td>
                        <td>{{ucwords($v->chanel->nama_chanel)}}</td>
                        <td class="text-center">
                            @if($v['status'] == 'h')
                                <a href="/dashboard/livestream_status/{{$v['id']}}/{{$v['status']}}"><i class="fa fa-ban text-red"></i></a>
                            @else
                                <a href="/dashboard/livestream_status/{{$v['id']}}/{{$v['status']}}"><i class="fa fa-check"></i></a>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group m-1">
                                <a href="/dashboard/add_to_channel/{{$v['id']}}" title="Add to channel" class="btn btn-sm btn-default p-2"><i class="fa fa-plus"></i></a>
                                <a href="/dashboard/materi_add/{{$v['id']}}" class="btn btn-sm btn-success p-2"><i class="fa fa-pencil"></i></a>
                                <a href="/dashboard/video_delete/{{$v['id']}}" class="btn btn-sm btn-danger p-2" onclick="return confirm('Menghapus dapat menghilangkan semua data terkait   . Yakin hapus ?')"><i class="fa fa-trash"></i></a>

                            </div>

                        </td> --}}
                    </tr>
                    @endforeach
                @endif
            @endif

            </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.content -->
@endsection
