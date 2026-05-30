@extends('backend.layouts.master')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header sty-one">
      <h1 class="text-black">Video</h1>
      <ol class="breadcrumb">
        <li><a href="#">Dashboard</a></li>
        <li class="sub-bread"><i class="fa fa-angle-right"></i> Video Detail</li>
      </ol>
</div>
 <!-- Main content -->
 <div class="content">
      <div class="info-box">
        <div class="row">
          <div class="col-lg-12">
            <div class="chart-box">
              <div id="js-grid-masonry" class="cbp">
                <div class="cbp-item identity"> <a href="{{asset('backend')}}/dist/img/media/portfolio-2.jpg" class="cbp-caption cbp-lightbox" data-title="Setting Simply Dummy<br>by UXLiner">
                  <div class="cbp-caption-defaultWrap"> <img src="{{asset('backend')}}/dist/img/media/thumb/thumb2.jpg" alt=""> </div>
                  <div class="cbp-caption-activeWrap">
                    <div class="cbp-l-caption-alignCenter">
                      <div class="cbp-l-caption-body">
                        <div class="cbp-l-caption-title">Setting Simply Dummy</div>
                        <div class="cbp-l-caption-desc">by UXLiner</div>
                      </div>
                    </div>
                  </div>
                  </a> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content --> 
  </div>
@endsection