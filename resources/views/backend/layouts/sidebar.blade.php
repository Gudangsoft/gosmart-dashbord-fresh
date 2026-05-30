<div class="main-sidebar">
    <div class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">PERSONAL</li>
        </ul>
        <div class="user-panel d-sm-block">
            <div class="info">
                    <div class="image text-center mb-1"><a href="/dashboard/profile/{{$profile['id']}}"><img src="{{$profile['photo']}}" style="width:100px;height:100px;" class="profile-user-img img-responsive img-circle" alt="User Image"> </a></div>
                    <p>{{$profile['name']}}</p>
                    <p><span class="label label-success">{{ ucfirst($profile['role']) }}</span></p>
                    <h3>
                        <a href="/dashboard/profile/{{$profile['id']}}"><i class="fa fa-cog"></i></a>
                    </h3>
                </div>
            </div>
        </div>
        <ul class="sidebar-menu mb-5" data-widget="tree">
            <li> <a href="/"> <i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
            @if(Auth::user()->role == 'admin' || Auth::user()->role == 'super_admin' || Auth::user()->role == 'teacher')
                <li class="treeview"> <a href="#"> <i class="fa fa-university"></i> <span>Kelas</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
                    <ul class="treeview-menu">
                        <li><a href="/dashboard/class_list">List</a></li>
                        <li><a href="/dashboard/class_add/new">Tambah</a></li>
                        <li><a href="/dashboard/class-category">Kategori</a></li>
                    </ul>
                </li>

                <li class="treeview"> <a href="#"> <i class="fa fa-database"></i> <span>Materi</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
                    <ul class="treeview-menu">
                    @if(Auth::user()->role == 'admin')
                    <li><a href="/dashboard/allmateri">Semua Materi</a></li>
                    @endif
                    <li><a href="/dashboard/user_materi/{{ auth()->user()->id }}">Materi Saya</a></li>
                    </ul>
                </li>
                <li class="treeview"> <a href="#"> <i class="fa fa-database"></i> <span>Tools Kelas</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
                    <ul class="treeview-menu">
                    <li><a href="/dashboard/tools_materi/0">Tambah</a></li>
                    <li><a href="/dashboard/tools_materi">Semua Tools</a></li>
                    </ul>
                </li>
            @endif
            @if( Auth::user()->role == 'teacher' || Auth::user()->role == 'admin')
            <li> <a href="{{ route('events.index') }}"> <i class="fa fa-video-camera"></i> <span>Event</span> <span class="pull-right-container"> </span> </a></li>
            <li> <a href="/dashboard/withdraw"> <i class="fa fa-credit-card"></i> <span>Penarikan Dana</span> <span class="pull-right-container"> </span> </a></li>
            <li> <a href="/dashboard/confirmation_class"> <i class="fa fa-diamond"></i> <span>Premium Request</span> <span class="pull-right-container"> </span> </a></li>
            @endif
            @if(Auth::user()->role == 'admin' || Auth::user()->role == 'super_admin')
            <li> <a href="/dashboard/livestream"> <i class="fa fa-video-camera"></i> <span>Live Streaming</span></a></li>
            <li class="treeview"> <a href="#"> <i class="fa fa-bullhorn"></i> <span>Pengumuman</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
                <ul class="treeview-menu">
                    <li><a href="/dashboard/announcement">Pengumuman</a></li>
                    <li><a href="/dashboard/advertisement/text">Iklan Mini Header</a></li>
                    <li><a href="/dashboard/advertisement/banner">Banner</a></li>
                </ul>
            </li>
            <li class="treeview"> <a href="#"> <i class="fa fa-cogs"></i> <span>Admin</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
                <ul class="treeview-menu">
                <li><a href="/dashboard/list_user">User Setting</a></li>
                <li><a href="/dashboard/admin/materi">Materi</a></li>
                <li><a href="/dashboard/class_list">Kelas</a></li>
                <li><a href="/dashboard/creation">Karya Member</a></li>
                <li><a href="{{ route('withdraw.admin') }}">Penarikan Dana&nbsp;&nbsp;<i class="fa fa-money"></i></a></li>
                <li><a href="/dashboard/admin/partner">Partner</a></li>
                <li><a href="/dashboard/admin/setting">Setting</a></li>
                </ul>
            </li>
            @endif
            <li class="d-sm-block d-md-none">
                <a href="/logout"><i class="fa fa-power-off"></i> Logout</a>
            </li>
        </ul>
    </div>
</aside>
