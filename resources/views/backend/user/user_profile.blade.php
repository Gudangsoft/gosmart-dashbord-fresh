@extends('backend.layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header sty-one">
      <h1 class="text-black">Profile Page</h1>
      <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="sub-bread"><i class="fa fa-angle-right"></i> Pages</li>
        <li><i class="fa fa-angle-right"></i> Profile Page</li>
      </ol>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="row">
            <div class="col-lg-4">

            <div class="user-profile-box m-b-3">
                <div class="box-profile text-secondary"> <img class="profile-user-img img-responsive img-circle m-b-2" src="{{$profile['photo']}}" style="width:120px;height:120px;" alt="User profile picture">
                <h3 class="profile-username text-center">{{$data['name']}}</h3>
                <p class="text-center">{{$profile['email']}}</p>
                <p class="text-center">{!!$profile['bio']!!}</p>
                </div>
            </div>
            <div class="info-box">
                <div class="box-body"> <strong><i class="fa fa-book margin-r-5"></i> Education</strong>
                    <p class="text-muted"> {{ucwords($profile['education'])}} </p>
                    <hr>
                    <strong><i class="fa fa-envelope margin-r-5"></i> Email address </strong>
                    <p class="text-muted">{{$profile['email']}}</p>
                    <hr>
                    <strong><i class="fa fa-phone margin-r-5"></i> Phone</strong>
                    <p>{{$profile['phone']}} </p>
                    <hr>
                    <strong><i class="fa fa-map-marker margin-r-5"></i> Address</strong>
                    <p class="text-muted">{{$profile['address']}}</p>
                    {{-- <div class="embed-container maps">
                        <iframe class="full-wid" src="https://maps.google.co.in/maps?sll=34.0204989,-118.4117325&amp;sspn=0.8745562,1.4073488&amp;cid=16298491244936825076&amp;q=Los+Angeles,+CA,+USA&amp;ie=UTF8&amp;hq=&amp;hnear=Los+Angeles,+Los+Angeles+County,+California,+United+States&amp;t=m&amp;ll=34.052234,-118.243685&amp;spn=0.697085,0.848982&amp;output=embed" style="pointer-events: none;"></iframe>
                    </div> --}}
                    <hr>
                    <strong><i class="fa fa-phone margin-r-5"></i> Social Profile</strong>
                    <div class="text-left mt-3">
                        <a class="btn btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></a>
                        <a class="btn btn-social-icon btn-foursquare"><i class="fa fa-instagram"></i></a>
                        <a class="btn btn-social-icon btn-linkedin"><i class="fa fa-linkedin"></i></a>
                        <a class="btn btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></a>
                        <a class="btn btn-social-icon btn-success"><i class="fa fa-whatsapp" style="color:#fff;"></i></a>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            </div>
            <div class="col-lg-8">
                @if(Session::has('msg'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert"> {{session()->get('msg')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                  </div>
                @endif
                @if(Session::has('error'))
                  <div class="alert alert-danger alert-dismissible fade show" role="alert"> {{session()->get('error')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                  </div>
                @endif
            <div class="info-box">
                <div class="card tab-style1">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs profile-tab" role="tablist">
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab" aria-expanded="false">Profile</a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab">Settings</a> </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <!--second tab-->
                    <div class="tab-pane" id="profile" role="tabpanel" aria-expanded="false">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3 col-xs-6 b-r"> <strong>Full Name</strong> <br>
                                    <p class="text-muted">{{$profile['name']}}</p>
                                </div>
                                <div class="col-lg-3 col-xs-6 b-r"> <strong>Mobile</strong> <br>
                                    <p class="text-muted">{{$profile['phone']}}</p>
                                </div>
                                <div class="col-lg-3 col-xs-6 b-r"> <strong>Email</strong> <br>
                                    <p class="text-muted">{{$profile['email']}}</p>
                                </div>
                            </div>
                            <hr>
                            <p>{!!$profile['bio']!!}</p>
                            <div class="row">
                                <div class="col-6"><h4 class="font-medium m-t-3">Skill</h4></div>
                                <div class="col-6 text-right pt-4"><a href="/dashboard/skill_reset" class="btn btn-sm btn-warning">reset</a></div>
                            </div>
                            <hr>
                            <div>
                            @if ($profile['skill_list'] != null)
                            {{-- {{dd($profile['skill_list'][0])}} --}}
                                @foreach ($profile['skill_list'] as $k => $v)
                                    <table>
                                        @for ($i = 0; $i < count($v->name); $i++)
                                        <h6 class="m-t-3">{!!strtoupper($v->name[$i])!!} <span class="pull-right">{!!$v->value[$i]!!}</span></h6>
                                        <div class="progress">
                                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:{!!$v->value[$i]!!}%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
                                        </div>
                                        @endfor
                                    </table>
                                @endforeach
                            @else
                                <h6>Belum ditambahkan</h6>
                            @endif
                            </div>
                            <hr>

                            <h4 class="font-medium m-t-3">Add</h4>
                            <div class="row">
                                <div class="col-12">
                                <div class="form-group">
                                      <div class="dynamic-wrap">
                                        <form action="/dashboard/skill_add" method="POST" role="form" autocomplete="off" enctype="multipart/form-data">
                                            @csrf
                                            <div class="entry input-group mb-1">
                                                <input class="form-control mr-2" name="fields[]" type="text" placeholder="Your skill" />
                                                <input class="form-control col-2 mr-2" name="nilai[]" type="number" placeholder="1-100">
                                                <span class="input-group-btn">
                                                <button class="btn btn-primary btn-add" type="button">
                                                        <span class="fa fa-plus"></span>
                                                </button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="text-left">
                                            <input type="submit" class="btn btn-success" value="save">
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('backend.user.settings')
                </div>
                </div>
            </div>
            </div>
        </div>
      <!-- Main row -->
    </div>
@endsection
