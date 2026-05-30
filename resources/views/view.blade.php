@extends('layouts.master')

@section('content')


<div id="content-wrapper">
   <div class="container-fluid pb-0">
      <div class="top-mobile-search">
         <div class="row">
            <div class="col-md-12">
               <form class="mobile-search">
                  <div class="input-group">
                    <input type="text" placeholder="Cari Materi..." class="form-control">
                      <div class="input-group-append">
                        <button type="button" class="btn btn-dark"><i class="fas fa-search"></i></button>
                      </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <hr>
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
                  <h6>Materi Terbaru </h6> 
                
                 
               </div>
            </div>

            @foreach ($view_stream as $row)
            <div class="col-xl-3 col-sm-6 mb-3">
               <div class="video-card">
                  <div class="video-card-image">
                     <a class="play-icon" href="{{$row->link}}"target="_blank"><i class="fas fa-play-circle"></i></a>
                     <a href="#"><img class="img-fluid" src="{{('/home-images')}}/{{$row->gambar}}"style="width:500px;height:190px;" itemprop="thumbnail" alt="" ></a>
                     <div class="time">3:50</div>
                  </div>
                  <div class="video-card-body">
                     <div class="video-title">
                        <a href="#">{{$row->judul}}</a>
                     </div>
                     <div class="video-page text-success">
                        {{$row->keterangan}}<a title="" data-placement="top" data-toggle="tooltip" ></i></a>
                     </div>
                     <div class="video-view">
                       {{$row->kategori}}&nbsp;<i class="fas fa-calendar-alt"></i>  {{$row->updated_at}}
                     </div>
                     <hr>
                     <div class="channels-card-image">
                   <a href="#"><img class="img-fluid" src="{{('/chanel-image')}}/{{$row->chanel_img}}"style="width:40px;height:40px;" itemprop="thumbnail" alt=""></a>
                     {{$row->nama_chanel}}
                 </div>
                  </div>
               </div>

            </div>

            @endforeach
         </div>
         <nav aria-label="Page navigation example">
            {{$view_stream->links()}}
         </nav>
      </div>

     

         </div>
      </div>
   </div>
   <!-- /.container-fluid -->
   <!-- Sticky Footer -->


@endsection
