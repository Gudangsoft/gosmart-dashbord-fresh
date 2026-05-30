@extends('backend.layouts.master')
@section('content')
@include('sweetalert::alert')

<!-- Content Header (Page header) -->
<div class="content-header sty-one">
    <h1 class="text-black">Penarikan Dana</h1>
    <ol class="breadcrumb">
        <li><a href="#">Dashboard</a></li>
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
                        <div class="row m-t-4">
                            @if(Session::has('message'))
                                <div class="alert alert-warning" role="alert">{{session()->get('message')}}  </div>
                            @endif
                            <div class="col-12">
                                <div class="info-box bg-blue"> <span class="info-box-icon bg-transparent"><i class="fa fa-credit-card"></i></span>
                                    <div class="info-box-content">
                                        <h6 class="info-box-text text-white">Total Pendapatan</h6>
                                        <h1 class="text-white">RP {{ number_format($profile['total_income'],0,',','.') }}</h1>
                                        <span class="progress-description text-white"> Penarikan dana minimal Rp 100.000 </span>
                                    </div>
                                    <button type="button" class="btn btn-light" data-toggle="modal" data-target="#modalWithdraw">
                                        AJUKAN PENARIKAN
                                    </button>

                                    @include('backend.withdraw.modal')

                                </div>
                            </div>
                        </div>
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
<script>
    var fnumber = document.getElementById("inputPrice");
    fnumber.addEventListener('keyup', function(evt){
        var n = parseInt(this.value.replace(/\D/g, ''), 10);
        fnumber.value = n.toLocaleString()
    }, false);
</script>


@endsection
