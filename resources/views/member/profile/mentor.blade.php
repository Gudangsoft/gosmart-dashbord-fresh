@extends('member.layouts.master')
@section('content')
@include('member.layouts.banner')

<div class="section section-padding mt-n10">
    <div class="container">
        <div class="row gx-10">
            <div class="col-lg-12">
                <!-- Courses Details Tab Start -->
                <div class="courses-details-tab">


                    <!-- Details Tab Content Start -->
                    <div class="details-tab-content">
                        <div class="tab-content">

                            <div class="tab-pane fade show active" id="instructors">

                                <!-- Tab Instructors Start -->
                                <div class="tab-instructors">

                                    <div class="row">
                                        @if (isset($data['mentor']))
                                            @foreach ($data['mentor'] as $k=>$v)
                                                <div class="col-md-3 col-6">
                                                    <!-- Single Team Start -->
                                                    <a href="{{ $v['url'] }}">
                                                        <div class="single-team">
                                                            <div class="team-thumb">
                                                                <img src="{{ $v['photo'] }}" class="author_thumb_mid" alt="Mentor">
                                                            </div>
                                                            <div class="team-content">
                                                                <h4 class="name">{{ $v['name'] }}</h4>
                                                                <span class="designation">{{ $v['education'] }}</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <!-- Single Team End -->
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <!-- Tab Instructors End -->

                            </div>

                        </div>
                    </div>
                    <!-- Details Tab Content End -->
                </div>
            </div>
        </div>
    </div>
</div>
    @endsection
