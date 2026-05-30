@extends('backend.layouts.master')
@section('content')
@include('sweetalert::alert')

<!-- Content Header (Page header) -->
<div class="content-header sty-one">
    <h1 class="text-black">Penarikan Dana</h1>
    <ol class="breadcrumb">
        <li><a href="#">Dashboard</a></li>
        <li class="sub-bread"><i class="fa fa-angle-right"></i> Admin</li>
        <li class="sub-bread"><i class="fa fa-angle-right"></i> Penarikan Dana</li>
    </ol>
</div>


<!-- Main content -->
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="info-box">
                <div class="row">
                    <div class="col-lg-12">
                        @if(Session::has('message'))
                            <div class="alert alert-warning" role="alert">{{session()->get('message')}}  </div>
                        @endif
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>ID #</th>
                                        <th>Date</th>
                                        <th>Jumlah</th>
                                        <th>Status</th>
                                        <th>Accept By</th>
                                        <th>Opsi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if (isset($data['data']))
                                        @foreach ($data['data'] as $k=>$v)
                                            <tr>
                                                <td>{{ $v->id }}</td>
                                                <td>{{ date_format($v->updated_at, 'D, m Y | H:i:s') }}</td>
                                                <td>{{ 'Rp '.number_format($v->withdraw_total,0,',','.') }}</td>
                                                <td>
                                                    @if ($v->status == 1)
                                                        <span class="label label-warning">Pending</span>
                                                    @elseif($v->status == 2)
                                                        <span class="label label-success">Berhasil</span>
                                                    @else
                                                        <span class="label label-danger">Gagal</span>
                                                    @endif
                                                </td>
                                                <td>{{ isset($v->accept_by) ? $v->acceptBy->name : '' }}</td>
                                                <td>
                                                    <a href="{{ route('withdraw.show', $v->id) }}" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalDetail{{ $v->id }}">DETAIL</a>
                                                    @include('backend.withdraw.modal-detail')

                                                    @if ($v->status == 1)
                                                        <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalConfirm{{ $v->id }}">KONFIRMASI</a>
                                                        @include('backend.withdraw.modal-confirm')
                                                    @elseif($v->status == 2)
                                                        <a href="{{ route('withdraw.admin.cancel', $v->id) }}" class="btn btn-sm btn-dark">BATALKAN</a>
                                                    @endif
                                                    <a href="{{ route('withdraw.admin.delete', $v->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
