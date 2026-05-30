@extends('backend.layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header sty-one">
      <h1 class="text-black">Kelas Baru</h1>
      <ol class="breadcrumb">
        <li><a href="#">Dashboard</a></li>
        <li class="sub-bread"><i class="fa fa-angle-right"></i> kelas</li>
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
          @if(Session::has('sukses'))
            <div class="alert alert-success" role="alert">Kelas berhasil ditambah  </div>
          @endif
          @if(Session::has('danger'))
            <div class="alert alert-warning" role="alert">Anda sudah menambahkan 3 kelas, anda tidak bisa menambah kelas lagi </div>
          @endif
        </div>
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h4>Tambahkan kelas baru</h4>
              <!-- <p>made with bootstrap elements</p> -->
                <form class="form" action="/dashboard/category_save" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                    <!-- <label for="exampleInputuname">Name</label> -->
                    <div class="input-group">
                        <div class="input-group-addon"><i class="ti-list"></i></div>
                        <input class="form-control" name="name" id="exampleInputuname" placeholder="nama kelas" type="text" autofocus>
                    </div>
                    </div>
                    <div class="form-group">
                      <div class="card">
                          <div class="card-body">
                              <h4 class="text-black">Tambah Gambar</h4>
                              <label for="input-file-now">Gambar dengan ukuran 1080 x 1080 pixel atau square 1:1 sangat direkomendasikan</label>
                              <input type="file" name="image" id="input-file-now" class="dropify" data-default-file=""/>
                          </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Tambah</button>
                    <!-- <button type="submit" class="btn btn-inverse waves-effect waves-light">Cancel</button> -->
                </form>
                
                
            </div>
          </div>
          <div class="card bg-light mt-3 mb-3">
            <div class="card-header">Peringatan</div>
            <div class="card-body">
              <!-- <h4 class="card-title">Perhatian</h4> -->
              <p class="card-text"><span class="badge badge-danger badge-pill p-2">Mentor</span> hanya bisa menambahkan maksimal 3 kelas.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
        <!-- <div class="col-lg-6 col-sm-6 m-b-3"> -->
          <!-- </div> -->
              <div class="card p-3">
                <h4 class="text-black">List kelas</h4>
                <p>Dafatar kelas yang sudah ada</p>
                <ul class="list-group">
                  @foreach($category as $row)
                  <li class="list-group-item">{{ucfirst($row->name)}}</li>
                  @endforeach
                </ul>
                <div class="d-flex justify-content-center mt-3">
                  {{$category->links()}}
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content --> 
@endsection