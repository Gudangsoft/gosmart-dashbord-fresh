@extends('member.layouts.master')
@section('content')
<div class="single-channel-page" id="content-wrapper">
<div class="container-fluid upload-details">
    <div class="row">
        <div class="col-lg-12">
            <div class="main-title">
            <h6>Settings</h6>
            </div>
            <p>
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">
                            {{$error}}
                        </div>
                    @endforeach
                @endif
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
            </p>
        </div>
        </div>
        <form action="/learning/profile_update" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label">Full name <span class="required">*</span></label>
                    <input class="form-control border-form-control" value="{{$user->id}}" placeholder="Gurdeep" type="hidden" name="id">
                    <input class="form-control border-form-control" value="{{ucfirst($user->name)}}" placeholder="Gurdeep" type="text" name="name" required>
                </div>
                </div>
                <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label">Photo <span class="required">*</span></label>
                    <input class="form-control border-form-control" type="file" name="photo">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label">Phone <span class="required">*</span></label>
                    <input class="form-control border-form-control" value="{{$user->phone}}" placeholder="123 456 7890" type="number" name="phone" required>
                </div>
                </div>
                <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label">Email <span class="required">*</span></label>
                    <input class="form-control border-form-control " value="{{$user->email}}" type="email" name="email">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                <div class="form-group">
                    <label class="control-label">Alamat <span class="required">*</span></label>
                    <textarea class="form-control border-form-control" name="address">{{$user->address}}</textarea>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-right">
                <!-- <button type="button" class="btn btn-danger border-none"> Cencel </button> -->
                <button type="submit" class="btn btn-success border-none"> SIMPAN </button>
                </div>
            </div>
        </form>
    </div>
</div>
    <!-- /.container-fluid -->
    <!-- Sticky Footer -->

</div>
@include('member.layouts.footer')
@endsection
