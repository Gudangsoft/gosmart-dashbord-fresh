@if (isset($data))
    <div class="section section-padding-02">
        <div class="container">
            <div class="brand-logo-wrapper">

                <div class="section-title shape-03">
                    <h2 class="main-title"> Rekan Terbaik <span> G-Academy.</span></h2>
                </div>
                <div class="brand-logo brand-active">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">

                            @foreach ($data as $k => $v)
                                <div class="single-brand swiper-slide">
                                    <a href="{{ $v['url'] }}">
                                    <img src="{{ $v['path_image'] }}" alt="{{ $v['title'] }}">
                                    </a>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endif
