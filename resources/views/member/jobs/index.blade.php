@extends('member.layouts.master')
@section('content')
@include('member.layouts.banner')
<div class="section section-padding">
    <div class="container">
        {{-- <div class="courses-category-wrapper">
            <div class="courses-search search-2">
                <form action="/learning/search" method="POST">
                    @csrf
                        <input type="text" name="search"  placeholder="Search here">
                        <button><i class="icofont-search"></i></button>
                </form>
            </div>


        </div> --}}
        <div class="courses-wrapper-02">
            <div class="row">
                @if (isset($data['jobs']))
                    @foreach ($data['jobs'] as $k=>$v)
                    <div class="col-lg-4 col-md-6">
                        <a href="{{ $v['jobUrl'] }}}}">
                            <div class="single-blog">
                                <div class="blog-image">
                                    <img src="{{ url('public/home-images/job.jpg')}}" alt="{!! $v['jobTitle'] !!}">
                                </div>
                                <div class="blog-content">

                                    <h4 class="title"><a href="{{ $v['jobUrl'] }}}}">{!!strtoupper($v['jobTitle'])!!}</a></h4>
                                    <div class="blog-meta">
                                        <span> <i class="icofont-calendar"></i> {{ $v['postingDuration'] }}</span>
                                    </div>

                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                    {{-- <div class="row mt-3">
                        <div class="d-flex justify-content-center">
                            {{ $data->onEachSide(2)->links() }}
                        </div>
                    </div> --}}
                @else
                    <h5 class="text-center">Segera hadir</h5>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection
