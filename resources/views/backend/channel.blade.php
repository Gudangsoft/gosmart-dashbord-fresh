@extends('backend.layouts.master')
@section('content')
<!-- Content Header (Page header) -->
    <!-- <div class="content-header sty-one">
      <h1 class="text-black">HASIL PENCARIAN</h1>
      
    </div> -->
    <!-- Main content -->
    <div class="content">
        <div class="info-box">
            <!-- <h4 class="text-black">Cards</h4>
            <p>A <strong>card</strong> is a flexible and extensible content container. It includes options for headers and footers, a wide variety of content, contextual background colors, and powerful display options.</p> -->
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="text-black">G-Academy Learning</h4>
                    <p>Dukung channel favorit kamu <a href="/docs/4.0/components/navs/">klik disini</a>.</p>
                    <div class="row">
                        
                        <div class="col-lg-4">
                            <div class="card text-center">
                                <div class="card-header">
                                    <ul class="nav nav-tabs card-header-tabs">
                                    <li class="nav-item"> <a class="nav-link active" href="#">Active</a> </li>
                                    <li class="nav-item"> <a class="nav-link disabled" href="/youtube">Youtube</a> </li>
                                    <li class="nav-item"> <a class="nav-link" href="#">About</a> </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="box box-primary">
                                        <div class="box-profile"> <img class="profile-user-img img-responsive img-circle" src="{{('/chanel-image')}}/{{$data['img']}}" alt="User profile picture">
                                        <h3 class="profile-username text-center">{{$data['name']}}</h3>
                                        <p class="text-muted text-center">Orang hebat</p>
                                        <ul class="list-group mt-5">
                                            @foreach($jumlah_data as $v)
                                                <li class="list-group-item d-flex justify-content-between align-items-center"> {{$v->getclass->name}} <span class="badge badge-primary badge-pill">{{$v->jumlah}}</span> </li>
                                            @endforeach
                                        </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection