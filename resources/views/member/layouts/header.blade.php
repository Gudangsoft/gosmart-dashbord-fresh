<div class="header-section">

    <div class="header-top d-none d-lg-block">
        <div class="container">

            <div class="header-top-wrapper">

                <div class="header-top-left">
                    @if (isset($data['data']))
                        <p>{!! $data['data']['text'] !!} <a href="{{ $data['data']['url'] }}">, Cek Sekarang</a></p>
                    @endif
                </div>

                <div class="header-top-medal">
                    <div class="top-info">
                        <p><i class="fa fa-whatsapp"></i> <a href="tel:{{ config('app.phone') }}">{{ config('app.phone') }}</a></p>
                        <p><i class="flaticon-email"></i> <a href="mailto:{{ config('app.email') }}">{{ config('app.email') }}</a></p>
                    </div>
                </div>

                <div class="header-top-right">
                    <ul class="social">
                        {{-- <li><a href="#"><i class="flaticon-facebook"></i></a></li>
                        <li><a href="#"><i class="flaticon-twitter"></i></a></li>
                        <li><a href="#"><i class="flaticon-skype"></i></a></li>
                        <li><a href="#"><i class="flaticon-instagram"></i></a></li> --}}
                    </ul>
                </div>

            </div>

        </div>
    </div>

    <div class="header-main">
        <div class="container">

            <div class="header-main-wrapper">

                <div class="header-logo">
                    <a href="{{ config('app.url') }}"><img src="{{asset('img/logo.png')}}" style="width:180px;height:50px;" alt="Logo"></a>
                </div>

                <div class="header-menu d-none d-lg-block">
                    <ul class="nav-menu">
                        <li><a href="/">Home</a></li>
                        <li>
                            <a href="/learning">Kelas</a>
                        </li>
                        <li>
                            <a href="/live">Live</a>
                        </li>
                        <li>
                            <a href="#">Lainnya</a>
                            <ul class="sub-menu">
                                <li><a href="/mentor">List Mentor</a></li>
                                <li><a href="https://certificate.g-academy.net">Cek Sertifikat</a></li>
                                <li><a href="/loker">Lowongan Pekerjaan</a></li>
                            </ul>

                        </li>
                    </ul>

                </div>

                <div class="header-sign-in-up d-none d-lg-block">
                    <ul>
                        @if (Auth::user() != true)
                        <li><a class="sign-in" href="{{ route('login') }}">Sign In</a></li>
                        <li><a class="sign-up" href="{{ route('register') }}">Sign Up</a></li>
                        @else
                            <li><a class="btn btn-success" href="{{ route('carts.index') }}" style="color: #FFFFFF">Keranjang <sup id="cart-count" style="border-radius:100%;padding:5px;">{{ isset($data['cart_count']) ? $data['cart_count'] : 0 }}</sup></a></li>
                            <li><a class="btn btn-warning" href="/learning/dashboard/{{ auth()->user()->id }}">Dashboard</a></li>
                            <li><a class="sign-up" href="{{ route('logout') }}">Logout</a></li>
                        @endif
                    </ul>
                </div>

                <div class="header-toggle d-lg-none">
                    <a href="{{ route('carts.index') }}" class="mr-4"><i class="fa fa-shopping-cart" style="font-size:30px;"></i><sup style="padding:5px;">{{ isset($data['cart_count']) ? $data['cart_count'] : 0 }}</sup></a>
                    <a class="menu-toggle" href="javascript:void(0)">
                        <span></span>
                        <span></span>
                        <span></span>
                    </a>
                </div>

            </div>

        </div>
    </div>

</div>
