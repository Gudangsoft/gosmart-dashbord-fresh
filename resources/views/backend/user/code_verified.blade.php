
<!DOCTYPE html>
<html lang="en" oncontextmenu="return false">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Niche Admin - Powerful Bootstrap 4 Dashboard and Admin Template</title>
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
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-box-body">
    <h3 class="login-box-msg">G-Academy</h3>
    <p class="text-center">Cek email <b>{{auth()->user()->email}}</b> untuk mendapatkan kode konfirmasi</p>
    <form action="/dashboard/code_confirmation" method="post">
    @csrf
      <div class="form-group has-feedback">
        <input type="hidden" name="code_a" class="form-control sty1" value="{{$kode}}">
        <input type="text" name="code_b" class="form-control sty1">
      </div>
      <div>
        <!-- /.col -->
        <div class="col-xs-4 m-t-1">
          <button type="submit" class="btn btn-primary btn-block btn-flat">KONFIRMASI</button>
        </div>
        <!-- /.col --> 
      </div>
    </form>
    
  </div>
  <!-- /.login-box-body --> 
</div>
<!-- /.login-box --> 

<!-- jQuery 3 --> 
<script src="{{asset('backend')}}/dist/{{asset('backend')}}/js/jquery.min.js"></script> 

<!-- v4.0.0-alpha.6 --> 
<script src="{{asset('backend')}}/dist/bootstrap/{{asset('backend')}}/js/bootstrap.min.js"></script> 

<!-- template --> 
<script src="{{asset('backend')}}/dist/{{asset('backend')}}/js/niche.js"></script>
<script>
    $(document).keydown(function(e)
    {
        if(e.which === 123){
            return false;
        }
    });
</script>
</body>
</html>