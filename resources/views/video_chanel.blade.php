@extends('layouts.masterview')

@section('content')


<div id="content-wrapper">
   <div class="container-fluid pb-0">

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
                           <h6>Videos</h6>
                        </div>
                     </div>
                    @foreach ($view_stream as $row)
                    @foreach ($chanel as $cek)
                     <div class="col-xl-3 col-sm-6 mb-3">
                        <div class="video-card">
                          <div class="video-card-image">
                             <a class="play-icon" href="{{$row->link}}"target="_blank"><i class="fas fa-play-circle"></i></a>
                             <a href="#"><img class="img-fluid" src="{{('/home-images')}}/{{$row->gambar}}"style="width:500px;height:190px;" itemprop="thumbnail" alt=""></a>
                             <div class="time">3:50</div>
                          </div>
                           <div class="video-card-body">
                              <div class="video-title">
                                 <a href="#">{{$row->judul}}</a>
                              </div>
                              <div class="video-page text-success">
                                {{$row->keterangan}}<a title="" data-placement="top" data-toggle="tooltip" href="#" data-original-title="Verified"><i class="fas fa-check-circle text-success"></i></a>
                              </div>
                              <div class="video-view">
                                {{$row->kategori}}s &nbsp;<i class="fas fa-calendar-alt"></i>{{$row->updated_at}}
                              </div>
                              <hr>
                              <div class="channels-card-image">
                            <a href="#"><img class="img-fluid" src="{{('/chanel-image')}}/{{$cek->chanel_img}}"style="width:40px;height:40px;" itemprop="thumbnail" alt=""></a>
                              {{$cek->nama_chanel}}
                          </div>
                           </div>
                        </div>
                     </div>
                     @endforeach
                     @endforeach


                  </div>
                  <nav aria-label="Page navigation example">
                     <ul class="pagination justify-content-center pagination-sm mb-0">
                        <li class="page-item disabled">
                           <a tabindex="-1" href="#" class="page-link">Previous</a>
                        </li>
                        <li class="page-item active"><a href="#" class="page-link">1</a></li>
                        <li class="page-item"><a href="#" class="page-link">2</a></li>
                        <li class="page-item"><a href="#" class="page-link">3</a></li>
                        <li class="page-item">
                           <a href="#" class="page-link">Next</a>
                        </li>
                     </ul>
                  </nav>
               </div>
            </div>


            @endsection
