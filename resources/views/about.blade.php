@extends('member.layouts.master')
@section('content')
@include('member.layouts.banner')
<div class="section section-padding">
    <div class="container">
        <div class="section section-padding mt-n10">
            <div class="container">
                <h3>
                    TENTANG KAMI
                </h3>
                <div class="row mt-4">
                    <div class="col-12">
                        {!! $data['about']['data'] !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
