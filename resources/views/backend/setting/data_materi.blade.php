@extends('backend.layouts.master')
@section('content')
<div class="content-header sty-one">
    <h1 class="text-black">Semua Materi</h1>
    <ol class="breadcrumb">
    <li><a href="#">Dashboard</a></li>
    <li class="sub-bread"><i class="fa fa-angle-right"></i> Admin</li>
    <li class="sub-bread"><i class="fa fa-angle-right"></i> Materi</li>
    </ol>
</div>
<!-- Main content -->
<div class="content">
    <div class="info-box">
        <!-- <p>Data Table With Full Features</p> -->
        @if(Session::has('sukses'))
        <div class="alert alert-success" role="alert">Data berhasil diupdate  </div>
        @endif
        <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Judul</th>
                <th>Link</th>
                <th>Keterangan</th>
                <th>Kategori</th>
                <th>Opsi</th>
            </tr>
            </thead>
            <tbody>
            @foreach($materi as $mat)
            <tr>
                <td>{{ucfirst($mat->judul)}}</td>
                <td>{{$mat->link}}</td>
                <td>{{$mat->keterangan}}</td>
                <td>{{$mat->kategori}}</td>
                <td>
                    <div class="btn-group m-1">
                        <button type="button" class="btn btn-sm btn-default">Pilih</button>
                        <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> <span class="sr-only">Toggle Dropdown</span> </button>
                        <ul class="dropdown-menu" role="menu">
                        @if($mat->status == 'p')
                            <li><a href="/dashboard/setting/video_status/{{$mat->id}}/{{$mat->status}}">hidden</a></li>
                        @else
                            <li><a href="/dashboard/setting/video_status/{{$mat->id}}/h">publish</a></li>
                        @endif
                        <li><a style='color:#f00;' href="/dashboard/video_delete/{{$mat->id}}" onclick="return confirm('yakin hapus ?')">delete</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
            @endforeach
            </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
