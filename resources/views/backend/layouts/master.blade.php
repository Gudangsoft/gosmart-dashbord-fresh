<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }} | Dashboard</title>
    <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1" />

    <link rel="stylesheet" href="{{ asset('backend') }}/dist/bootstrap/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('backend') }}/dist/css/style.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/dist/css/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/dist/css/et-line-font/et-line-font.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/dist/css/themify-icons/themify-icons.css">
    <link type="text/css" rel="stylesheet"
        href="{{ asset('backend') }}/dist/plugins/cubeportfolio/css/cubeportfolio.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/dist/plugins/datatables/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/dist/plugins/dropify/dropify.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/dist/plugins/chartist-js/chartist.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/dist/plugins/chartist-js/chartist-init.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/dist/plugins/chartist-js/chartist-plugin-tooltip.css">

    <link type="text/css" rel="stylesheet" href="{{ asset('backend') }}/dist/plugins/jsgrid/jsgrid.css" />
    <link type="text/css" rel="stylesheet" href="{{ asset('backend') }}/dist/plugins/jsgrid/theme.css" />

    <link rel="stylesheet" href="{{ asset('backend') }}/dist/plugins/iCheck/flat/blue.css">

    <style>
        .selectBox {
            position: relative;
        }

        .selectBox select {
            width: 100%;
            /* font-weight: bold; */
        }

        .overSelect {
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
        }

        #checkBoxes {
            display: none;
            padding: 4px;
            border-radius: 3px;
            border: 1px #cccccc solid;
        }

        #checkBoxes label {
            display: block;
        }

        #checkBoxes label:hover {
            background-color: #f1f1f1;
        }
    </style>

