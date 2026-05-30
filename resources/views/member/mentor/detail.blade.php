@extends('member.layouts.master')
@section('content')
@include('member.layouts.banner')

<div class="section">

    <div class="section-padding-02 mt-n10">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">

                    <div class="about-images">
                        <div class="images">
                            <img src="{{ $data['mentor']['photo'] }}" alt="About">
                        </div>

                        <div class="about-years">
                            <div class="years-icon">
                                <img src="{{asset('assets')}}/images/logo-icon.png" alt="About">
                            </div>
                            <p><strong>{{ $data['mentor']['total_class'] }}</strong> Kelas</p>
                        </div>
                    </div>

                </div>
                <div class="col-lg-6">

                    <div class="about-content">
                        <h5 class="sub-title">Mentor</h5>
                        <h2 class="main-title">Helo, my name is {{ $data['mentor']['name'] }}</h2>
                        <p>{!! $data['mentor']['bio'] !!}</p>
                        <a href="https://wa.me/{{ $data['mentor']['phone'] }}/?text=Halo%20saya%20{{ isset(auth()->user()->name) ? auth()->user()->name : null}}%20member%20dari%20G-Academy.net" class="btn btn-primary btn-hover-dark">Chat</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="section-padding-02 mt-n6">
        <div class="container">

            <div class="about-items-wrapper">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="about-item">
                            <div class="item-icon-title">
                                <div class="item-icon">
                                    <i class="flaticon-tutor"></i>
                                </div>
                                <div class="item-title">
                                    <h3 class="title">Individual Skill</h3>
                                </div>
                            </div>
                            <p>
                                <div class="card">
                                    <div class="card-body">
                                        @if(isset($data['mentor']['skill_list']))
                                            @if ($data['mentor']['skill_list'] != null)
                                            {{-- {{dd($profile['skill_list'][0])}} --}}
                                                @foreach ($data['mentor']['skill_list'] as $k => $v)
                                                    <table>
                                                        @for ($i = 0; $i < count($v->name); $i++)
                                                        <h6 class="m-t-3">{!!strtoupper($v->name[$i])!!} <span class="pull-right">{!!$v->value[$i]!!}</span></h6>

                                                        <div class="progress mb-2">
                                                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:{!!$v->value[$i]!!}%;"> <span class="sr-only">50% Complete</span> </div>
                                                        </div>
                                                        @endfor
                                                    </table>
                                                @endforeach
                                            @endif
                                        @else
                                            <h6>Null</h6>
                                        @endif
                                    </div>
                                </div>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="about-item">
                            <div class="item-icon-title">
                                <div class="item-icon">
                                    <i class="flaticon-coding"></i>
                                </div>
                                <div class="item-title">
                                    <h3 class="title">Contact</h3>
                                </div>
                            </div>
                            <p>
                                <div class="widget-address">
                                    <p>{{ $data['mentor']['address'] }}</p>
                                </div>

                                <ul class="widget-info">
                                    <li>
                                        <p> <i class="flaticon-email"></i> <a href="mailto:{{ $data['mentor']['email'] }}">{{ $data['mentor']['email'] }}</a> </p>
                                    </li>
                                    <li>
                                        <p> <i class="flaticon-phone-call"></i> <a href="tel:9702621413">{{ $data['mentor']['phone'] }}</a> </p>
                                    </li>
                                </ul>

                                <h5 class="mt-3">
                                    <a href="#"><i class="flaticon-facebook mr-2"></i></a>
                                    <a href="#"><i class="flaticon-twitter mr-2"></i></a>
                                    <a href="#"><i class="flaticon-skype mr-2"></i></a>
                                    <a href="#"><i class="flaticon-instagram mr-2"></i></a>
                                </h5>

                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="about-item">
                            <div class="item-icon-title">
                                <div class="item-icon">
                                    <i class="flaticon-increase"></i>
                                </div>
                                <div class="item-title">
                                    <h3 class="title">Kelas</h3>
                                </div>
                            </div>
                            <p>
                                <div class="sidebar-widget">
                                    <div class="widget-post">
                                        <ul class="post-items">
                                            @if (isset($data['mentor']['class_list']))
                                                @if (isset($data['mentor']['class_list']['data']))
                                                    @foreach ($data['mentor']['class_list']['data'] as $k=>$v)
                                                        <li>
                                                            <div class="single-post">
                                                                <div class="post-thumb">
                                                                    <a href="{{ $v['url'] }}"><img src="{{ $v['image'] }}" alt="Post"></a>
                                                                </div>
                                                                <div class="post-content">
                                                                    <h5 class="title"><a href="{{ $v['url'] }}">{{ strtoupper($v['name']) }}</a></h5>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </p>
                        </div>
                        <!-- About Item End -->
                    </div>
                </div>
            </div>
            <!-- About Items Wrapper End -->

        </div>
    </div>

</div>
<!-- About End -->


@endsection
