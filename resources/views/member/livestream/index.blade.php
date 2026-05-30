@extends('member.layouts.master')
@section('content')
@include('member.layouts.banner')
<div class="section section-padding">
    <div class="container">
        <div class="courses-category-wrapper">
            <div class="courses-search search-2">
                <form action="/learning/search" method="POST">
                    @csrf
                        <input type="text" name="search"  placeholder="Search here">
                        <button><i class="icofont-search"></i></button>
                </form>
            </div>

            <ul class="category-menu">
                <li><a class="{{ $data['meta']['title'] == 'Live' ? 'active' : '' }}" href="/live">Live</a></li>
                <li><a class="{{ $data['meta']['title'] == 'Event' ? 'active' : '' }}" href="/event">Event</a></li>
            </ul>
        </div>
        @switch(strtolower($data['meta']['title']))
            @case('live')
                @include('member.livestream.live')
                @break
            @case('event')
                @include('member.livestream.events')
                @break
            @default

        @endswitch
    </div>
</div>
@endsection
