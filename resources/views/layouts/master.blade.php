<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="Askbootstrap">
      <meta name="author" content="Askbootstrap">

      <title>G-Academy.net</title>
      <!-- Favicon Icon -->
      <link rel="icon" type="image/png" href="{{asset('img/favicon.png')}}">

      <!-- Bootstrap core CSS-->
      <link href="{{asset('/new/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
      <!-- Custom fonts for this template-->
      <link href="{{asset('/new/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
      <!-- Custom styles for this template-->
      <link href="{{asset('/new/css/osahan.css')}}" rel="stylesheet">
      <!-- Owl Carousel -->
      <link rel="stylesheet" href="{{asset('/new/vendor/owl-carousel/owl.carousel.css')}}">
      <link rel="stylesheet" href="{{asset('/new/vendor/owl-carousel/owl.theme.css')}}">
   </head>
   <body id="page-top">
      <nav class="navbar navbar-expand navbar-light bg-white static-top osahan-nav sticky-top">
         &nbsp;&nbsp;
         <button class="btn btn-link btn-sm text-secondary order-1 order-sm-0" id="sidebarToggle">
         <i class="fas fa-bars"></i>
         </button> &nbsp;&nbsp;
         <a class="navbar-brand mr-1" href="/admin"><img class="img-fluid" alt="" src="{{asset('img/logo.png')}}" ></a>
         Selamat Datang : {{ Auth::user()->name }} <br>  Status Anda : {{ Auth::user()->role }}
         <!-- Navbar Search -->
         <form action="/dashboard/search" method="POST" class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-5 my-2 my-md-0 osahan-navbar-search">
            @csrf
            <div class="input-group">
               <input type="text" name="search" class="form-control" placeholder="Search for...">
               <div class="input-group-append">
                  <button class="btn btn-light" type="submit">
                  <i class="fas fa-search"></i>
                  </button>
               </div>
            </div>
         </form>
         <!-- Navbar -->
         <ul class="navbar-nav ml-auto ml-md-0 osahan-right-navbar">
            <li class="nav-item mx-1">
               <a class="nav-link" href="/admin">
               <i class="fas fa-plus-circle fa-fw"></i>
               Upload Video
               </a>
            </li>
            <li class="nav-item dropdown no-arrow mx-1">
               <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <i class="fas fa-bell fa-fw"></i>
               <span class="badge badge-danger">9+</span>
               </a>
               <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
                  <a class="dropdown-item" href="#"><i class="fas fa-fw fa-edit "></i> &nbsp; Action</a>
                  <a class="dropdown-item" href="#"><i class="fas fa-fw fa-headphones-alt "></i> &nbsp; Another action</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#"><i class="fas fa-fw fa-star "></i> &nbsp; Something else here</a>
               </div>
            </li>
            <li class="nav-item dropdown no-arrow mx-1">
               <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <i class="fas fa-envelope fa-fw"></i>
               <span class="badge badge-success">7</span>
               </a>
               <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
                  <a class="dropdown-item" href="#"><i class="fas fa-fw fa-edit "></i> &nbsp; Action</a>
                  <a class="dropdown-item" href="#"><i class="fas fa-fw fa-headphones-alt "></i> &nbsp; Another action</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#"><i class="fas fa-fw fa-star "></i> &nbsp; Something else here</a>
               </div>
            </li>

            <li class="nav-item dropdown no-arrow osahan-right-navbar-user">
               <a class="nav-link dropdown-toggle user-dropdown-link" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <img alt="Avatar" src="{{asset('/img/c.png')}}">
               {{ Auth::user()->name }}
               </a>

               <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                  <a class="dropdown-item" href="account.html"><i class="fas fa-fw fa-user-circle"></i> &nbsp;{{ Auth::user()->name }} </a>
                  <a class="dropdown-item" href="settings.html"><i class="fas fa-fw fa-cog"></i> &nbsp; Settings</a>

                      <a class="dropdown-item" href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                          {{ __('Logout') }}
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
               </div>
            </li>
         </ul>
      </nav>
      <div id="wrapper">
         <!-- Sidebar -->
         <ul class="sidebar navbar-nav">

            <li class="nav-item ">
               <a class="nav-link" href="/admin">
               <i class="fa fa-upload"></i>
               <span>Upload Video Link</span>
               </a>
            </li>

            <li class="nav-item ">
               <a class="nav-link" href="/data-upload">
               <i class="fas fa-fw fa-video"></i>
               <span>Video Saya</span>
               </a>
            </li>



            @if( Auth::user()->role == 'admin')
              <li class="nav-item">
                 <a class="nav-link" href="{{route('Streaming')}}">
                 <i class="fas fa-fw fa-cloud-upload-alt"></i>
                 <span>Upload Streaming</span>
                 </a>
              </li>
            @endif



            <li class="nav-item">
               <a class="nav-link" href="/list-chanel">
               <i class="fas fa-fw fa-user-alt"></i>
               <span>Channel</span>
               </a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="{{route('videopage')}}">
               <i class="fas fa-fw fa-video"></i>
               <span>Video Page</span>
               </a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="/add-chanel">
               <i class="fas fa-fw fa-cloud-upload-alt"></i>
               <span>Add Chanel</span>
               </a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="{{route('home')}}">
               <i class="fas fa-fw fa-home"></i>
               <span>Ke Halaman Utama</span>
               </a>
            </li>

         </ul>




         @yield('content')

      <script src="{{asset('new/vendor/jquery/jquery.min.js')}}"></script>
      <script src="{{asset('/new/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
      <script src="{{asset('/new/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
      <script src="{{asset('/new/vendor/owl-carousel/owl.carousel.js')}}"></script>
      <script src="{{asset('/new/js/custom.js')}}"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   </body>
</html>
