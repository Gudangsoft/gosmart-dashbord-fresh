@extends('backend.layouts.master')
@section('content')
<div class="content-header sty-one">
    <h1 class="text-black">Partner</h1>
    <ol class="breadcrumb">
    <li><a href="#">Dashboard</a></li>
    <li class="sub-bread"><i class="fa fa-angle-right"></i> Admin</li>
    <li class="sub-bread"><i class="fa fa-angle-right"></i> Partner</li>
    </ol>
</div>


<!-- Main content -->
<div class="content">
    @if(Session::has('success'))
    <div class="alert alert-success" role="alert">Data berhasil diupdate  </div>
    @endif
    @if(Session::has('hidden'))
    <div class="alert alert-dark" role="alert">Status berhasil diubah  </div>
    @endif
    @if(Session::has('delete'))
    <div class="alert alert-danger" role="alert">Data berhasil dihapus  </div>
    @endif
    <div class="info-box">
        <p>
            <a class="btn btn-success" href="/dashboard/partner_add/0"><i class="fa fa-plus"></i> Tambah</a>
        </p>
        <div class="table-responsive">

            <table id="all-materi" class="table table-bordered table-hover" data-name="cool-table">
            <thead>
                <tr>
                {{-- <th>ID #</th> --}}
                <th>Title</th>
                <th>Link</th>
                <th>Status</th>
                <th>Created at</th>
                <th>ٍAction</th>
                </tr>
            </thead>
            <tbody>
            @if (isset($data['partner']))
                @foreach($data['partner'] as $k=>$v)
                    <tr>
                    {{-- <td>{{$v['id']}}</td> --}}
                    <td>{{$v['title']}}</td>
                    <td><a href="{{$v['url']}}">{{$v['url']}}</a></td>
                    <td>
                        @if($v['status'] == 'h')
                            <button class="btn btn-sm btn-dark">hidden</button>
                        @else
                            <button class="btn btn-sm btn-success">publish</button>
                        @endif
                    </td>
                    <td>{{$v['date']}}</td>

                    <td>
                        <div class="btn-group m-1">
                            <a href="/dashboard/partner_update/{{$v['id']}}" class="btn btn-sm btn-success p-2"><i class="fa fa-pencil"></i></a>
                            @if($v['status'] == 'h')
                                <a href="/dashboard/partner_status/{{$v['id']}}/{{$v['status']}}" class="btn btn-sm btn-warning p-2"><i class="fa fa-ban"></i></a>
                            @else
                                <a href="/dashboard/partner_status/{{$v['id']}}/{{$v['status']}}" class="btn btn-sm btn-primary p-2"><i class="fa fa-check"></i></a>
                            @endif
                            <a href="/dashboard/partner_delete/{{$v['id']}}" class="btn btn-sm btn-danger p-2" onclick="return confirm('Menghapus dapat menghilangkan semua data terkait   . Yakin hapus ?')"><i class="fa fa-trash"></i></a>
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
