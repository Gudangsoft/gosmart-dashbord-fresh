<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CERTIFICATE - {{ $data['class'] }}</title>

    <!-- v4.0.0-alpha.6 -->
    <link rel="stylesheet" href="{{asset('backend')}}/dist/bootstrap/css/bootstrap.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('backend')}}/dist/css/style.css">
    <link rel="stylesheet" href="{{asset('backend')}}/dist/css/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('backend')}}/dist/css/et-line-font/et-line-font.css">
    <link rel="stylesheet" href="{{asset('backend')}}/dist/css/themify-icons/themify-icons.css">

</head>
{{-- <body> --}}
<body onload="window.print();return false;">
    <div class="content">
        <div class="info-box">

            <div class="row">
                <div class="col">
                    <div class="card">
                        <img class="card-img-top img-responsive" src="{{asset($data['image'])}}" alt="Card image cap">
                    </div>

                </div>
            </div>
        </div>
    </div>

{{-- <img src="{{asset($data['image'])}}" alt=""> --}}
</body>
</html>
