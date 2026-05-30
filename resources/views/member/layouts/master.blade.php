<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{$data['meta']['title'] ? $data['meta']['title'].' - '.config('app.name') : config('app.name')}}</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="keywords" content="{{ $data['meta']['keywords'] ? $data['meta']['keywords'] : 'g-academy, course, kursus, gacademy, online, materi, academy ' }}">
    <meta name="description" content="{!!$data['meta']['desc'] ? $data['meta']['desc'] : 'Kursus online bersertifikat yang bisa meningkatkan keahlian dengan model kursus online kapan saja dan dimana saja.'!!}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="news_keywords" content=""/>

    <meta property="og:title" content="{{$data['meta']['title'] ? $data['meta']['title'] : ''}}" >
    <meta property="og:description" content="{!!$data['meta']['desc'] ? $data['meta']['desc'] : ''!!}" >
    <meta property="og:type" content="article" />
    <meta property="og:url" content="{{$data['meta']['m_url'] ? $data['meta']['m_url'] : ''}}" >
    <meta property="og:image" content="{{$data['meta']['image'] ? $data['meta']['image'] : ''}}" >
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="800">
    <meta property="og:image:height" content="450">
    <meta property="og:site_name" content="g-academy.net" >

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@gacademynet">
    <meta name="twitter:creator" content="@gacademynet">
    <meta name="twitter:title" content="{{$data['meta']['title'] ? $data['meta']['title'] : ''}}">
    <meta name="twitter:description" content="{!!$data['meta']['desc'] ? $data['meta']['desc'] : ''!!}">
    <meta name="twitter:image" content="{{$data['meta']['image'] ? $data['meta']['image'] : ''}}">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('img/favicon.png')}}">

    <meta name="csrf-token" content="{{ csrf_token() }}" />


    <link rel="stylesheet" href="{{asset('backend')}}/dist/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/plugins/icofont.min.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/plugins/flaticon.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/plugins/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/plugins/animate.min.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/plugins/swiper-bundle.min.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/plugins/magnific-popup.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/plugins/nice-select.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/plugins/apexcharts.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/plugins/jqvmap.min.css">
    <link rel="stylesheet" href="{{asset('backend')}}/dist/plugins/dropify/dropify.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('member')}}/rating_stars/rating/css/star-rating.css">
        <style type="text/css">
            .rating-header {
                margin-top: -10px;
                margin-bottom: 10px;
            }
        </style>
    <link rel="stylesheet" href="{{asset('assets')}}/css/style.css">
</head>

<body>

    <div class="main-wrapper">

        @include('member.layouts.header')
        @include('member.layouts.mobile-menu')
        <div class="overlay"></div>

        @yield('content')

       @include('member.layouts.main-footer')

        <a href="#" class="back-to-top">
            <i class="icofont-simple-up"></i>
        </a>

    </div>


    <script src="{{asset('assets')}}/js/vendor/modernizr-3.11.2.min.js"></script>
    <script src="{{asset('assets')}}/js/vendor/jquery-3.5.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>

    <script src="{{asset('assets')}}/js/plugins/swiper-bundle.min.js"></script>
    <script src="{{asset('assets')}}/js/plugins/jquery.magnific-popup.min.js"></script>
    <script src="{{asset('assets')}}/js/plugins/video-playlist.js"></script>
    <script src="{{asset('assets')}}/js/plugins/jquery.nice-select.min.js"></script>
    <script src="{{asset('assets')}}/js/plugins/ajax-contact.js"></script>
    <script src="{{asset('assets')}}/js/main.js"></script>
    <script src="{{asset('backend')}}/dist/plugins/dropify/dropify.min.js"></script>
    <script>
        $(document).ready(function(){
            // Basic
            $('.dropify').dropify();

            // Translated
            $('.dropify-fr').dropify({
                messages: {
                    default: 'Glissez-déposez un fichier ici ou cliquez',
                    replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                    remove:  'Supprimer',
                    error:   'Désolé, le fichier trop volumineux'
                }
            });

            // Used events
            var drEvent = $('#input-file-events').dropify();

            drEvent.on('dropify.beforeClear', function(event, element){
                return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
            });

            drEvent.on('dropify.afterClear', function(event, element){
                alert('File deleted');
            });

            drEvent.on('dropify.errors', function(event, element){
                console.log('Has Errors');
            });

            var drDestroy = $('#input-file-to-destroy').dropify();
            drDestroy = drDestroy.data('dropify')
            $('#toggleDropify').on('click', function(e){
                e.preventDefault();
                if (drDestroy.isDropified()) {
                    drDestroy.destroy();
                } else {
                    drDestroy.init();
                }
            })
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#announcement").modal('show');
            $('#startClass').modal('show');
            $('#alertPay').modal('show');
            $('#nextAlert').modal('show');
            $('#getCertificate').modal('show');
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

    @stack('script')

</body>

</html>
