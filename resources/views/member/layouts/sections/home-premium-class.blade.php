<div class="section">
    <div class="container">
        <div class="courses-wrapper-02">
            @if(Session::has('msg'))
                <div class="alert alert-primary" role="alert">
                    {{session()->get('msg')}}
                </div>
            @endif
            <div class="section-title shape-03 text-center">
                <h2 class="main-title">Premium <span> Class</span></h2>
            </div>
            <div class="row">
                @if (isset($data['class_premium']))
                    @foreach ($data['class_premium']['class'] as $k=>$v)
                        <div class="col-lg-3 col-md-6">
                            <!-- Single Courses Start -->
                            <div class="single-courses">
                                <div class="courses-images">
                                    <a href="{{$v['url']}}"><img src="{{$v['image'] ? $v['image'] : asset('/home-images/kelas/thumbnail').'/default.png'}}" alt="Courses"></a>

                                    <div class="courses-option dropdown">
                                        @if($v['premium'] == true)
                                            <div class="premium_badge">
                                                @if ($v['total_discount'] == null || $v['total_discount'] == 0)
                                                    PREMIUM
                                                @else
                                                    <h5 class="text-danger"><strong>-{{ $v['total_discount'] }}%</strong></h3>
                                                @endif
                                            </div>
                                        @elseif($v['premium'] == false)
                                            <div class="free_badge">
                                                FREE
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="courses-content">
                                    <div class="courses-author">
                                        <div class="author">
                                            <div class="author-thumb">
                                                <a href="{{ $v['author_url'] }}"><img src="{{ $v['author_image'] }}" class="author_thumb" alt="Author"></a>
                                            </div>
                                            <div class="author-name">
                                                <a class="name" href="{{ $v['author_url'] }}">{{ $v['author'] }}</a>
                                            </div>
                                        </div>
                                    </div>

                                    <h4 class="title"><a href="{{$v['url']}}">{{strtoupper($v['name'])}}</a></h4>
                                    <div class="courses-meta">
                                        <span> <i class="icofont-read-book"></i> {{ $v['total_materi'] }} Materi </span>
                                    <span> <i class="icofont-folder"></i> <a href="/category/{{ $v['category_slug'] }}">{{ $v['category_title'] }}</a> </span>
                                    </div>
                                    <div class="courses-price-review">
                                        <div class="courses-price">
                                            @if ($v['total_discount'] > 0)
                                                <span class="sale-parice" style="font-size: 10px;"><s>{{ $v['price'] }}</s></span>
                                                <span class="sale-parice">{{ $v['discount'] }}</span>
                                            @else
                                                <span class="sale-parice">{{ $v['price'] }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="courses-price-review" style="margin-top:-20px !important;">
                                        <div class="courses-review">
                                            <span class="rating-count">{{ $v['star'] }}</span>
                                            <span class="rating-star">
                                                    <span class="rating-bar" style="width: {{ $v['star']*10*2 }}%;"></span>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- Single Courses End -->
                        </div>
                    @endforeach
                @endif

            </div>
         </div>
    </div>
</div>
