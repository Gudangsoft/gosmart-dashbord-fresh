
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>G-Academy | Reset Password</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico">

    <!-- CSS
	============================================ -->

    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="assets/css/plugins/icofont.min.css">
    <link rel="stylesheet" href="assets/css/plugins/flaticon.css">
    <link rel="stylesheet" href="assets/css/plugins/font-awesome.min.css">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="assets/css/plugins/animate.min.css">
    <link rel="stylesheet" href="assets/css/plugins/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/plugins/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/plugins/nice-select.css">
    <link rel="stylesheet" href="assets/css/plugins/apexcharts.css">
    <link rel="stylesheet" href="assets/css/plugins/jqvmap.min.css">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="assets/css/style.css">


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
                                    <img src="assets/images/shape/shape-26.png" alt="Shape">
                                </div>


                                <div class="images">
                                    <img src="assets/images/register-login.png" alt="Register Login">
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-6">

                            <div class="register-login-form">
                                <h3 class="title">Reset <span>Password</span></h3>
                                @if(Session::has('msg'))
                                    <div class="message">
                                        <div class="message-icon">
                                            <img src="{{asset('assets')}}/images/menu-icon/icon-6.png" alt="">
                                        </div>
                                        <div class="message-content">
                                            <p>{{ session()->get('msg') }}</p>
                                        </div>
                                    </div>
                                @endif
                                <div class="form-wrapper">
                                    <form method="POST" action="{{ route('reset-password') }}">
                                        @csrf
                                        <div class="single-form">
                                            <input id="email" type="password" class="form-control @error('passwordNow') is-invalid @enderror" name="passwordNow" placeholder="Password Sekarang"  value="{{ old('passwordNow') }}" autofocus>
                                            @error('passwordNow')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="single-form">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password Baru" autocomplete="current-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <input id="password" type="password" class="form-control @error('passwordConfirm') is-invalid @enderror" name="passwordConfirm" placeholder="Konfirmasi Password" autocomplete="current-password">
                                            @error('passwordConfirm')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="form-button">
                                                <button type="submit" class="btn btn-primary btn-hover-dark w-100">Reset</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Register & Login Wrapper End -->

            </div>
        </div>
        <div class="row text-center mb-4">
            <p>&copy;G-academy.net</p>
        </div>

    <script src="assets/js/vendor/modernizr-3.11.2.min.js"></script>
    <script src="assets/js/vendor/jquery-3.5.1.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="assets/js/plugins/popper.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>

    <!-- Plugins JS -->
    <script src="assets/js/plugins/swiper-bundle.min.js"></script>
    <script src="assets/js/plugins/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/plugins/video-playlist.js"></script>
    <script src="assets/js/plugins/jquery.nice-select.min.js"></script>
    <script src="assets/js/plugins/ajax-contact.js"></script>


</body>

</html>

