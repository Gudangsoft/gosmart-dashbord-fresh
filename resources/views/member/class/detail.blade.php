@extends('member.layouts.master')
@section('content')
@include('member.layouts.banner')
<div class="section section-padding">
    <div class="container">
        <div class="section section-padding mt-n10">
            <div class="container">
                <div class="row gx-10">
                    <div class="col-lg-7">
                        <div class="courses-details">
                            <div class="courses-details-images">
                                <img src="{{ $data['detail']['class']['image'] }}" alt="Courses Details">
                            </div>
                            <h2 class="title">{!! $data['detail']['class']['title'] !!}</h2>
                            <div class="courses-details-admin">
                                <div class="admin-author">
                                    <div class="author-thumb">
                                        <img src="{{ $data['detail']['class']['author_image'] }}" class="author_thumb" alt="Author">
                                    </div>
                                    <div class="author-content">
                                        <a class="name" href="#">{{ $data['detail']['class']['author'] }}</a>
                                        <span class="Enroll">{{ $data['detail']['class']['total_subscribe'] }}</span>
                                    </div>
                                </div>
                                <div class="admin-rating">
                                    <span class="rating-count">{{ $data['detail']['review']['rating'] }}</span>
                                    <span class="rating-star">
											<span class="rating-bar" style="width: {{ $data['detail']['review']['rating']*10*2 }}%;"></span>
                                    </span>
                                    <span class="rating-text">({{ $data['detail']['review']['count_review'] }} Rating)</span>
                                </div>
                            </div>
                            <div class="courses-details-tab">
                                <div class="details-tab-menu">
                                    <ul class="nav justify-content-center">
                                        <li><button class="active" data-bs-toggle="tab" data-bs-target="#description">Info</button></li>
                                        <li><button data-bs-toggle="tab" data-bs-target="#reviews">Reviews</button></li>
                                    </ul>
                                </div>
                                <div class="details-tab-content">
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="description">
                                            <div class="tab-description">
                                                <div class="description-wrapper">
                                                    <h3 class="tab-title">Deskripsi:</h3>
                                                    <p>{!! $data['detail']['class']['description'] !!}</p>
                                                </div>
                                                <div class="tab-rating-box">
                                                    <span class="count">{{ $data['detail']['review']['rating'] }} <i class="icofont-star"></i></span>
                                                    <p>Rating ({{ $data['detail']['review']['count_review'] }})</p>
                                                    @if (isset($data['detail']['review']['rate_chart']))
                                                        @foreach ($data['detail']['review']['rate_chart'] as $k=>$v)
                                                            <div class="rating-box-wrapper">
                                                                <div class="single-rating">
                                                                    <span class="rating-star">
                                                                            <span class="rating-bar" style="width: {{ $v['rating']*10*2 }}%;"></span>
                                                                    </span>
                                                                    <div class="rating-progress-bar">
                                                                        <div class="rating-line" style="width: {{ $v['rate'] }}%;"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="reviews">
                                            <div class="tab-reviews">
                                                <h3 class="tab-title">Member Reviews:</h3>
                                                <div class="reviews-wrapper reviews-active">
                                                    <div class="swiper-container">
                                                        <div class="swiper-wrapper">
                                                        @if (isset($data['detail']['review']['comment']))
                                                            @foreach ($data['detail']['review']['comment'] as $k=>$v)
                                                                <div class="single-review swiper-slide">
                                                                    <div class="review-author">
                                                                        <div class="author-thumb">
                                                                            <img src="{{ $v['photo'] }}" class="author_thumb_small" alt="Author">
                                                                            <i class="icofont-quote-left"></i>
                                                                        </div>
                                                                        <div class="author-content">
                                                                            <h4 class="name">{{ $v['name'] }}</h4>
                                                                            <span class="designation">{{ $v['role'] }}</span>
                                                                            <span class="rating-star">
                                                                                    <span class="rating-bar" style="width: {{ $v['rating']*10*2 }}%;"></span>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <p>{!! $v['text'] !!}</p>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                        </div>
                                                        <div class="swiper-pagination"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('member.class.right-sidebar')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
