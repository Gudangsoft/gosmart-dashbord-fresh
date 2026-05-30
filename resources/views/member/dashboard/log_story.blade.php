@extends('member.layouts.dashboard')
@section('content')
    <div class="section overflow-hidden position-relative" id="wrapper">
        @include('member.dashboard.sidebar-menu')
         <div class="page-content-wrapper">
        @include('member.profile.tab-menu')

            <div class="main-content-wrapper">
                <div class="container-fluid">
                    <div class="admin-top-bar">
                        <div class="courses-select">
                            <select>
                                <option data-display="All Courses">All Courses</option>
                                {{-- <option value="1">option</option> --}}
                            </select>
                        </div>
                    </div>
                    <div class="engagement-courses">

                        <h3>Terbaru</h3>
                        @if (isset($data['new_data']))
                            <div class="courses-list">
                                <ul>
                                    <li>
                                        <div class="courses">
                                            <div class="thumb">
                                                <img src="{{ isset($data['new_data']['image']) ? $data['new_data']['image'] : asset('assets/images/blogblog-04.jpg')}}" alt="Courses">
                                            </div>
                                            <div class="content">
                                                <h4 class="title"><a href="{{ $data['new_data']['url'] }}">{!! $data['new_data']['title'] !!}</a></h4>
                                            </div>
                                        </div>
                                        <div class="taught">
                                            <span>{{ $data['new_data']['class_name'] }}</span>
                                        </div>
                                        <div class="button">
                                            <a class="btn" href="{{ $data['new_data']['url'] }}">View Details</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        @endif

                    </div>

                    <div class="engagement-courses">

                        <h3>Selesai</h3>
                        @if (isset($data['learn_history']['data']))
                            <div class="courses-list">
                                <ul>
                                    @foreach ($data['learn_history']['data'] as $k=>$v)
                                        <li>
                                            <div class="courses">
                                                <div class="thumb">
                                                    <img src="{{ $v['image'] }}" alt="Courses">
                                                </div>
                                                <div class="content">
                                                    <h4 class="title"><a href="{{ $v['url'] }}">{!! $v['title'] !!}</a></h4>
                                                </div>
                                            </div>
                                            <div class="taught">
                                                <span>{{ $v['class_name'] }}</span>
                                            </div>
                                            <div class="button">
                                                <a class="btn" href="{{ $v['url'] }}">View Details</a>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="row mt-3">
                                <div class="d-flex justify-content-center">
                                    {{ $data['page']->onEachSide(3)->links() }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
         </div>
     </div>
@endsection
