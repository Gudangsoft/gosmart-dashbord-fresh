@extends('member.layouts.master')
@section('content')
@include('sweetalert::alert')

    @include('member.layouts.slider')
    @include('member.layouts.sections.home-premium-class')
    @include('member.layouts.sections.home-class')
    @include('member.layouts.sections.event')
    @include('member.layouts.sections.how-to-work')
    @if (!empty($data['announcement']))
        @include('member.layouts.sections.announcement')
    @endif

    @include('member.layouts.sections.loker')
    @include('member.layouts.sections.testimonial')
    @include('member.layouts.sections.creations', ['data' => $data['creations'], 'counter' => $data['creations_count']])
    @include('member.layouts.sections.partners', ['data' => $data['partner']['partner']])

@endsection
