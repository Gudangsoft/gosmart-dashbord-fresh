@extends('backend.layouts.master')
@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header sty-one">
      <h1 class="text-black">sertifikat</h1>
      <ol class="breadcrumb">
        <li><a href="#">Dashboard</a></li>
        <li class="sub-bread"><i class="fa fa-angle-right"></i> sertifikat</li>
      </ol>
    </div>
    <!-- Main content -->
    <div class="content">
        <div class="info-box">
            <!-- <h4 class="text-black">Cards</h4>
            <p>A <strong>card</strong> is a flexible and extensible content container. It includes options for headers and footers, a wide variety of content, contextual background colors, and powerful display options.</p> -->
            @if(Session::has('success'))
                <div class="alert alert-success" role="alert">{{session()->get('success')}}  </div>
            @endif
            <div class="row">
                <div class="col">
                    <h4 class="text-black">Data Sertifikat</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="bg-primary text-white">
                            <tr>
                                <th scope="col">Materi</th>
                                <th scope="col">Link</th>
                                <th scope="col">Upload By</th>
                                <th scope="col">Opsi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rows as $row)
                            <tr>
                                <td>{{$row->materi->judul}}</td>
                                <td>{{$row->link}}</td>
                                <td>{{$row->user->name}}</td>
                                <td>
                                    <div class="btn-group m-1">
                                        <button type="button" class="btn btn-sm btn-default">Pilih</button>
                                        <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> <span class="sr-only">Toggle Dropdown</span> </button>
                                        <ul class="dropdown-menu" role="menu">
                                        <li><a style='color:#f00;' href="/dashboard/user/delete/{{$row->id}}" onclick="return confirm('yakin hapus ?')">delete</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                {{$rows->links()}}
            </div>
        </div>
      <!-- Main row -->
    </div>
    <!-- /.content -->
@endsection
