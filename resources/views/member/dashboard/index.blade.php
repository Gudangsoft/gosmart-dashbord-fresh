@extends('member.layouts.dashboard')
@section('content')

    <div class="section overflow-hidden position-relative" id="wrapper">
       @include('member.dashboard.sidebar-menu')
        <div class="page-content-wrapper">
            <div class="container-fluid custom-container">

                @if(Session::has('msg'))
                    <div class="message">
                        <div class="message-icon">
                            <img src="{{asset('assets')}}/images/menu-icon/icon-6.png" alt="">
                        </div>
                        <div class="message-content">
                            <p>{{ session()->get('msg') }}</p>
                        </div>
                    </div>
                @endif
                @if(Session::has('pay_status'))
                    <div class="message">
                        <div class="message-icon">
                            <img src="{{asset('assets')}}/images/menu-icon/icon-6.png" alt="">
                        </div>
                        <div class="message-content">
                            <p>{{ session()->get('pay_status') }}</p>
                        </div>
                    </div>
                @endif
                @if (isset( $data['announcement']))
                    @if ($data['announcement']->type == 1)
                        <div class="modal fade" id="announcement">
                            <div class="modal-dialog modal-sm modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body reviews-form">
                                        <h3 class="modal-title mt-3">Info Update <i class="fa fa-bullhorn"></i></h3>
                                        <div class="card mt-4 p-2" style="background-color: #198754;">
                                            <h5 style="color:#fff;">{{ ucwords($data['announcement']->title) }}</h5>
                                        </div>
                                        <div class="card mt-2 p-2">
                                            <h6>{!! $data['announcement']->content !!}</h6>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" style="border: 1px solid #198754; color:#198754; padding:5px; background-color:#fff;border-radius:5px;" data-bs-dismiss="modal">close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="message">
                            <div class="message-icon">
                                <img src="{{asset('assets')}}/images/menu-icon/icon-6.png" alt="">
                            </div>
                            <div class="message-content">
                                <p>Info : {{ $data['announcement']['title'] }}, <a href="/announcement/{{ $data['announcement']['slug'] }}"><b>Klik di sini</b></a></p>
                            </div>
                        </div>
                    @endif
                @endif

                <div class="admin-courses-tab">
                    <h3 class="title">Course</h3>

                    <div class="courses-tab-wrapper">

                    </div>
                </div>
                @if (isset($data['class']['data']))
                    <div class="admin-courses-tab-content">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab1">
                                @foreach ($data['class']['data'] as $k=>$v)
                                    <div class="courses-item">
                                        <div class="item-thumb">
                                            <a href="{{ $v['url'] }}">
                                                <img src="{{ $v['image'] }}" alt="Courses">
                                            </a>
                                        </div>

                                        <div class="content-title">
                                            <h3 class="title"><a href="{{ $v['url'] }}">{{ $v['title'] }}</a></h3>
                                        </div>

                                        <div class="content-wrapper">

                                            <div class="content-box">
                                                <p>Price</p>
                                                <span class="count">{{ $v['price'] }}</span>
                                            </div>
                                            <a href="/learning/pay_status/{{$v['id']}}">
                                                <div class="content-box">
                                                    <p>Paid Status</p>
                                                    <span class="count">
                                                            {{ $v['paid'] }}
                                                    </span>
                                                </div>
                                            </a>

                                        </div>
                                    </div>
                                    <!-- Courses Item End -->
                                @endforeach
                                <div class="row mt-3">
                                    <div class="d-flex justify-content-center">
                                        {{ $data['class']['page']->onEachSide(2)->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <p>
                        <h4>Halo, {{ $data['profile']['name'] }} kamu belum memilki kelas untuk belajar, segera daftar sekarang <i><a href="/learning">klik</a></i> </h4>
                    </p>
                @endif
                <!-- Admin Courses Tab Content End -->

                <!-- Courses Resources Start -->
                {{-- <div class="courses-resources">
                    <h4 class="title">Here are our most popular mentor resources.</h4>

                    <!-- Resources Wrapper Start -->
                    <div class="resources-wrapper">
                        <div class="row row-cols-xl-6 row-cols-md-3 row-cols-2">
                            <div class="col">

                                <!-- Single Resources Start -->
                                <div class="single-resources">
                                    <div class="resources-icon">
                                        <a href="#">
                                            <img src="{{asset('assets')}}/images/resources-icon/icon-1-1.png" alt="Icon">
                                            <img class="hover" src="{{asset('assets')}}/images/resources-icon/icon-2-1.png" alt="Icon">
                                        </a>
                                    </div>
                                    <h5 class="title"><a href="#">Test Video</a></h5>
                                </div>
                                <!-- Single Resources Start -->

                            </div>
                            <div class="col">

                                <!-- Single Resources Start -->
                                <div class="single-resources">
                                    <div class="resources-icon">
                                        <a href="#">
                                            <img src="{{asset('assets')}}/images/resources-icon/icon-1-2.png" alt="Icon">
                                            <img class="hover" src="{{asset('assets')}}/images/resources-icon/icon-2-2.png" alt="Icon">
                                        </a>
                                    </div>
                                    <h5 class="title"><a href="#">Community</a></h5>
                                </div>
                                <!-- Single Resources Start -->

                            </div>
                            <div class="col">

                                <!-- Single Resources Start -->
                                <div class="single-resources">
                                    <div class="resources-icon">
                                        <a href="#">
                                            <img src="{{asset('assets')}}/images/resources-icon/icon-1-3.png" alt="Icon">
                                            <img class="hover" src="{{asset('assets')}}/images/resources-icon/icon-2-3.png" alt="Icon">
                                        </a>
                                    </div>
                                    <h5 class="title"><a href="#">Teaching Center</a></h5>
                                </div>
                                <!-- Single Resources Start -->

                            </div>
                            <div class="col">

                                <!-- Single Resources Start -->
                                <div class="single-resources">
                                    <div class="resources-icon">
                                        <a href="#">
                                            <img src="{{asset('assets')}}/images/resources-icon/icon-1-4.png" alt="Icon">
                                            <img class="hover" src="{{asset('assets')}}/images/resources-icon/icon-2-4.png" alt="Icon">
                                        </a>
                                    </div>
                                    <h5 class="title"><a href="#">Insight Courses</a></h5>
                                </div>
                                <!-- Single Resources Start -->

                            </div>
                            <div class="col">

                                <!-- Single Resources Start -->
                                <div class="single-resources">
                                    <div class="resources-icon">
                                        <a href="#">
                                            <img src="{{asset('assets')}}/images/resources-icon/icon-1-5.png" alt="Icon">
                                            <img class="hover" src="{{asset('assets')}}/images/resources-icon/icon-2-5.png" alt="Icon">
                                        </a>
                                    </div>
                                    <h5 class="title"><a href="#">Help & Support</a></h5>
                                </div>
                                <!-- Single Resources Start -->

                            </div>
                            <div class="col">

                                <!-- Single Resources Start -->
                                <div class="single-resources">
                                    <div class="resources-icon">
                                        <a href="#">
                                            <img src="{{asset('assets')}}/images/resources-icon/icon-1-6.png" alt="Icon">
                                            <img class="hover" src="{{asset('assets')}}/images/resources-icon/icon-2-6.png" alt="Icon">
                                        </a>
                                    </div>
                                    <h5 class="title"><a href="#">Insight Courses</a></h5>
                                </div>
                                <!-- Single Resources Start -->

                            </div>
                        </div>
                    </div>
                    <!-- Resources Wrapper End -->

                </div> --}}
                <!-- Courses Resources End -->

            </div>
        </div>
        <!-- Page Content Wrapper End -->

    </div>
    <!-- Courses Admin End -->



    <!--Back To Start-->
    <a href="#" class="back-to-top">
        <i class="icofont-simple-up"></i>
    </a>
    <!--Back To End-->

@endsection
