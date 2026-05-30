@extends('member.layouts.master')
@section('content')
@include('member.layouts.banner')
<div class="section section-padding">
    <div class="container">
        <div class="section section-padding mt-n10">
            <div class="container">
                <h3>
                    {!! strtoupper($data['meta']['title']) !!}
                </h3>
                <div class="row mt-3">
                    @if (isset($data['partners']['partner']))
                        @foreach ($data['partners']['partner'] as $k=>$v)
                            <div class="col-3">
                                <div class="single-brand swiper-slide">
                                    <a href="{{ $v['url'] }}">
                                    <img src="{{ $v['path_image'] }}" alt="{{ $v['title'] }}">
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12">
                            <h3>Sedang proses...</h3>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
