@extends('backend.layouts.master')
@section('content')
@include('sweetalert::alert')

<div class="content-header sty-one">
    <h1 class="text-black">kategori</h1>
    <ol class="breadcrumb">
    <li><a href="#">Dashboard</a></li>
    <li class="sub-bread"><i class="fa fa-angle-right"></i> Kelas</li>
    <li class="sub-bread"><i class="fa fa-angle-right"></i> Kategori</li>
    </ol>
</div>

<div class="content">

    <div class="info-box">
        <p>
            <a class="btn btn-success" href="#" data-toggle="modal" data-target="#modalCategoryCreate"><i class="fa fa-plus"></i> Tambah</a>
            @include('backend.category.modal-created')
        </p>
        <div class="table-responsive">
            <div class="row mb-2">
                <div class="col-md-9">
                </div>
            </div>
            <table id="all-materi" class="table table-bordered table-hover" data-name="cool-table">
            <thead>
                <tr>
                <th>No</th>
                <th>Title</th>
                <th>Created By</th>
                <th>Status</th>
                <th>ٍAction</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($data['category']))
                    @foreach ($data['category'] as $k=>$v)
                        <tr>
                            <td>{{ ++$k }}</td>
                            <td>{{ $v->title }}</td>
                            <td>{{ $v->getUser->name }}</td>
                            <td>
                                @if ($v->status == 1)
                                    <a href="{{ route('category.status', [$v->id, $v->status]) }}"><i class="fa fa-check text-green"></i></a>
                                @else
                                    <a href="{{ route('category.status', [$v->id, $v->status]) }}"><i class="fa fa-ban text-red"></i></a>
                                @endif
                            </td>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#modalCategoryEdit{{ $v->id }}" class="btn btn-sm btn-success p-2"><i class="fa fa-pencil"></i></a>
                                <a href="{{ route('category.delete', $v->id) }}" class="btn btn-sm btn-danger p-2" onclick="return confirm('Menghapus dapat menghilangkan semua data terkait   . Yakin hapus ?')"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @include('backend.category.modal-edit')
                    @endforeach
                @endif
            </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
