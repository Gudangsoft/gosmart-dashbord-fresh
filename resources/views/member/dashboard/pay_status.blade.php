@extends('member.layouts.dashboard')
@section('content')
<div class="section overflow-hidden position-relative" id="wrapper">

    @include('member.dashboard.sidebar-menu')

    <div class="page-content-wrapper">
         <div class="container-fluid custom-container">
            <div class="message">
                <div class="message-icon">
                    <img src="{{asset('assets')}}/images/menu-icon/icon-6.png" alt="">
                </div>
                <div class="message-content">
                    <p>Batas waktu pembayaran maksimal 24 jam</p>
                </div>
            </div>
            <div class="admin-top-bar students-top">
                <div class="courses-select">
                    <h4 class="title">Your Payment</h4>
                </div>
            </div>
            @if (isset($data['pay_class']))
                <div class="students-wrapper students-active">
                    <div class="swiper-container">
                        <div class="single-courses-rating">
                            <div class="courses">
                                <div class="courses-thumb">
                                    <a href="{{ $data['pay_image'] }}"><img src="{{ $data['pay_image'] }}" style="height:130px;width:150px;" alt="Courses"></a>
                                </div>
                                <div class="courses-content">
                                    <h7>{{ strtoupper($data['pay_class']['class']['date']) }}</h6>
                                    <h4 class="title"><a href="#">{!! $data['pay_class']['class']['title'] !!}</a></h4>
                                    <div class="average-rating">
                                        <span class="count">
                                            {{ $data['pay_class']['class']['price'] }}
                                        </span>
                                    </div>
                                    <div style="font-size: 10px;color:red;">
                                        <i>Kirim bukti transaksi bank atau foto laporan pembayaran sukses dari email anda</i>
                                    </div>
                                </div>
                                <div class="courses-btn">
                                    @isset($data['pay_class']['class']['left'])
                                        @if ($data['pay_class']['class']['left'] > 0)
                                        <div style="font-size: 12px;color:#fff; background-color:#198754;padding:5px;">
                                            <b class="bg-red">WAKTU PEMBAYARAN TERSISA {{ $data['pay_class']['class']['left'] }} JAM LAGI</b>
                                        </div>
                                        @endif
                                    @endisset
                                </div>
                                <div class="courses-btn">
                                    <a class="btn btn-{{ $data['paid'] == "EXPIRED" ? 'danger' : 'success' }} mt-1" href="#">{{ $data['paid'] }}</a>
                                    @if ( $data['paid'] == "LUNAS")
                                        <a class="btn btn-secondary mt-1" href="{{ $data['pay_class']['class']['url'] }}">BUKA KELAS</a>
                                    @elseif($data['paid'] == "EXPIRED")
                                        <a class="btn btn-warning mt-1" href="{{ $data['pay_page'] }}">ORDER ULANG</a>
                                    @else
                                        <a class="btn btn-secondary mt-1" href="https://wa.me/{{ config('app.phone') }}/?text=Halo%20saya%20{{ auth()->user()->name }}%20sudah%20melunasi%20pembayaran%20kelas%20{{ $data['pay_class']['class']['title'] }},%20Berikut%20saya%20lampirkan%20bukti%20transaksi%20saya.">KIRIM BUTKI TRANSFER</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
 @endsection
