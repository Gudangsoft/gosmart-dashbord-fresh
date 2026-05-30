<div class="section login-header">
    <div class="login-header-wrapper navbar navbar-expand">

        <div class="login-header-logo logo-2">
            <a href="/"><img src="{{asset('img/logox.png')}}" style="width:180px;height:50px;" alt="Logo"></a></li>
        </div>


        <div class="login-header-action action-2 ml-auto">
            @if (isset($data['profile']))
                <a class="action author" href="#">
                    <img src="{{ $data['profile']['photo'] }}" class="author_thumb_small" alt="Author">
                </a>
            @endif

            <div class="dropdown">
                <button class="action more" data-bs-toggle="dropdown">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="#" href="{{ $data['profile']['url'] }}"><i class="icofont-user"></i> Profile</a></li>
                    <li><a class="#" href="{{ $data['profile']['resetPassword'] }}"><i class="icofont-key"></i> Reset Password</a></li>
                    @if (isset($data['profile']))
                        @if ($data['profile']['role'] == 'mentor' || $data['profile']['role'] == 'admin')
                            <li><a class="" href="{{ config('app.url') }}/dashboard"><i class="icofont-dashboard"></i> Admin</a></li>
                        @endif
                    @endif
                    <li><a class="" href="/logout"><i class="icofont-logout"></i> Sign Out</a></li>
                </ul>
            </div>
        </div>

    </div>
</div>
