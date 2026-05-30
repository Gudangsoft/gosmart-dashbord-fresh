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

    <div class="info-box">
        <p>
            <h3>Semua materi</h3>
            <a class="btn btn-sm btn-success" href="/dashboard/materi_add/0"><i class="fa fa-plus"></i> Tambah</a>
        </p>
        <div class="table-responsive">
            <div class="row mb-2">
                <div class="col-md-9">
                    {{-- <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-info">Multi Action </button>
                        <button type="button" class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> <span class="caret"></span> <span class="sr-only">Toggle Dropdown</span> </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="javascript:void(0)" id="aksi_hide">Hidden</a></li>
                            <li><a href="javascript:void(0)" id="aksi_delete">Delete</a></li>
                        </ul>
                    </div> --}}
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
                <th class="text-center"><input type="checkbox" id="selectAll"></th>
                <th>ID #</th>
                <th>Title</th>
                <th>Status</th>
                <th>Created at</th>
                <th>ٍAction</th>
                </tr>
            </thead>
            <tbody>
            @if (isset($view_stream))
                @foreach($view_stream as $row)
                <tr>
                <td class="text-center"><input type="checkbox" name="id[]" id="{{$row->id}}" value="{{$row->id}}"></td>

                <td>{{$row->id}}</td>
                <td>{{$row->judul}}</td>
                <!-- <td>Sed cursus dapibus diam</td> -->
                @if($row->premium == true)
                    <td><span class="label label-success">premium</span></td>
                @else
                    <td><span class="label label-danger">free</span></td>
                @endif
                <td>{{$row->created_at}}</td>
                {{-- <td>{{ucwords($row->chanel->nama_chanel)}}</td> --}}
                <td>
                    <div class="btn-group m-1">
                        {{-- <a href="/dashboard/add_to_channel/{{$row->id}}" title="Add to channel" class="btn btn-sm btn-default p-2"><i class="fa fa-plus"></i></a> --}}
                        <a href="/dashboard/materi_add/{{$row->id}}" class="btn btn-sm btn-success p-2"><i class="fa fa-pencil"></i></a>
                        @if($row->status == 'h')
                            <a href="/dashboard/video_status/{{$row->id}}/{{$row->status}}" class="btn btn-sm btn-warning p-2"><i class="fa fa-ban"></i></a>
                        @else
                            <a href="/dashboard/video_status/{{$row->id}}/{{$row->status}}" class="btn btn-sm btn-primary p-2"><i class="fa fa-check"></i></a>
                        @endif
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

@section('page-script')
<script>
    $(function () {
        $('#selectAll').click(function(){
            $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
        });
        $('#aksi_publish').click(function(){
            var jml = $('input[name="id[]"]:checked').length;
            if(jml < 1){
                alert('Silahkan Pilih data yang akan di publish');
            }else{
                r = confirm('Anda akan publish data?');
                if(r == true){
                    $('#tipe_aksi').val('p');
                    $('#aksi').submit();
                }
            }
        });
        $('#aksi_hide').click(function(){
            var jml = $('input[name="id[]"]:checked').length;
            if(jml < 1){
                alert('Silahkan Pilih data yang akan di hidden');
            }else{
                r = confirm('Anda akan hidden data?');
                if(r == true){
                    $('#tipe_aksi').val('h');
                    $('#aksi').submit();
                }
            }
        });
        $('#aksi_delete').click(function(){
            var jml = $('input[name="id[]"]:checked').length;
            if(jml < 1){
                alert('Silahkan Pilih data yang akan di hapus');
            }else{
                r = confirm('Anda akan hapus data?');
                if(r == true){
                    $('#tipe_aksi').val('d');
                    $('#aksi').submit();
                }
            }
        });
    });
</script>

@endsection
