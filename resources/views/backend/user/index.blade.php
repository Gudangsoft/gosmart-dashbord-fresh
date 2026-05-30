@extends('backend.layouts.master')
@section('content')
@include('sweetalert::alert')

<!-- Content Header (Page header) -->
<div class="content-header sty-one">
    <h1 class="text-black">Pengumuman</h1>
    <ol class="breadcrumb">
        <li><a href="#">Dashboard</a></li>
        <li class="sub-bread"><i class="fa fa-angle-right"></i> Pengumuman</li>
    </ol>
</div>


<!-- Main content -->
<div class="content">

    <div class="info-box">
        <p>
            <a class="btn btn-success" href="{{ route('announcement-created') }}"><i class="fa fa-plus"></i> Tambah</a>
        </p>
        <div class="table-responsive">
            <table id="all-materi" class="table table-bordered table-hover" data-name="cool-table">
            <thead>
                <tr>
                <th>ID #</th>
                <th>Title</th>
                <th>Akses</th>
                <th>Pop Up</th>
                <th>Created by</th>
                <th>Created at</th>
                <th>ٍAction</th>
                </tr>
            </thead>
            <tbody>
            @if (isset($data['announcement']))
                @foreach($data['announcement']['data'] as $k=>$v)
                <tr>
                <td>{{$v['id']}}</td>
                <td>{{$v['title']}}</td>
                @if($v['status'] == 1)
                    <td><span class="label label-success">semua</span></td>
                @elseif($v['status'] == 2)
                    <td><span class="label label-danger">dashboard</span></td>
                @elseif($v['status'] == 3)
                    <td><span class="label label-primary">Member</span></td>
                @endif
                @if($v['type'] == 1)
                    <td><span class="label label-primary">aktif</span></td>
                @else
                    <td><span class="label label-warning">nonaktif</span></td>
                @endif
                <td>{{$v['created_by']}}</td>
                <td>{{$v['created_at']}}</td>
                <td>
                    <div class="btn-group m-1">
                        <a href="{{ route('announcement-edit', $v['id']) }}" class="btn btn-sm btn-success p-2"><i class="fa fa-pencil"></i></a>
                        <a href="{{ route('announcement-delete', $v['id']) }}" class="btn btn-sm btn-danger p-2" onclick="return confirm('Menghapus dapat menghilangkan semua data terkait   . Yakin hapus ?')"><i class="fa fa-trash"></i></a>
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
@endsection
