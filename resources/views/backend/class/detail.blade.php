@extends('backend.layouts.master')
@section('content')
@include('sweetalert::alert')
<div class="content-header sty-one">
    <h1 class="text-black">Detail Kelas</h1>
    <ol class="breadcrumb">
    <li><a href="#">Dashboard</a></li>
    <li class="sub-bread"><i class="fa fa-angle-right"></i> Kelas</li>
    <li><i class="fa fa-angle-right"></i> Detail</li>
    </ol>
</div>
<div class="content">
    <div class="content">
        <div class="row">
          <div class="col-lg-5">
            <div class="info-box">
              <div class="box-body"> <h3><i class="fa fa-book margin-r-5"></i> {{ $data['data']['class']['title'] }}</h3>
                <hr>
                <strong>
                    @if($data['data']['class']['discount'] != 0)
                        <s>{{ $data['data']['class']['price'] }}</s>
                    @else
                        {{ $data['data']['class']['price'] }}
                    @endif
                    @if($data['data']['class']['discount'] != 0)
                        <span class='label label-success'>{{ $data['data']['class']['discount'] }}</span>
                    @endif
                </strong>
                <hr>
                <strong><i class="fa fa-user margin-r-5"></i> Mentor </strong>
                <p class="text-muted"><span class="label label-success">{{ $data['data']['class']['author'] }}</span></p>
                <hr>

              </div>
            </div>
          </div>
          <div class="col-lg-7">
            <div class="info-box">
              <div class="card tab-style1">
                <ul class="nav nav-tabs profile-tab" role="tablist">
                  <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#desc" role="tab" aria-expanded="true">Keterangan</a> </li>
                  <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#contents" role="tab" aria-expanded="false">Materi</a> </li>
                  <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#review" role="tab" aria-expanded="false">Review</a> </li>
                  @if ($data['data']['class']['is_premium'] == true)
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#voucher" role="tab" aria-expanded="false">Voucher</a> </li>
                  @endif
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="desc" role="tabpanel" aria-expanded="true">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="mail-contnet">
                            <p>{!! $data['data']['class']['description'] !!}</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="contents" role="tabpanel" aria-expanded="false">
                    <div class="card-body">
                        @include('backend.class.content')
                    </div>
                  </div>
                  <div class="tab-pane" id="review" role="tabpanel" aria-expanded="false">
                    @include('backend.class.review')
                  </div>

                  <div class="tab-pane" id="voucher" role="tabpanel" aria-expanded="false">
                      @include('backend.class.voucher')
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>>
</div>

@endsection
