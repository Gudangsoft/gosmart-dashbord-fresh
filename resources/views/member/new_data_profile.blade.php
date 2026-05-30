@extends('member.layouts.master')
@section('content')
<div class="single-channel-page" id="content-wrapper">
<div class="container-fluid upload-details">
    <div class="row">
        <div class="col-lg-12">
            <div class="main-title">
            <h6>Lengkapi Biodata</h6>
            </div>
            <p>
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">
                            {{$error}}
                        </div>
                    @endforeach
                @endif
            </p>
        </div>
        </div>
        <form action="/learning/profile_save" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <input class="form-control border-form-control" value="{{auth()->user()->id}}" placeholder="Gurdeep" type="hidden" name="id">
                <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label">Photo <span class="required">*</span></label>
                    <div class="card">
                        <div class="card-body">
                        <label for="input-file-disable-remove">Foto maksimal <b>5 MB</b></label>
                        <input type="file" name="photo" id="input-file-disable-remove" class="dropify" data-show-remove="true" />
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label">Phone <span class="required">*</span></label>
                    <input class="form-control border-form-control" value="" placeholder="0821450XXXXX" type="number" name="phone">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                <div class="form-group">
                    <label class="control-label">Alamat lengkap <span class="required">*</span></label>
                    <textarea class="form-control border-form-control" name="address" rows="5"></textarea>
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