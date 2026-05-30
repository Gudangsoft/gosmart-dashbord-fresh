@extends('backend.layouts.master')
@section('content')
@include('sweetalert::alert')

    <div class="content-header sty-one">
      <h1>GOSMART ID</h1>
      <ol class="breadcrumb">
        <li><a href="#">Dashboard</a></li>
      </ol>
    </div>

    @if (isset($data))
        <div class="content">
            @if(Auth::user()->role == 'admin')
            <div class="row mb-2">
                <div class="col-12">
                    <strong>Semua Asset</strong>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-darkblue"> <span class="info-box-icon bg-transparent"><i class="ti-face-smile text-white"></i></span>
                        <div class="info-box-content">
                        <h4 class="text-white">User active</h4>
                        <h1 class="text-white">{{$data['data_user']['active']}}</h1>
                        <span class="progress-description text-white"> {{$data['data_user']['verified']}} verified, {{$data['data_user']['total']}} total </span> </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-green text-white"> <span class="info-box-icon bg-transparent"><i class="ti-stats-up text-white"></i></span>
                        <div class="info-box-content">
                        <h4 class="text-white">All Materi</h4>
                        <h1 class="text-white">{{$data['data_materi']['total']}}</h1>
                        <span class="progress-description text-white"> {{$data['data_materi']['premium']}} premium,  {{$data['data_materi']['free']}} free</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-aqua"> <span class="info-box-icon bg-transparent"><i class="fa fa-mortar-board"></i></span>
                        <div class="info-box-content">
                        <h4 class="text-white">Total Kelas</h4>
                        <h1 class="text-white">{{$data['data_kelas']['total']}}</h1>
                        <span class="progress-description text-white"> {{$data['total_role']['total_admin']}} Admin, {{$data['total_role']['total_mentor']}} Mentor </span> </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange"> <span class="info-box-icon bg-transparent"><i class="fa fa-money"></i></span>
                        <div class="info-box-content">
                            <h4 class="text-white">Total Income</h4>
                            <h1 class="text-white">RP {{$data['total_income']['total_all_income']}}</h1>
                            <span class="progress-description text-white"> Terbaru RP {{$data['total_income']['new_income']}} </span>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="row mb-2">
                <div class="col-12">
                    <strong>Asset Saya</strong>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                        <div class="text-left">
                            <h2>Total Kelas</h2>
                        </div>
                        <div class="text-right m-t-2">
                            <h1><i class="fa fa-mortar-board"></i> {{$profile['total_class']}}</h1>
                        </div>
                        <div class="m-b-2"><span class="text-white">{{floor($profile['precent_class'])}}%</span>
                            <div class="progress bg-lightblue">
                            <div class="progress-bar bg-white" role="progressbar" style="width: {{floor($profile['precent_class'])}}%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="small-box bg-darkblue text-white">
                        <div class="inner">
                        <div class="text-left">
                            <h2>Pelanggan</h2>
                        </div>
                        <div class="text-right m-t-2">
                            <h1><i class="fa fa-users "></i> {{$profile['total_pelanggan']}}</h1>
                        </div>
                        <div class="m-b-2"><span class="text-white">{{floor($profile['precent_pelanggan'])}}%</span>
                            <div class="progress bg-lightblue">
                            <div class="progress-bar bg-white" role="progressbar" style="width: {{floor($profile['precent_pelanggan'])}}%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="small-box bg-orange">
                        <div class="inner">
                            <div class="text-left">
                                <h2>Materi</h2>
                            </div>
                            <div class="text-right m-t-2">
                                <h1><i class="fa fa-book "></i> {{$profile['total_materi']}}</h1>
                            </div>
                            <div class="m-b-2">
                                <span class="text-white"><i class="fa fa-arrow-circle-up"></i>
                                    {{-- @if(round($data['to_top'] == 0))
                                        you are top
                                    @else
                                        {{ round($data['to_top']) }}
                                    @endif --}}
                                </span>
                                <div class="progress bg-lightblue">
                                    <div class="progress-bar bg-white" role="progressbar" style="width: 100%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="small-box bg-light-blue">
                        <div class="inner">
                        <div class="text-left">
                            <h2>Income</h2>
                            <h6>10% Sistem</h6>
                        </div>
                        <div class="text-right m-t-2">
                            <h1>RP {{$profile['total_income']}}</h1>
                        </div>
                        <div class="m-b-2"><span class="text-white"><i class="fa fa-star"></i>  {{round($profile['rate'])}}</span>
                            <div class="progress bg-lightblue">
                            <div class="progress-bar bg-white" role="progressbar" style="width: {{$profile['rate']*10}}%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
  </div>


@endsection
