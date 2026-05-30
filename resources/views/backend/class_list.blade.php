@extends('backend.layouts.master')
@section('content')
    @include('sweetalert::alert')
    <div class="content-header sty-one">
        <h1 class="text-black">Data Kelas</h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard">Dashboard</a></li>
            <li class="sub-bread"><i class="fa fa-angle-right"></i> Kelas</li>
        </ol>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="mb-2">
            <a href="/dashboard/class_add/new" class="btn btn-sm btn-success"> <i
                    class="fa fa-plus"></i>&nbsp;&nbsp;tambah</a>
        </div>
        <div class="info-box">
            <p>Export data to Copy, CSV, Excel, PDF & Print</p>
            @if (Session::has('sukses'))
                <div class="alert alert-success" role="alert">Data berhasil diupdate </div>
            @endif
            @if (Session::has('delete'))
                <div class="alert alert-success" role="alert">Data berhasil dihapus </div>
            @endif
            <div class="table-responsive">
                <table id="example2" class="table table-bordered table-hover" data-name="cool-table">
                    <thead>
                        <tr>
                            <th>IDR</th>
                            <th>Class Name</th>
                            <th>Add By</th>
                            <th>Pelanggan</th>
                            <th>Created at</th>
                            <th>ٍAction</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['class'] as $k => $v)
                            <tr>
                                <td>
                                    @if ($v['discount'] != 0)
                                        <s>{{ number_format($v['price'], 0, ',', '.') }}</s>
                                    @else
                                        {{ number_format($v['price'], 0, ',', '.') }}
                                    @endif
                                    @if ($v['discount'] != 0)
                                        <span
                                            class='label label-success'>{{ number_format($v['discount'], 0, ',', '.') }}</span>
                                    @endif
                                </td>
                                <td><a href="/dashboard/class/detail/{{ $v['class_id'] }}">{!! ucwords($v['name']) !!}&nbsp;&nbsp;<i
                                            class="fa fa-eye"></i></a></td>
                                <td>{{ $v['add_by'] }}</td>
                                <td>{{ $v['count_subs'] }}</td>
                                <td>{{ $v['add_date'] }}</td>
                                <td>
                                    <div class="btn-group m-1">
                                        <a href="{{ config('app.url') }}/course/{{ $v['slug'] }}" title="pertinjau web"
                                            class="btn btn-sm btn-default p-2"><i class="fa fa-external-link"></i></a>
                                        {{-- <a href="#" title="Join Class" class="btn btn-sm btn-dark p-2" data-toggle="modal" data-target="#exampleModal{{ $v['class_id'] }}"><i class="fa fa-link"></i></a> --}}
                                        <a href="/dashboard/class_add/{{ $v['class_id'] }}" title="edit"
                                            class="btn btn-sm btn-success p-2"><i class="fa fa-pencil"></i></a>
                                        <a href="/dashboard/class-status/{{ $v['class_id'] }}/{{ $v['status'] }}"
                                            class="btn btn-sm {{ $v['status'] == 'p' ? 'btn-warning' : 'btn-dark' }} p-2"><i
                                                class="fa {{ $v['status'] == 'p' ? 'fa-check' : 'fa-remove' }}"></i></a>
                                        <a href="/dashboard/class_delete/{{ $v['class_id'] }}" title="delete"
                                            class="btn btn-sm btn-danger p-2"
                                            onclick="return confirm('Menghapus dapat menghilangkan semua data terkait   . Yakin hapus ?')"><i
                                                class="fa fa-trash"></i></a>
                                    </div>

                                    <div class="modal fade" id="exampleModal{{ $v['class_id'] }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Join Class</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                @if ($data['join'] == null)
                                                    <div class="modal-body">
                                                        <h3>Coming soon...</h3>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">OK</button>
                                                    </div>
                                                @else
                                                    <form action="/dashboard/join_class" method="post">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <label class="control-label">Selected</label>
                                                            <input type="hidden" name="parent_id"
                                                                value="{{ $v['class_id'] }}" id="">
                                                            <select class="form-control custom-select" style="width:250px;"
                                                                name="kelas">
                                                                @foreach ($data['join']['data'] as $a => $b)
                                                                    @if ($b['id'] != $v['class_id'])
                                                                        <option value="{{ $b['id'] }}">
                                                                            {{ $b['name'] }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                        </div>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.content -->

    <!-- Modal -->
@endsection
