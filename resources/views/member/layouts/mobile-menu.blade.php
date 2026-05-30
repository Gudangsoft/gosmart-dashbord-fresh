<!-- Mobile Menu Start -->
<div class="mobile-menu">
    <a class="menu-close" href="javascript:void(0)">
        <i class="icofont-close-line"></i>
    </a>

    <div class="mobile-top">
        <p><i class="flaticon-phone-call"></i> <a href="tel:{{ config('app.phone') }}">{{ config('app.phone') }}</a></p>
        <p><i class="flaticon-email"></i> <a href="mailto:{{ config('app.email') }}">{{ config('app.email') }}</a></p>
    </div>

    <div class="mobile-sign-in-up">
        <ul>
            @if (Auth::user() != true)
                <li><a class="sign-in" href="{{ route('login') }}">Sign In</a></li>
                <li><a class="sign-up" href="{{ route('register') }}">Sign Up</a></li>
            @else
                <li><a class="btn btn-warning" href="/learning/dashboard/{{ auth()->user()->id }}">Dashboard</a></li>
                <li><a class="sign-up" href="{{ route('logout') }}">Logout</a></li>
            @endif
        </ul>
    </div>

    <div class="mobile-menu-items">
        <ul class="nav-menu">
            <li><a href="/">Home</a></li>
            <li><a href="/learning">Kelas</a></li>
            <li><a href="/live">Live</a></li>
            <li><a href="/mentor">Mentor</a></li>
        </ul>
    </div>
</div>
