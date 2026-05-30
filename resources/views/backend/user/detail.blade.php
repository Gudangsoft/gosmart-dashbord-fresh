@extends('backend.layouts.master')
@section('content')
<div class="content-header sty-one">
    <h1 class="text-black">Detail</h1>
    <ol class="breadcrumb">
      <li><a href="">Dashboard</a></li>
      <li class="sub-bread"><i class="fa fa-angle-right"></i> Admin</li>
      <li><i class="fa fa-angle-right"></i> User</li>
      <li><i class="fa fa-angle-right"></i> Detail</li>
    </ol>
  </div>

  <div class="content">
    <div class="row">
      <div class="col-lg-3">
        <div class="box box-primary">
            <div class="box-profile"> <img class="profile-user-img img-responsive img-circle" src="{{ $data['detail']['photo'] }}" alt="{{ $data['detail']['name'] }}">
                <h3 class="profile-username text-center">{{ ucwords($data['detail']['name']) }}</h3>
                <p class="text-muted text-center">{{ $data['detail']['user_education'] ? $data['detail']['user_education'] : 'Pendidikan/Pekerjaan' }}</p>
                <ul class="nav nav-stacked sty1">
                {{-- <li><a href="#"><strong>Kelas</strong> <span class="pull-right"><strong>153</strong></span></a></li> --}}
                <li><a href="#">Mengikuti Kelas <span class="pull-right">{{ $data['subscribe_class'] }}</span></a></li>
                <li><a href="#">Kelas Dimiliki <span class="pull-right">{{ $data['detail']['total_class'] }}</span></a></li>
                </ul>
            </div>
        </div>
      </div>
      <div class="col-lg-9">
        <div class="info-box">
          <div class="box-body">
            <div class="right-page-header">
              <div class="d-flex">
                <div class="align-self-center">
                  <h4 class="text-black m-b-1">Riwayat Kelas</h4>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table id="history_class" class="table table-bordered table-hover no-wrap">
                <thead>
                  <tr>
                    <th>Nama</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                @if (isset($data['class']))
                    @foreach ($data['class'] as $k=>$v)
                        <tr>
                        <td><img src="{{ asset('/home-images/kelas/thumbnail').'/'.$v['image'] }}" class="img-circle img-w-30" style="width: 50px;height:50px;"> {{ $v['title'] }}</td>
                        <td><span class="label label-{{ $v['is_complete'] == 'Selesai' ?  'success' : 'warning'}}">{{ $v['is_complete'] }}</span></td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
