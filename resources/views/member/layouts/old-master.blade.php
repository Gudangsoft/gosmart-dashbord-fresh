
<!DOCTYPE html>
<html lang="en">
   <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Askbootstrap">
        <meta name="author" content="Askbootstrap">
        <title>G-Academy</title>
        <!-- Favicon Icon -->
        <link rel="icon" type="image/png" href="{{asset('member')}}/img/favicon.png">
        <!-- Bootstrap core CSS-->
        <link href="{{asset('member')}}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom fonts for this template-->
        <link href="{{asset('member')}}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <!-- Custom styles for this template-->
        <link href="{{asset('member')}}/css/osahan_primary.css" rel="stylesheet">
        <!-- Owl Carousel -->
        <link rel="stylesheet" href="{{asset('member')}}/vendor/owl-carousel/owl.carousel.css">
        <link rel="stylesheet" href="{{asset('member')}}/vendor/owl-carousel/owl.theme.css">
        <!-- dropify -->
        <link rel="stylesheet" href="{{asset('backend')}}/dist/plugins/dropify/dropify.min.css">
        <link rel="stylesheet" type="text/css" href="{{asset('member')}}/rating_stars/rating/css/star-rating.css">
        <style type="text/css">
            .rating-header {
                margin-top: -10px;
                margin-bottom: 10px;
            }
        </style>

    </head>
    <body id="page-top">
        @include('member.layouts.navbar')
        <div id="wrapper">
            @include('member.layouts.sidebar')
                @yield('content')
            <!-- /.content-wrapper -->
        </div>
        <!-- /#wrapper -->
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
        </a>
        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin Logout?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih <b>logout</b> jika anda ingin keluar</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="/logout">Logout</a>
                </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="betaTest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h6>Admin</h6>
                </div>
                <div class="modal-body">
                    <b>Selamat datang di G-Academy.net, dalam tahap beta kali ini aplikasi masih dalam mode pengembangan oleh developer. Harap lapor jika menemukan bug atau error, agar kami bisa memberikan layanan yang baik dan berkualitas</b>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Mengerti</button>
                </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JavaScript-->
        <script src="{{asset('member')}}/vendor/jquery/jquery.min.js"></script>
        <script src="{{asset('member')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="{{asset('member')}}/vendor/bootstrap/js/bootstrap.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="{{asset('member')}}/vendor/jquery-easing/jquery.easing.min.js"></script>
        <!-- Owl Carousel -->
        <script src="{{asset('member')}}/vendor/owl-carousel/owl.carousel.js"></script>
        <!-- Custom scripts for all pages-->
        <script src="{{asset('member')}}/js/custom.js"></script>


        <script type="text/javascript">
            $(document).ready(function(){
                $('#startClass').modal('show');
                $('#alertPay').modal('show');
                });
        </script>

        {{-- <script type="text/javascript" src="{{asset('member')}}/ratining_stars/js/star-rating.js"></script> --}}
        {{-- <script type="text/javascript" src="{{asset('member')}}/ratining_stars/js/bootstrap.js"></script> --}}


        <!-- dropify -->
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
