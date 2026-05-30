<div class="section footer-section-main mt-5">
    <div class="footer-widget-section">


        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 order-md-1 order-lg-1">

                    <div class="footer-widget">
                        <div class="widget-logo">
                            <a href="#"><img src="/assets/images/logo.png" alt="Logo"></a>
                        </div>

                        <div class="widget-address">
                            <h4 class="footer-widget-title">Sulonjari</h4>
                            <p>Bakalrejo, Guntur, Kabupaten Demak, Jawa Tengah 59565</p>
                        </div>

                        <ul class="widget-info">
                            <li>
                                <p> <i class="flaticon-email"></i> <a href="mailto:{{ config('app.email') }}">{{ config('app.email') }}</a> </p>
                            </li>
                            <li>
                                <p> <i class="flaticon-phone-call"></i> <a href="tel:{{ config('app.phone') }}">{{ config('app.phone') }}</a> </p>
                            </li>
                        </ul>

                        <ul class="widget-social">

                    </div>

                </div>
                <div class="col-lg-6 order-md-3 order-lg-2">

                    <div class="footer-widget-link">

                        <div class="footer-widget">
                            <h4 class="footer-widget-title">Kategori</h4>

                            <ul class="widget-link">
                                @if(isset($data['categories']))
                                    @foreach ($data['categories'] as $k=>$v)
                                        <li><a href="/category/{{ $v['slug'] }}">{{ ucwords($v['title']) }}</a></li>
                                    @endforeach
                                @endif
                            </ul>

                        </div>

                        <div class="footer-widget">
                            <h4 class="footer-widget-title">Layanan</h4>

                            <ul class="widget-link">
                                <li><a href="/about">Tentang Kami</a></li>
                                <li><a href="/contact">Kontak</a></li>
                                <li><a href="/terms-and-conditions">Syarat dan Ketentuan</a></li>
                                <li><a href="/partner">Partner</a></li>
                                <li><a href="/loker">Info Loker</a></li>
                                <li><a href="https://certificate.g-academy.net">Cek Sertifikat</a></li>
                            </ul>

                        </div>

                    </div>

                </div>
                <div class="col-lg-3 col-md-6 order-md-2 order-lg-3">

                    <div class="sidebar-widget">
                        <h4 class="widget-title">Follow:</h4>

                        <ul class="social">
                            <li><a href="https://web.facebook.com/gudangsoft.academy"target ="blank"><i class="flaticon-facebook"></i></a></li>
                            <li><a href="https://www.instagram.com/gudangsoft.academy/" target="_blank"><i class="flaticon-instagram"></i></a></li>
                            <li><a href="https://youtube.com/channel/UCFJt2LRIgV-4zeWUn347aPw/" target="_blank"><i class="icofont-brand-youtube"></i></a></li>
                            <li><a href="https://vt.tiktok.com/ZSd1frwJV/" target="_blank"><i class="icofont-ui-music"></i></a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <div class="footer-copyright">
        <div class="container">
            <div class="copyright-wrapper">
                <div class="copyright-text">
                    <p>&copy; 2021 <span><a href{{ config('app.url') }}">{{ config('app.corporate') }}</a></span> All Right Reserved<span> <a href="{{ config('app.url') }}">{{ config('app.name') }}</a> </span> with <a href="https://github.com/jarwonozt"><span>Jarwonoztech</span></a></p>
                </div>
            </div>
        </div>
    </div>
</div>
