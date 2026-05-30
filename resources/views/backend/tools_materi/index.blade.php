@extends('backend.layouts.master')
@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header sty-one">
      <h1 class="text-black">Tools Materi</h1>
      <ol class="breadcrumb">
        <li><a href="#">Dashboard</a></li>
        <li class="sub-bread"><i class="fa fa-angle-right"></i> Tools materi</li>
      </ol>
    </div>
    <!-- Main content -->
    <div class="content">
        <div class="info-box">
            <h4 class="text-black mb-4">Tools Materi <a href="/dashboard/tools_materi/0" class="btn btn-sm btn-success p-2"><i class="fa fa-plus"></i></a></h4>
            @if(Session::has('success'))
                <div class="alert alert-success" role="alert">{{session()->get('success')}}  </div>
            @endif
            @if(Session::has('danger'))
                <div class="alert alert-danger" role="alert">{{session()->get('danger')}}  </div>
            @endif
            <div class="table-responsive">
                <table id="all-materi" class="table table-bordered table-hover" data-name="cool-table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Link</th>
                        <th scope="col">Upload By</th>
                        <th class="text-center" scope="col">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rows as $row)
                    <tr>
                        <td>{{$row->title}}</td>
                        <td>{{$row->link}}</td>
                        <td>{{$row->user->name}}</td>
                        <td class="text-center">
                            <div class="btn-group m-1">
                                @if (isset($data))
                                    @if ($data['opsi'] == true)
                                        <a href="/dashboard/tools_materi/{{$row->id}}" class="btn btn-sm btn-success p-2"><i class="fa fa-pencil"></i></a>
                                        <a href="/dashboard/tools_materi_delete/{{$row->id}}" class="btn btn-sm btn-danger p-2"><i class="fa fa-trash"></i></a>
                                    @else
                                        <a href="#" class="btn btn-sm btn-default p-2"><i class="fa fa-eye"></i></a>
                                    @endif
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
                </table>
            </div>
        </div>
      <!-- Main row -->
    </div>
    <!-- /.content -->
@endsection
