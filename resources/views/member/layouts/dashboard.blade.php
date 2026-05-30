<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>
        G-Academy</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('img/favicon.png')}}">


    <link rel="stylesheet" href="{{asset('assets')}}/css/plugins/icofont.min.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/plugins/flaticon.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/plugins/font-awesome.min.css">

    <link rel="stylesheet" href="{{asset('assets')}}/css/plugins/animate.min.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/plugins/swiper-bundle.min.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/plugins/magnific-popup.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/plugins/nice-select.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/plugins/apexcharts.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/plugins/jqvmap.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('member')}}/rating_stars/rating/css/star-rating.css">
        <style type="text/css">
            .rating-header {
                margin-top: -10px;
                margin-bottom: 10px;
            }
        </style>
    <link rel="stylesheet" href="{{asset('assets')}}/css/style.css">


    <script src="{{asset('assets')}}/js/vendor/modernizr-3.11.2.min.js"></script>
    <script src="{{asset('assets')}}/js/vendor/jquery-3.5.1.min.js"></script>
    <script src="{{asset('assets')}}/js/plugins/bootstrap.min.js"></script>


</head>

<body>
    <div class="main-wrapper main-wrapper-02">

        @include('member.layouts.dashboard-header')
        @yield('content')
        @include('member.layouts.dashboard-footer')
    </div>

    <script src="{{asset('assets')}}/js/plugins/video-playlist.js"></script>
    <script src="{{asset('assets')}}/js/plugins/jquery.magnific-popup.min.js"></script>

    <script src="{{asset('assets')}}/js/plugins/popper.min.js"></script>
    <script src="{{asset('assets')}}/js/plugins/swiper-bundle.min.js"></script>
    <script src="{{asset('assets')}}/js/plugins/jquery.nice-select.min.js"></script>
    <script src="{{asset('assets')}}/js/plugins/ajax-contact.js"></script>

    <script src="{{asset('assets')}}/js/main.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#announcement").modal('show');
        });
    </script>
    <script>
        $(document).ready(function($){

            $(".btnrating").on('click',(function(e) {

            var previous_value = $("#selected_rating").val();

            var selected_value = $(this).attr("data-attr");
            $("#selected_rating").val(selected_value);

            $(".selected-rating").empty();
            $(".selected-rating").html(selected_value);

            for (i = 1; i <= selected_value; ++i) {
            $("#rating-star-"+i).toggleClass('btn-warning');
            $("#rating-star-"+i).toggleClass('btn-default');
            }

            for (ix = 1; ix <= previous_value; ++ix) {
            $("#rating-star-"+ix).toggleClass('btn-warning');
            $("#rating-star-"+ix).toggleClass('btn-default');
            }

        }));
        });

    </script>
</body>

</html>
