@extends('member.layouts.master')
@section('content')
@include('member.layouts.banner')
<div class="section section-padding mt-n10">
    <div class="container">

        <div class="row gx-10">
            <div class="col-lg-12">
                <div class="courses-details">
                    <div class="courses-details-tab">
                        <div class="details-tab-content">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="instructors">
                                    <div class="tab-instructors">
                                        <h4 class="widget-title">Portofolio member</h4>
                                        <h5 class="mt-2"><span class="badge badge-success">{{$data['creations_count']}} Karya</span> </h5>
                                        <div class="row">
                                            <div class="col">
                                                <div class="widget-post">
                                                    {{-- <ul class="post-items"> --}}
                                                    <div class="row">
                                                        @if (isset($data['creations']))
                                                            @foreach($data['creations'] as $c)
                                                            <div class="col-sm-12 col-xl-4 col-md-4">
                                                                <div class="single-post">
                                                                    <div class="post-thumb">
                                                                        <a href="{{ $c->url }}"><img src="assets/images/blog/blog-04.jpg" alt="{{ $c->name }}"></a>
                                                                    </div>
                                                                    <div class="post-content">
                                                                        <h5 class="title"><a href="{{ $c->url }}">{{ $c->name }}</a></h5>
                                                                        <span class="date"><i class="icofont-calendar"></i> {{ \Carbon\Carbon::parse($c->created_at)->isoFormat('dddd, D MMMM Y') }}</span>
                                                                            <span class="date"><i class="icofont-user"></i> {{ $c->getuser->name }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-center mt-3">
                                                    {{ $data['creations']->onEachSide(4)->links() }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
