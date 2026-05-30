@extends('member.layouts.master')
@section('content')
@include('member.layouts.banner')
<div class="section section-padding">
    <div class="container">
        <div class="section section-padding mt-n10">
            <div class="container">
                <h3 class="mb-3">
                    Pengumuman
                </h3>
                <div class="row">
                    <div class="col-12">
                        @if (isset($data['row']))
                            {!! $data['row']->content !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
