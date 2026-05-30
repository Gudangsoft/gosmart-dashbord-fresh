@extends('layouts.admin')

@section('content')

<div id="content-wrapper">
  <div class="container-fluid pb-0">
     <div class="video-block section-padding">
        <div class="row">
           <div class="col-md-12">
              <div class="main-title">
                 <div class="btn-group float-right right-action">
                    <a href="#" class="right-action-link text-gray" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Sort by <i class="fa fa-caret-down" aria-hidden="true"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                       <a class="dropdown-item" href="#"><i class="fas fa-fw fa-star"></i> &nbsp; Top Rated</a>
                       <a class="dropdown-item" href="#"><i class="fas fa-fw fa-signal"></i> &nbsp; Viewed</a>
                       <a class="dropdown-item" href="#"><i class="fas fa-fw fa-times-circle"></i> &nbsp; Close</a>
                    </div>
                 </div>
                 <h6>Channels</h6>
              </div>
           </div>
           @foreach ($chanel as $row)
           
           <div class="col-xl-3 col-sm-6 mb-3">
             <a href="{{('/gudangsoftnet/chanel')}}/{{$row->id}}"class="btn btn-danger btn-sm mt-1"onclick="return confirm('yakin mau di hapus')">Hapus</a>
              <div class="channels-card">
                 <div class="channels-card-image">
                    <a href="#"><img class="img-fluid" src="{{('/chanel-image')}}/{{$row->chanel_img}}" alt=""></a>
                    <div>
                    <a href="{{$row->link_chanel}}" target="_blank"class="channels-card-image-btn"><button type="button" class="btn btn-outline-danger btn-sm">Link <strong>Chanel</strong></button></a>
                 </div>
                 </div>
                 <div class="channels-card-body">
                    <div class="channels-title">
                       <a href="#">{{$row->nama_chanel}}</a>
                    </div>
                    <div class="channels-view">
                       {{$row->nama_lengkap}}
                    </div>
                 </div>
              </div>
           </div>
           @endforeach
        </div>
        <nav aria-label="Page navigation example">
           <ul class="pagination justify-content-center pagination-sm mb-4">
              <li class="page-item disabled">
                 <a class="page-link" href="#" tabindex="-1">Previous</a>
              </li>
              <li class="page-item active"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item">
                 <a class="page-link" href="#">Next</a>
              </li>
           </ul>
        </nav>
     </div>
     
  
     @endsection
