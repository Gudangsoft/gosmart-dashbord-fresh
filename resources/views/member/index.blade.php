@extends('member.layouts.master')
@section('content')
@include('member.layouts.banner')
<div class="section section-padding">
    <div class="container">

        <div class="courses-category-wrapper">
            <div class="courses-search search-2">
                <form action="/learning/search" method="POST">
                    @csrf
                        <input type="text" name="search"  placeholder="Search here">
                        <button><i class="icofont-search"></i></button>
                </form>
            </div>

            <ul class="category-menu">
                <li><a class="{{ $data['meta']['title'] == 'Class' ? 'active' : '' }}" href="/learning">Premium</a></li>
                <li><a class="{{ $data['meta']['title'] == 'Recomended' ? 'active' : '' }}" href="/learning/page/recomended">Recomended</a></li>
                <li><a class="{{ $data['meta']['title'] == 'Popular' ? 'active' : '' }}" href="/learning/page/popular">Popular</a></li>
                <li><a class="{{ $data['meta']['title'] == 'Free' ? 'active' : '' }}" href="/learning/page/free">Free</a></li>
            </ul>
        </div>
        <div class="courses-wrapper-02">
            <div class="row flex-row-reverse gx-10">
                <div class="col-lg-9">
                    <div class="courses-wrapper-02">
                        @if(Session::has('msg'))
                            <div class="alert alert-primary" role="alert">
                                {{session()->get('msg')}}
                            </div>
                        @endif
                        @if(Session::has('verified'))
                        <div class="alert alert-success" role="alert">
                            Verifikasi email berhasil
                        </div>
                        @endif

                        <div class="row">
                            @if (isset($data['class']))
                                @foreach ($data['class'] as $k=>$v)
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-courses">
                                            <div class="courses-images">
                                                <a href="{{$v['url']}}"><img src="{{$v['image']}}" alt="Courses"></a>

                                                <div class="courses-option dropdown">
                                                    @if($v['premium'] == true)
                                                        <div class="premium_badge">
                                                            @if ($v['total_discount'] == null || $v['total_discount'] == 0)
                                                                PREMIUM
                                                            @else
                                                                <h5 class="text-danger"><strong>-{{ $v['total_discount'] }}%</strong></h3>
                                                            @endif
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
                                                @if($v['premium'] == true)
                                                    <form action="" id="add-carts{{ $v['id'] }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="class_id" value="{{ $v['id'] }}" id="class_id{{ $v['id'] }}">
                                                        <input type="hidden" name="price" value="{{ $v['price_default'] }}" id="price{{ $v['id'] }}">
                                                        <button class="small-btn-success"><i class="fa fa-shopping-cart"></i> tambah</button>
                                                    </form>
                                                @endif

                                                @include('member.cart-modal')

                                                @push('script')
                                                <script type="text/javascript">

                                                    $.ajaxSetup({
                                                        headers: {
                                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                        }
                                                    });

                                                    $("#add-carts{{ $v['id'] }}").click(function(e){

                                                        e.preventDefault();

                                                        var class_id = $("#class_id{{ $v['id'] }}").val();
                                                        var price    = $("#price{{ $v['id'] }}").val();
                                                        var url = '{{ route('carts.store') }}';

                                                        $.ajax({
                                                        url:url,
                                                        method:'POST',
                                                        data:{
                                                                class_id:class_id,
                                                                price:price,
                                                                },
                                                        success:function(response){
                                                            if(response.success){
                                                                $('#cartSuccessModal{{ $v['id'] }}').modal('show');
                                                                var count = document.getElementById('cart-count').innerHTML=response.count;
                                                                // alert(response.count) //Message come from controller
                                                            }else{
                                                                $('#cartFailed').modal('show');
                                                            }
                                                        },
                                                        error:function(error){
                                                            console.log(error)
                                                        }
                                                        });
                                                    });

                                                </script>
                                                @endpush

                                            </div>
                                        </div>
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
                <div class="col-lg-3">
                    <div class="sidebar">
                        <div class="sidebar-widget">
                            <h4 class="widget-title">Kategori Kelas</h4>

                            <div class="widget-category">
                                <ul class="category-list">
                                    @if(isset($data['categories_sidebar']))
                                        @foreach ($data['categories_sidebar'] as $k=>$v)
                                            <li><a href="/category/{{ $v['slug'] }}">{{ ucwords($v['title']) }} <span>({{ $v['count'] }})</span></a> </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
