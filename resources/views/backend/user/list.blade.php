@extends('backend.layouts.master')
@section('content')
@include('sweetalert::alert')
<div class="content-header sty-one">
    <h1 class="text-black">Data User</h1>
    <ol class="breadcrumb">
    <li><a href="#">Home</a></li>
    <li class="sub-bread"><i class="fa fa-angle-right"></i> Admin</li>
    <li><i class="fa fa-angle-right"></i> List User</li>
    </ol>
</div>

<!-- Main content -->
<div class="content">
    <div class="info-box">
        <h4 class="text-black">Data Export</h4>
        <p>Export data to Copy, CSV, Excel, PDF & Print</p>
        @if(Session::has('sukses'))
        <div class="alert alert-success" role="alert">Data berhasil diupdate  </div>
        @endif
        @if(Session::has('hidden'))
        <div class="alert alert-success" role="alert">Data berhasil dihidden  </div>
        @endif
        @if(Session::has('delete'))
        <div class="alert alert-success" role="alert">Data berhasil dihapus  </div>
        @endif
        <div class="table-responsive">
            <table id="example2" class="table table-bordered table-hover" data-name="cool-table">
            <thead>
                <tr>
                <th>Image</th>
                <th>Full Name</th>
                <th>Created at</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Role</th>
                <th>ٍAction</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                <td><img src="{{ empty($user->photo) ? '/img/user/s7.png' : '/img/user/avatar/'.$user->photo }}" class="img-circle img-responsive" alt="{{ $user->name }}" style="width: 50px;height:50px;"></td>
                <td>{{$user->name}}</td>
                <td>{{$user->created_at}}</td>
                <td>{{$user->email}}</td>
                <td><a href='https://wa.me/{{ $user->phone }}'>{{ $user->phone }}</a></td>
                @if($user->email_verified_at != null)
                    <td><span class="label label-success">verified</span></td>
                @else
                    <td><span class="label label-default">none</span></td>
                @endif
                <td>
                    <!-- {{$user->role}} -->
                    <div class="btn-group m-1">
                        <button type="button" class="btn btn-sm btn-primary">
                            @php
                                $str1 = $user->role;
                                $str2 = explode("_", $str1);
                                $str3 = implode(" ", $str2);
                            @endphp
                            {{ucwords($str3)}}
                        </button>
                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> <span class="sr-only">Toggle Dropdown</span> </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/dashboard/role_change/member/{{$user->id}}">Member</a></li>
                            <li><a href="/dashboard/role_change/teacher/{{$user->id}}">Mentor</a></li>
                            <li><a href="/dashboard/role_change/admin/{{$user->id}}">Admin</a></li>
                            <!-- <li><a href="/dashboard/role_change/super_admin/{{$user->id}}">Super Admin</a></li> -->
                        </ul>
                    </div>
                </td>
                <td>
                    <div class="btn-group m-1">
                        {{-- <button type="button" class="btn btn-sm btn-default">Pilih</button> --}}
                        <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> <span class="sr-only">Toggle Dropdown</span> </button>
                        <ul class="dropdown-menu" role="menu">
                        <li><a href="/dashboard/user/detail/{{$user->id}}">Detail</a></li>
                        <li><a href="/password-default/{{$user->id}}">Reset Default Password</a></li>
                        @if($user->status == 'active')
                            <li><a href="/dashboard/user/mute/{{$user->id}}">Mute</a></li>
                        @else
                            <li><a href="/dashboard/user/unmute/{{$user->id}}">Unmute</a></li>
                        @endif
                        <li><a style='color:#f00;' href="/dashboard/user/delete/{{$user->id}}" onclick="return confirm('Menghapus dapat menghilangkan semua data terkait dengan user. Yakin hapus ?')">delete</a></li>
                        </ul>
                    </div>

                </td>
                </tr>
            @endforeach
            </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.content -->


@endsection
