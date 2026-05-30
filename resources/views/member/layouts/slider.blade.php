<div class="section slider-section">

    <div class="slider-shape">
        {{-- <img class="shape-1 animation-round" src="{{asset('assets')}}/images/shape/shape-8.png" alt="Shape"> --}}
    </div>

    <div class="container">

        <div class="slider-content">
            <h4 class="sub-title">Pilih kelas favorit sekarang</h4>
            <h2 class="main-title">Belajar dimana dan kapan pun <span>pasti berguna untuk berkarir</span></h2>
            <p>Kesempatan akan selalu ada, jangan sampai lewatkan. <b>{{ $data['user_join'] }} user telah bergabung bersama kami</b></p>
            <a class="btn btn-primary btn-hover-dark" href="/register">Join Sekarang</a>
        </div>

    </div>

    <div class="slider-courses-box">

        <img class="shape-1 animation-left" src="{{asset('assets')}}/images/shape/shape-5.png" alt="Shape">

        <div class="box-content">
            <div class="box-wrapper">
                <i class="flaticon-open-book"></i>
                <span class="count">{{ $data['profile_app']['app']['total_class'] }}</span>
                <p>courses</p>
            </div>
        </div>

        <img class="shape-2" src="{{asset('assets')}}/images/shape/shape-6.png" alt="Shape">

    </div>

    <!-- Slider Rating Box Start -->
    <div class="slider-rating-box">

        <div class="box-rating">
            <div class="box-wrapper">
                <span class="count">{{ $data['profile_app']['app']['star'] }} <i class="flaticon-star"></i></span>
                <p>Rating ({{ $data['profile_app']['app']['total_review'] }})</p>
            </div>
        </div>

        <img class="shape animation-up" src="{{asset('assets')}}/images/shape/shape-7.png" alt="Shape">

    </div>
    <!-- Slider Rating Box End -->

    <!-- Slider Images Start -->
    <div class="slider-images">
        <div class="images">
            <img src="{{asset('assets')}}/images/slider/slider-1.png" alt="Slider">
        </div>
    </div>
    <!-- Slider Images End -->

    <!-- Slider Video Start -->
    <div class="slider-video">
        <img class="shape-1" src="{{asset('assets')}}/images/shape/shape-9.png" alt="Shape">

        <div class="video-play">
            <img src="{{asset('assets')}}/images/shape/shape-10.png" alt="Shape">
            <a href="https://www.youtube.com/watch?v=GxxtaNXHi7c" class="play video-popup"><i class="flaticon-play"></i></a>
        </div>
    </div>
    <!-- Slider Video End -->

</div>
<!-- Slider End -->
