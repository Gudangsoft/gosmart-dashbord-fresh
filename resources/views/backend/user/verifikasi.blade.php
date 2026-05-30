
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>EMAIL KONFIRMASI - G-Academy</title>
<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1" />

<!-- v4.0.0-alpha.6 -->
<link rel="stylesheet" href="{{asset('backend')}}/dist/bootstrap/css/bootstrap.min.css">

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

<!-- Theme style -->
<link rel="stylesheet" href="{{asset('backend')}}/dist/css/style.css">
<link rel="stylesheet" href="{{asset('backend')}}/dist/css/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="{{asset('backend')}}/dist/css/et-line-font/et-line-font.css">
<link rel="stylesheet" href="{{asset('backend')}}/dist/css/themify-icons/themify-icons.css">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

</head>
<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<div style="margin: 20px;">
  <div class="error-page text-center">
    <h2 class="headline text-yellow"><i class="fa fa-warning text-yellow"></i></h2>
    <div>
      <h3> Oops! Sepertinya anda belum melakukan verifikasi</h3>
      <p>Agar dapat menggunakan semua fitur aplikasi, anda harus melakukan verifikasi email.</p>
      <form class="search-form" action='/dashboard/profile_verified' method='POST'  enctype="multipart/form-data">
      @csrf
        <div class="input-group">
          <input name="email" class="form-control" placeholder="Masukan email...." type="text">
          <div class="input-group-btn">
            <button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-send"></i> </button>
          </div>
        </div>
        @if(Session::has('msg'))
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert"> {{session()->get('msg')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
            </div>
        @endif
        <!-- /.input-group -->
      </form>
    </div>
    <!-- /.error-content -->
  </div>
  <div class="lockscreen-footer text-center m-t-3"> Copyright © 2021 <a href="https://github.com/jarwonozt">Jarwonoztech</a> | G-Academy All rights reserved. </div>
</div>
<!-- /.center -->
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{asset('backend')}}/dist/js/jquery.min.js"></script>

<!-- v4.0.0-alpha.6 -->
<script src="{{asset('backend')}}/dist/bootstrap/js/bootstrap.min.js"></script>

<!-- template -->
<script src="{{asset('backend')}}/dist/js/niche.js"></script>
</body>
</html>
