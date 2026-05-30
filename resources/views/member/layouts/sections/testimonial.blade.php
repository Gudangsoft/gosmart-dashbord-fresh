<!-- Testimonial End -->
<div class="section section-padding-02 mt-n1">
    <div class="container">

        <!-- Section Title Start -->
        <div class="section-title shape-03 text-center">
            <h5 class="sub-title">Member Testimonial</h5>
            <h2 class="main-title">Tanggapan dari <span> Member</span></h2>
        </div>
        <!-- Section Title End -->

        <!-- Testimonial Wrapper End -->
        <div class="testimonial-wrapper testimonial-active">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @if (isset($data['review']['comment']))
                        @foreach ($data['review']['comment'] as $k=>$v)
                            <div class="single-testimonial swiper-slide">
                                <div class="testimonial-author">
                                    <div class="author-thumb">
                                        <img src="{{ isset($v['photo']) ? $v['photo'] : '/img/user/s7.png'}}" alt="User">

                                        <i class="icofont-quote-left"></i>
                                    </div>

                                    <span class="rating-star">
                                            <span class="rating-bar" style="width: {{ isset($v['rating']) ? $v['rating']*10*2 : null }}%;"></span>
                                    </span>
                                </div>

                                <div class="testimonial-content">
                                    <p>{{ $v['text'] }}</p>
                                    <h4 class="name">{{ isset($v['name']) ? $v['name'] : null}}</h4>
                                    <span class="designation">Kelas {{ isset($v['class_name']) ? $v['class_name'] : null}}</span>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <!-- Testimonial Wrapper End -->

    </div>
</div>
<!-- Testimonial End -->
