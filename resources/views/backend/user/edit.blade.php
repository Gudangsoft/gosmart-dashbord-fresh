@extends('backend.layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header sty-one">
      <h1 class="text-black">User</h1>
      <ol class="breadcrumb">
        <li><a href="#">Dashboard</a></li>
        <li class="sub-bread"><i class="fa fa-angle-right"></i> admin</li>
        <li class="sub-bread"><i class="fa fa-angle-right"></i> user</li>
      </ol>
    </div>
    
    <!-- Main content -->
    <div class="content">
      <div class="row">
        <div class="col-lg-12">
          @if($errors->any())
            @foreach($errors->all() as $error)
              <div class="alert alert-danger" role="alert"> {{$error}} </div>
            @endforeach
          @endif
        </div>
        <div class="col-lg-12">
          <div class="card ">
            <p>
              <h3>Coming soon...</h3>
            </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content --> 
@endsection