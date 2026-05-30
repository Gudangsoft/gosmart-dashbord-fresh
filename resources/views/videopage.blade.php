@extends('layouts.master')

@section('content')
         <div id="content-wrapper">
            <div class="container-fluid pb-0">
               <div class="video-block section-padding">
                  <div class="row">
                     <div class="col-md-8">
                        <div class="single-video-left">
                           <div class="single-video ">
                              <iframe width="696" height="415" src="{{$home->link_streaming}}?modestbranding=1&autoplay=1&rel=0"  frameborder="2" allow="contors="0";  accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen ></iframe>
                           </div>
                           <div class="single-video-title box mb-3">
                              <h2><a href="https://g-academy.net/videopage"><strong> {{$home->judul}}</strong></a></h2>
                              
                           </div>
                           <div class="single-video-author box mb-3">
                              <div class="float-right"><button class="btn btn-danger" type="button">BERI <strong>BINTANG</strong></button> <button class="btn btn btn-outline-danger" type="button"><i class="fa fa-star"></i></button></div>
                              <img class="img-fluid" src="{{('/chanel-image')}}/{{$idchanel->chanel_img }}" alt="">
                              <p><a href="#"><strong>{{$idchanel->nama_chanel}}</strong></a> <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Verified"><i class="fas fa-check-circle text-success"></i></span></p>
                              <small>Published  {{$home->created_at}} </small> 
                             
                                     
                           </div>
                           <div class="single-video-info-content box mb-3">

                              <h6>Kategori :</h6>
                              <p>{{$home->kategori}}</p>
                              <h6>Pemateri :</h6>
                              <p>{{$idchanel->nama_chanel}}</p>
                              <h6>Keterangan / Link Download Pendukung :</h6>
                              <p>{{$home->keterangan}} </p>
                              <h6>Tags :</h6>
                              <p class="tags mb-0">
                                 <span><a href="#">{{$home->kategori}}</a></span>
                                 <span><a href="#">NGODING</a></span>
                                 <span><a href="#">MENTORING</a></span>
                                 <span><a href="#">WEBSITE</a></span>
                                 <span><a href="#">+ 6</a></span>
                              </p>
                            
                           </div>
                        </div>
                     </div>
                     
                   
                   
                   
                   
                   
                   
                   
                   
                   
                   
                   
                   
                     
                     <div class="col-md-4">
                        <div class="single-video-right">
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
                                    
                                    <h6>Up Next</h6>
                                 </div>
                              </div>

                                @foreach ($streaming as $row)
                              <div class="col-md-12">
                                 <div class="video-card video-card-list">
                                    <div class="video-card-image">
                                       <a class="play-icon" href="{{$row->link_streaming}}"><i class="fas fa-play-circle"></i></a>
                                       <a href="#"><img class="img-fluid" target="blank" src="{{('/streaming')}}/{{$row->picture}}" alt=""></a>
                                       
                                       
                                       
                                       
                                    </div>
                                    <div class="video-card-body">
                                     
                                       </div>
                                       <div class="video-title">
                                          <a href="#">{{$row->judul}}</a>
                                       </div>
                                       <div class="video-page text-success">
                                          {{$row->kategori}} <a title="" data-placement="top" data-toggle="tooltip" href="#" data-original-title="Verified"><i class="fas fa-check-circle text-success"></i></a>
                                       </div>
                                       <div class="video-view">
                                        {{$row->created_at}} &nbsp;<i class="fas fa-calendar-alt"></i> {{$row->updated_at}}
                                       </div>
                                    </div>
                                 </div>
                                 @endforeach







 




                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            </div>
            </div>

            <!-- /.container-fluid -->
            <!-- Sticky Footer -->

@endsection
