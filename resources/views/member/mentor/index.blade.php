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
                                        <div class="row">
                                            @if (isset($data['mentor']))
                                                @foreach ($data['mentor'] as $k=>$v)
                                                    <div class="col-md-3 col-6">
                                                        <a href="{{ $v['url'] }}">
                                                            <div class="single-team">
                                                                <div class="team-thumb">
                                                                    <img src="{{ $v['photo'] }}" class="author_thumb_mid" alt="Author">
                                                                </div>
                                                                <div class="team-content">
                                                                    <h4 class="name">{{ $v['name'] }}</h4>
                                                                    <span class="designation">{{ $v['education'] }}</span>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                @endforeach
                                                <div class="row mt-3">
                                                    <div class="d-flex justify-content-center">
                                                        {{ $data['page']->onEachSide(2)->links() }}
                                                    </div>
                                                </div>
                                            @endif

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
