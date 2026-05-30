<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>GoSmart.id | Reset Password</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/plugins/icofont.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    <div class="main-wrapper">
        <div class="overlay"></div>
        <div class="section section-padding">
            <div class="container">

                <div class="register-login-wrapper">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="register-login-images">
                                <div class="shape-1">
                                    <img src="{{ asset('assets/images/shape/shape-26.png') }}" alt="Shape">
                                </div>
                                <div class="images">
                                    <img src="{{ asset('assets/images/register-login.png') }}" alt="GoSmart">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="register-login-form">
                                <h3 class="title">Buat <span>Password Baru</span></h3>
                                <p class="text-muted mb-4" style="font-size: 14px;">
                                    Masukkan password baru Anda di bawah ini.
                                </p>

                                <div class="form-wrapper">
                                    <form method="POST" action="{{ route('password.update') }}">
                                        @csrf
                                        <input type="hidden" name="token" value="{{ $token }}">

                                        <div class="single-form">
                                            <input
                                                id="email"
                                                type="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                name="email"
                                                placeholder="Alamat Email"
                                                value="{{ $email ?? old('email') }}"
                                                required
                                                autocomplete="email"
                                                autofocus>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="single-form">
                                            <input
                                                id="password"
                                                type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password"
                                                placeholder="Password Baru"
                                                required
                                                autocomplete="new-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="single-form">
                                            <input
                                                id="password-confirm"
                                                type="password"
                                                class="form-control"
                                                name="password_confirmation"
                                                placeholder="Konfirmasi Password Baru"
                                                required
                                                autocomplete="new-password">
                                        </div>

                                        <div class="single-form">
                                            <div class="form-button">
                                                <button type="submit" class="btn btn-primary btn-hover-dark w-100">
                                                    Simpan Password Baru
                                                </button>
                                            </div>
                                        </div>

                                        <div class="single-form text-center">
                                            <a href="{{ route('login') }}" class="btn btn-warning btn-hover-dark w-100">
                                                &larr; Kembali ke Login
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row text-center mb-4">
            <p>&copy;{{ date('Y') }} GoSmart.id</p>
        </div>
    </div>

    <script src="{{ asset('assets/js/vendor/modernizr-3.11.2.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
</body>

</html>
