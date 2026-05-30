@extends('member.layouts.dashboard')
@include('sweetalert::alert')
@section('content')
<div class="section overflow-hidden position-relative" id="wrapper">

    @include('member.dashboard.sidebar-menu')

    <div class="page-content-wrapper py-0">

        @include('member.profile.tab-menu')

        <div class="main-content-wrapper">
            <div class="container-fluid">

                <div class="admin-top-bar flex-wrap">
                    @if (isset($data))
                        @switch($data['is_active'])
                            @case('creation')
                                @include('member.profile.data.creation')
                                @break
                            @case('edit')
                                @include('member.profile.data.edit')
                                @break
                            @case('history')
                                @include('member.profile.data.history')
                                @break
                            @case('report')
                                @include('member.profile.data.report')
                                @break
                            @case('payment')
                                @include('member.profile.data.payment')
                                @break
                            @case('certificate')
                                @include('member.profile.data.certificate')
                                @break
                            @case('cart')
                                @include('member.profile.data.cart')
                                @break
                            @default
                                @include('member.profile.data.overview')
                        @endswitch
                    @endif
                </div>

            </div>
        </div>

    </div>

</div>

@endsection
