    <header class="main-header">
    <!-- Logo -->
    <a href="/dashboard" class="logo blue-bg">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <!-- <span class="logo-mini"><img src="{{asset('backend')}}/dist/img/logo-n.png" alt=""></span>  -->
    <span class="logo-mini"><img src="{{asset('img/logo-mini.png')}}"  style="width:30px;height:30px;" alt=""></span>
    <!-- logo for regular state and mobile devices -->
    <!-- <span class="logo-lg"><img src="{{asset('backend')}}/dist/img/logo.png" alt=""></span> </a>  -->
    <span class="logo-lg"><img src="{{asset('img/logo.png')}}" style="width:120px;height:30px;" alt=""></span> </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar blue-bg navbar-static-top">
      <!-- Sidebar toggle button-->
      <ul class="nav navbar-nav pull-left">
        <li><a class="sidebar-toggle" data-toggle="push-menu" href=""></a> </li>
      </ul>
      <div class="pull-left search-box">
        {{-- <form action="/dashboard/search" method="POST" class="search-form"/>
          @csrf
          <div class="input-group">
            <input name="search" class="form-control" placeholder="Search..." type="text">
            <span class="input-group-btn">
            <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i> </button>
            </span></div>
        </form> --}}
        <!-- search form --> </div>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <li class="dropdown user user-menu p-ph-res"> <a href="/logout" class="dropdown-toggle" data-toggle="dropdown"> <span class="hidden-xs">Keluar</span> </a>
                <ul class="dropdown-menu">
                {{-- <li class="user-header">
                    <div class="pull-left user-img"><img src="/img/user/{{$profile['photo']}}" style="max-height:100px;max-width:80px;" class="img-responsive" alt="User"></div>
                    <p class="text-left">{{$profile['name']}}<small>{{$profile['email']}}</small> </p>
                    <p class="view-link text-left"><a href="#">{{$profile['role']}}</a> </p>
                </li> --}}
                    {{-- @if($channel_cek != null)
                        <li> <a href="/dashboard/channel_detail/{{auth()->user()->id}}"> <i class="fa fa-user-circle"></i> <span>Channel</span> <span class="pull-right-container"> </span> </a>
                    @endif --}}
                {{-- <li><a href="/dashboard/profile/{{$profile['id']}}"><i class="icon-profile-male"></i> My Profile</a></li> --}}
                {{-- <li><a href="/inbox"><i class="fa fa-envelope"></i> Inbox</a></li> --}}
                <li role="separator" class="divider"></li>
                <li><a href="/learning"><i class="fa fa-users"></i> Mode member</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="/logout"><i class="fa fa-power-off"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
      </div>
    </nav>
  </header>