</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper boxed-wrapper">
        @include('backend.layouts.header')
        @include('backend.layouts.sidebar')

        <div class="content-wrapper">
            @yield('content')
        </div>
        @include('backend.layouts.footer')
    </div>

    @livewireScripts
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- jQuery 3 -->
    <script src="{{ asset('backend') }}/dist/js/jquery.min.js"></script>

    <!-- v4.0.0-alpha.6 -->
    <script src="{{ asset('backend') }}/dist/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ asset('backend/dist/plugins/tinymce/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: 'textarea#classic',
            plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
            imagetools_cors_hosts: ['picsum.photos'],
            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
            toolbar_sticky: true,
            autosave_ask_before_unload: true,
            autosave_interval: '30s',
            autosave_prefix: '{path}{query}-{id}-',
            autosave_restore_when_empty: false,
            autosave_retention: '2m',
            image_advtab: true,
            link_list: [{
                    title: 'My page 1',
                    value: 'http://www.tinymce.com'
                },
                {
                    title: 'My page 2',
                    value: 'http://www.moxiecode.com'
                }
            ],
            image_list: [{
                    title: 'My page 1',
                    value: 'http://www.tinymce.com'
                },
                {
                    title: 'My page 2',
                    value: 'http://www.moxiecode.com'
                }
            ],
            image_class_list: [{
                    title: 'None',
                    value: ''
                },
                {
                    title: 'Some class',
                    value: 'class-name'
                }
            ],
            importcss_append: true,
            file_picker_callback: function(callback, value, meta) {
                /* Provide file and text for the link dialog */
                if (meta.filetype === 'file') {
                    callback('https://www.google.com/logos/google.jpg', {
                        text: 'My text'
                    });
                }

                /* Provide image and alt text for the image dialog */
                if (meta.filetype === 'image') {
                    callback('https://www.google.com/logos/google.jpg', {
                        alt: 'My alt text'
                    });
                }

                /* Provide alternative source and posted for the media dialog */
                if (meta.filetype === 'media') {
                    callback('movie.mp4', {
                        source2: 'alt.ogg',
                        poster: 'https://www.google.com/logos/google.jpg'
                    });
                }
            },
            templates: [{
                    title: 'New Table',
                    description: 'creates a new table',
                    content: '<div class="mceTmpl"><table width="98%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>'
                },
                {
                    title: 'Starting my story',
                    description: 'A cure for writers block',
                    content: 'Once upon a time...'
                },
                {
                    title: 'New list with dates',
                    description: 'New List with dates',
                    content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>'
                }
            ],
            template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
            template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
            height: 400,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_noneditable_class: 'mceNonEditable',
            toolbar_mode: 'sliding',
            contextmenu: 'link image imagetools table',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });
    </script>
    {{-- <script>
        CKEDITOR.editorConfig = function(config) {
            config.versionCheck = false;
        };
        CKEDITOR.replace('description');
        CKEDITOR.replace('content');
        CKEDITOR.replace('keterangan', {
            height: '150px',
            toolbar: [
                ['Source', 'Cut', 'Copy', 'TextColor', 'BGColor', 'Bold', 'Italic', 'Underline', 'JustifyLeft',
                    'JustifyCenter', 'JustifyRight', 'JustifyBlock', 'Styles', 'Format', 'Font', 'FontSize'
                ]
            ]
        });
    </script> --}}


    <!-- template -->
    <script src="{{ asset('backend') }}/dist/js/niche.js"></script>

    <!-- Chartjs JavaScript -->
    {{-- <script src="{{asset('backend')}}/dist/plugins/chartjs/chart.min.js"></script>
<script src="{{asset('backend')}}/dist/plugins/chartjs/chart-int.js"></script> --}}

    <!-- load jquery -->
    {{-- <script src="{{asset('backend')}}/dist/plugins/cubeportfolio/jquery-latest.min.js"></script> --}}
    <!-- load cubeportfolio -->
    <script src="{{ asset('backend') }}/dist/plugins/cubeportfolio/jquery.cubeportfolio.min.js"></script>
    <!-- init cubeportfolio -->
    <script src="{{ asset('backend') }}/dist/plugins/cubeportfolio/main.js"></script>
    <!-- dropify -->
    <script src="{{ asset('backend') }}/dist/plugins/dropify/dropify.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    {{-- <script src="{{asset('backend')}}/dist/plugins/jquery-ui/jquery-ui.min.js"></script> --}}
    <script>
        $(document).ready(function() {
            // Basic
            $('.dropify').dropify();

            // Translated
            $('.dropify-fr').dropify({
                messages: {
                    default: 'Glissez-déposez un fichier ici ou cliquez',
                    replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                    remove: 'Supprimer',
                    error: 'Désolé, le fichier trop volumineux'
                }
            });

            // Used events
            var drEvent = $('#input-file-events').dropify();

            drEvent.on('dropify.beforeClear', function(event, element) {
                return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
            });

            drEvent.on('dropify.afterClear', function(event, element) {
                alert('File deleted');
            });

            drEvent.on('dropify.errors', function(event, element) {
                console.log('Has Errors');
            });

            var drDestroy = $('#input-file-to-destroy').dropify();
            drDestroy = drDestroy.data('dropify')
            $('#toggleDropify').on('click', function(e) {
                e.preventDefault();
                if (drDestroy.isDropified()) {
                    drDestroy.destroy();
                } else {
                    drDestroy.init();
                }
            })
        });
    </script>

    {{-- ADD NEW FORM DINAMIC --}}
    <script>
        $(document).ready(function() {
            $(document).on('click', '.btn-add', function(e) {
                e.preventDefault();

                var dynaForm = $('.dynamic-wrap form:first'),
                    currentEntry = $(this).parents('.entry:first'),
                    newEntry = $(currentEntry.clone()).appendTo(dynaForm);

                newEntry.find('input').val('');
                dynaForm.find('.entry:not(:last) .btn-add')
                    .removeClass('btn-add').addClass('btn-remove')
                    .removeClass('btn-success').addClass('btn-danger')
                    .html('<span class="fa fa-minus"></span>');
            }).on('click', '.btn-remove', function(e) {
                $(this).parents('.entry:first').remove();

                e.preventDefault();
                return false;
            });
        });
        // });
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.btn-add', function(e) {
                e.preventDefault();

                var dynaForm = $('#dynamic-wrap #dynamic_input_materi:first'),
                    currentEntry = $(this).parents('.entry:first'),
                    newEntry = $(currentEntry.clone()).appendTo(dynaForm);

                newEntry.find('input').val('');
                dynaForm.find('.entry:not(:last) .btn-add')
                    .removeClass('btn-add').addClass('btn-remove')
                    .removeClass('btn-success').addClass('btn-danger')
                    .html('<span class="fa fa-minus"></span>');
            }).on('click', '.btn-remove', function(e) {
                $(this).parents('.entry:first').remove();

                e.preventDefault();
                return false;
            });
        });
        // });
    </script>


    <!-- Chartist JavaScript -->
    {{-- <script src="{{asset('backend')}}/dist/plugins/chartist-js/chartist.min.js"></script>
<script src="{{asset('backend')}}/dist/plugins/chartist-js/chartist-plugin-tooltip.js"></script>
<script src="{{asset('backend')}}/dist/plugins/functions/chartist-init.js"></script> --}}
    <!-- DataTable -->
    <script src="{{ asset('backend') }}/dist/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('backend') }}/dist/plugins/datatables/dataTables.bootstrap.min.js"></script>
    {{-- Export Table --}}
    <script src="{{ asset('backend') }}/dist/plugins/table-expo/filesaver.min.js"></script>
    <script src="{{ asset('backend') }}/dist/plugins/table-expo/xls.core.min.js"></script>
    <script src="{{ asset('backend') }}/dist/plugins/table-expo/tableexport.js"></script>

    <script>
        $(function() {
            $('#example1').DataTable()
            $('#example2').DataTable({
                    'paging': true,
                    'lengthChange': true,
                    'searching': true,
                    // 'ordering': true,
                    'info': false,
                    'autoWidth': false,
                    'order': {
                        idx: 1,
                        dir: 'desc'
                    }
                }),
            $('#all-materi').DataTable({
                'paging': true,
                'lengthChange': true,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': false
            }),
            $('#history_class').DataTable({
                'paging': true,
                'lengthChange': true,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': false
            }),
            $('#premium-confirm').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': true,
                'ordering': true,
                'info': false,
                'autoWidth': false
            }),
            $('#channel').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': true,
                'ordering': true,
                'info': false,
                'autoWidth': false
            }),
            $('#event-registed-list').DataTable({
                'paging': true,
                'lengthChange': true,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': false
            })
        })
    </script>
    <script>
        $("#example2").tableExport({
            formats: ["xlsx", "xls", "csv", "txt"],
        });
        $("#premium-confirm").tableExport({
            formats: ["xlsx", "xls", "csv", "txt"],
        });
    </script>

    <!-- jsgrid Tables -->
    <script src="{{ asset('backend') }}/dist/plugins/jsgrid/db.js"></script>
    <script src="{{ asset('backend') }}/dist/plugins/jsgrid/jsgrid.min.js"></script>
    <script src="{{ asset('backend') }}/dist/plugins/jsgrid/jsgrid.int.js"></script>
    <script src="{{ asset('backend') }}/dist/plugins/iCheck/icheck.min.js"></script>

    <!-- Page Script -->
    <script>
        $(function() {
            //Enable iCheck plugin for checkboxes
            //iCheck for checkbox and radio inputs
            $('.mailbox-messages input[type="checkbox"]').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });

            //Enable check and uncheck all functionality
            $(".checkbox-toggle").click(function() {
                var clicks = $(this).data('clicks');
                if (clicks) {
                    //Uncheck all checkboxes
                    $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
                    $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
                } else {
                    //Check all checkboxes
                    $(".mailbox-messages input[type='checkbox']").iCheck("check");
                    $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
                }
                $(this).data("clicks", !clicks);
            });

            //Handle starring for glyphicon and font awesome
            $(".mailbox-star").click(function(e) {
                e.preventDefault();
                //detect type
                var $this = $(this).find("a > i");
                var glyph = $this.hasClass("glyphicon");
                var fa = $this.hasClass("fa");

                //Switch states
                if (glyph) {
                    $this.toggleClass("glyphicon-star");
                    $this.toggleClass("glyphicon-star-empty");
                }

                if (fa) {
                    $this.toggleClass("fa-star");
                    $this.toggleClass("fa-star-o");
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#withdraw").on('keyup', function() {
                var saldo = parseFloat($("input[name='saldo']").val(), 10);
                var withdraw = parseFloat($("input[name='withdraw']").val(), 10);
                if (withdraw > saldo || withdraw == 0)
                    $("#CheckLimit").html("Saldo tidak cukup").css("color", "red");
                else if (withdraw < 100000)
                    $("#CheckLimit").html("Nominal tidak memenuhi syarat").css("color", "red");
                else
                    $("#CheckLimit").html(" ").css("color", "green");
                $('#btnWithdraw').prop('disabled', false);
            });
        });
    </script>
    @yield('page-script')
    @stack('script')
</body>

</html>
