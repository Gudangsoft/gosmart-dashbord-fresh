@extends('backend.layouts.master')
@section('content')
<div class="content-header sty-one">
    <h1 class="text-black">Karya Member</h1>
    <ol class="breadcrumb">
    <li><a href="#">Home</a></li>
    <li class="sub-bread"><i class="fa fa-angle-right"></i> Admin</li>
    <li><i class="fa fa-angle-right"></i> Karya Member</li>
    </ol>
</div>

<div class="content">
    <div class="info-box">
        <h4 class="text-black">Data Export</h4>
        <p>Export data to Copy, CSV, Excel, PDF & Print</p>
        @if(Session::has('sukses'))
        <div class="alert alert-success" role="alert">Data berhasil diupdate  </div>
        @endif
        @if(Session::has('hidden'))
        <div class="alert alert-success" role="alert">Data berhasil dihidden  </div>
        @endif
        @if(Session::has('delete'))
        <div class="alert alert-success" role="alert">Data berhasil dihapus  </div>
        @endif
        <div class="table-responsive">
            <table id="example2" class="table table-bordered table-hover" data-name="cool-table">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Link</th>
                    <th>Create By</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
            @foreach($creations as $creation)
                <tr>
                    <td>{{$creation->name}}</td>
                    <td>{{$creation->url}}</td>
                    <td>{{$creation->getUser->name}}</td>
                    <td>
                        <a href="{{ $creation->url }}" class="btn btn-primary btn-sm">Open</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
