@extends('layouts.login')

@section('content')
<div class="form-body without-side">
    <div class="website-logo">
        <img src="/img/logo.png" alt="">
    </div>
    <div class="row">
        <div class="img-holder">
            <div class="bg"></div>
            <div class="info-holder">
                {{-- <img src="{{asset('auth')}}/images/graphic3.svg" alt=""> --}}
            </div>
        </div>
        <div class="form-holder">

            <div class="form-content">
                <div class="form-items">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Sebelum melanjutkan, harap periksa email Anda untuk tautan verifikasi. Jika Anda tidak menerima email,
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Klik disini untuk meminta kembali</button>.
                    </form>
                    <div class="text-center mt-5"><a href="/" class="btn btn-primary">Home</a></div>
                </div>
                <div class="form-sent">
                    <div class="tick-holder">
                        <div class="tick-icon"></div>
                    </div>
                    <h3>Password link sent</h3>
                    <p>Please check your inbox iofrm@iofrmtemplate.io</p>
                    <div class="info-holder">
                        <span>Unsure if that email address was correct?</span> <a href="#">We can help</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
