@extends('member.layouts.master')
@section('content')
@include('member.layouts.banner')
<div class="section section-padding">
    <div class="container">
        <div class="section section-padding mt-n10">
            <div class="container">
                @if(Session::has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{session()->get('error')}}
                    </div>
                @endif
                <div class="row gx-10">
                    <div class="col-lg-7">
                        <div class="courses-details">
                            <div class="courses-details-images">
                                <img src="{{ '/events-images/'.$data['event']->image }}" alt="Courses Details">
                            </div>
                            <h2 class="title">{!! $data['event']->title !!}</h2>
                            <div class="courses-details-admin">
                                <div class="admin-author">
                                    <div class="author-thumb">
                                        <img src="{{ isset($data['event']->getUser->photo) ? '/img/user/avatar/'.$data['event']->getUser->photo : '/img/user/s7.png'}}" class="author_thumb" alt="Author">
                                    </div>
                                    <div class="author-content">
                                        <a class="name" href="'/mentor/{{ $data['event']->getUser->name }}">{{ $data['event']->getUser->name }}</a>
                                    </div>
                                </div>

                            </div>

                            <div class="courses-details-tab">
                                <div class="details-tab-menu">
                                    <ul class="nav justify-content-center">
                                        <li><button class="active" data-bs-toggle="tab" data-bs-target="#description">Info</button></li>
                                    </ul>
                                </div>
                                <div class="details-tab-content">
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="description">
                                            <div class="tab-description">
                                                <div class="description-wrapper">
                                                    <h3 class="tab-title">Deskripsi:</h3>
                                                    <p>{!! $data['event']->description !!}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('member.livestream.event-sidebar')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
