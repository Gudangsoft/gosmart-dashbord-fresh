<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{asset('landing/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('landing/css/plugins/animate.css')}}">
        <link
            href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900"
            rel="stylesheet">
        <link
            href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
            rel="stylesheet">
        <link rel="stylesheet" href="{{asset('landing/css/plugins/slick.css')}}">
        <link rel="stylesheet" href="{{asset('landing/css/plugins/slick-theme.css')}}">
        <link rel="stylesheet" href="{{asset('landing/css/plugins/magnific-popup.css')}}">
        <link rel="stylesheet" href="{{asset('landing/css/main.css')}}">
        <script src="https://kit.fontawesome.com/30ef116601.js" crossorigin="anonymous"></script>

<title>G-Academy</title>
    </head>
    <body style="background-color:#fbfffe;">
    
        <!-- Page Loading -->
        <div class="se-pre-con"></div>
        <!-- ======== Start Navbar ======== -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dar fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#"><img src="img/logo.png" style="width:130px; height:35px;" alt=""></a>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbarNavDropdown"
                    aria-controls="navbarNavDropdown"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#slider">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#features">Mitra</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#our-team">Mentor</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">Jadi Mentor</a>
                        </li>

                    </ul>
                    <a href="{{route('login')}}" class="btn-1">Login</a>
                </div>
            </div>
        </nav>
        <!-- ======== End Navbar ======== -->

        <!-- ======== Start Slider ======== -->
        <section class="slider d-flex align-items-center" id="slider">
            <div class="container text-white">
                <div class="content">
                    <div class="row d-flex align-items-center">
                        <div class="col-lg-5">
                            <h1>Gabung Segera</h1>
                            <p>Belajar bersama g-academy
                            sangat menyenangkan, dengan mentor yang ahli dibidangnya.</p>
                            <a href="{{route('register')}}" class="btn-g">Registrasi</a>
                        </div>
                        <div class="col-lg-7">
                            <!-- <img src="https://mister.id/wp-content/uploads/2020/07/free.png" alt="" class="img-fluid"> -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ======== End Slider ======== -->

        <!-- ======== Start Join ======== -->
        <section class="join">
            <div class="container">
                <div class="content">
                    <div class="row mb-4"> 
                        <p class="h5 mb-lg-5 gray-text"><span class="d-none d-lg-inline mr-lg-3"><i class="fas fa-chevron-right"></i></span>Kenapa memilih jasa kami ?</p>
                    </div>
                    <div class="row">
                        <!-- Service -->
                        <div class="col-md-4">
                            <div class="box left-box text-lg-center">
                                <span class="mb-lg-2 d-lg-block"><i class="fas fa-chalkboard-teacher fa-3x text-info"></i></span>
                                <h3>MICROLEARNING</h3>
                                <p>Konten belajar dengan segmen kecil (bite sized), fokus, cepat dan menyesuaikan kebutuhan user.</p>
                            </div>
                        </div>
                        <!-- Service -->
                        <div class="col-md-4">
                            <div class="box left-box text-lg-center">
                                <span class="mb-lg-2 d-lg-block"><i class="fas fa-laptop-code fa-3x text-info"></i></span>
                                <h3>ONLINE</h3>
                                <p>Kegiatan Pembelajaran dilakukan secara Online, dan Materi dapat diakses Setiap saat.</p>
                            </div>
                        </div>
                        <!-- Service -->
                        <div class="col-md-4">
                            <div class="box text-lg-center">
                                <span class="mb-lg-2 d-lg-block"><i class="fas fa-thumbs-up fa-3x text-info"></i></span>
                                <h3>TERSTRUKTUR</h3>
                                <p>Memastikan peserta dapat memahami materi dengan mudah dan tuntas.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ======== End Join ======== -->


        <!-- ======= Materi =========== -->
        <section class="join">

        <div class="container-fluid gray-back py-5">

            <!-- ===== Content Materi ====== -->

            <div class="px-lg-4 py-1">

                <div class="container-sm d-lg-flex align-content-center">

                    <!-- Programming -->

                    <div class="p-3 bg-white mx-1 flex-grow-1">
                        <div class="container">
                            <div class="row mb-2">
                            <p class="h4 gray-text"><span class="mr-2"><i class="fas fa-code"></i></span>Programming</p>
                            </div>
                            <div class="row">
                            <div class="col-6 col-lg text-center">
                                    <img class="img-thumbnail border-0" src="{{asset('landing/img/teknologi/php_icon.png')}}" alt="">
                                    <p class="gray-text">PHP</p>
                                </div>
                                <div class="col-6 col-lg text-center">
                                    <img class="img-thumbnail border-0" src="{{asset('landing/img/teknologi/javascript_icon.png')}}" alt="">
                                    <p class="gray-text">Javascript</p>
                                </div>
                                <div class="col-6 col-lg text-center">
                                    <img class="img-thumbnail border-0" src="{{asset('landing/img/teknologi/python_icon.png')}}" alt="">
                                    <p class="gray-text">Python</p>
                                </div>
                                <div class="col-6 col-lg text-center">
                                    <img class="img-thumbnail border-0" src="{{asset('landing/img/teknologi/vb_icon.png')}}" alt="">
                                    <p class="gray-text">VB NET</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Programming -->

                    <div class="p-3 bg-white mx-1 flex-grow-1">
                        <div class="container">
                            <div class="row mb-2">
                            <p class="h4 gray-text"><span class="mr-2"><i class="fas fa-mobile-alt"></i></span>Mobile Programming</p>
                            </div>
                            <div class="row">
                            <div class="col-6 col-lg text-center">
                                    <img class="img-thumbnail border-0" src="{{asset('landing/img/teknologi/java_icon.png')}}" alt="">
                                    <p class="gray-text">JAVA</p>
                                </div>
                                <div class="col-6 col-lg text-center">
                                    <img class="img-thumbnail border-0" src="{{asset('landing/img/teknologi/react_icon.png')}}" alt="">
                                    <p class="gray-text">React</p>
                                </div>
                                <div class="col-6 col-lg text-center">
                                    <img class="img-thumbnail border-0" src="{{asset('landing/img/teknologi/kotlin_icon.png')}}" alt="">
                                    <p class="gray-text">Kotlin</p>
                                </div>
                                <div class="col-6 col-lg text-center">
                                    <img class="img-thumbnail border-0" src="{{asset('landing/img/teknologi/swift_icon.png')}}" alt="">
                                    <p class="gray-text">Swift</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <!-- ===== Separator Materi ====== -->

            <div class="px-lg-4 py-1">

                <div class="container-sm d-lg-flex align-content-center">

                    <!-- Graphic Design & Animation -->

                    <div class="p-3 bg-white mx-1 flex-grow-1">
                        <div class="container">
                            <div class="row mb-2">
                            <p class="h4 gray-text"><span class="mr-2"><i class="fas fa-photo-video"></i></span>Desain Grafis & Animasi</p>
                            </div>
                            <div class="row">
                            <div class="col-6 col-lg text-center">
                                    <img class="img-thumbnail border-0" src="{{asset('landing/img/teknologi/corel_icon.png')}}" alt="">
                                    <p class="gray-text">Corel Draw</p>
                                </div>
                                <div class="col-6 col-lg text-center">
                                    <img class="img-thumbnail border-0" src="{{asset('landing/img/teknologi/photoshop_icon.png')}}" alt="">
                                    <p class="gray-text">Photoshop</p>
                                </div>
                                <div class="col-6 col-lg text-center">
                                    <img class="img-thumbnail border-0" src="{{asset('landing/img/teknologi/animate_icon.png')}}" alt="">
                                    <p class="gray-text">Animate</p>
                                </div>
                                <div class="col-6 col-lg text-center">
                                    <img class="img-thumbnail border-0" src="{{asset('landing/img/teknologi/after_effect_icon.png')}}" alt="">
                                    <p class="gray-text">After Effect</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- OFFICE -->

                    <div class="p-3 bg-white mx-1 flex-grow-1">
                        <div class="container">
                            <div class="row mb-2">
                            <p class="h4 gray-text"><span class="mr-2"><i class="fab fa-microsoft"></i></span>Office</p>
                            </div>
                            <div class="row">
                            <div class="col-6 col-lg text-center">
                                    <img class="img-thumbnail border-0" src="{{asset('landing/img/teknologi/word_icon.png')}}" alt="">
                                    <p class="gray-text">Word</p>
                                </div>
                                <div class="col-6 col-lg text-center">
                                    <img class="img-thumbnail border-0" src="{{asset('landing/img/teknologi/excel_icon.png')}}" alt="">
                                    <p class="gray-text">Excel</p>
                                </div>
                                <div class="col-6 col-lg text-center">
                                    <img class="img-thumbnail border-0" src="{{asset('landing/img/teknologi/ms_access_icon.png')}}" alt="">
                                    <p class="gray-text">Access</p>
                                </div>
                                <div class="col-6 col-lg text-center">
                                    <img class="img-thumbnail border-0" src="{{asset('landing/img/teknologi/powerpoint_icon.png')}}" alt="">
                                    <p class="gray-text">Powerpoint</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>    

            <!-- ===== End Content Materi ====== -->
            
        </div>

        <!--- ======== Sepcial Materi ======== --->

        <div class="container mt-4">

        <div class="row">
            <p class="h5 gray-text fw-bold ml-lg-2 mb-3">Materi Spesial</p>
        </div>

            <div class="row">
               
               <div class="col-lg-6">
                    <div class="my-3">
                        <p class="h4 gray-text"><span class="mr-2"><i class="fas fa-server"></i></span>Data Mining</p>
                    </div>

                    <div class="d-lg-flex text-center ">
                        <span class="text-center mx-2">
                            <p class="rounded-circle bg-dark d-inline-block px-2 py-2"><i class="fas fa-chart-line fa-2x fa-fw text-light"></i></p>
                            <p class="gray-text">Market Analysis</p>
                        </span>

                        <span class="text-center mx-2">
                            <p class="rounded-circle bg-dark d-inline-block px-2 py-2"><i class="fas fa-user-secret fa-2x fa-fw text-light"></i></p>
                            <p class="gray-text">Fraud Detection</p>
                        </span>

                        <span class="text-center mx-2">
                            <p class="rounded-circle bg-dark d-inline-block px-2 py-2"><i class="fas fa-people-carry fa-2x fa-fw text-light"></i></p>
                            <p class="gray-text">Customer Retention</p>
                        </span>

                        <span class="text-center mx-2">
                            <p class="rounded-circle bg-dark d-inline-block px-2 py-2"><i class="fas fa-industry fa-2x fa-fw text-light"></i></p>
                            <p class="gray-text">Production Control</p>
                        </span>

                    </div>
               
               </div>

                <div class="col-lg-6">
                    <div class="my-3">
                        <p class="h4 gray-text"><span class="mr-2"><i class="fas fa-robot"></i></span>Microcontroller</p>
                    </div>

                    <div class="d-lg-flex text-center ">
                        <span class="text-center mx-2">
                            <img src="{{asset('landing/img/teknologi/arduino_icon.png')}}">
                            <p class="gray-text">Arduino</p>
                        </span>

                        <span class="text-center mx-2">
                            <img src="{{asset('landing/img/teknologi/avr_icon.png')}}">
                            <p class="gray-text">AVR</p>
                        </span>

                        <span class="text-center mx-2">
                            <img src="{{asset('landing/img/teknologi/wemos_icon.png')}}">
                            <p class="gray-text">wemos</p>
                        </span>

                        <span class="text-center mx-2">
                            <img src="{{asset('landing/img/teknologi/atmel_avr_icon.png')}}">
                            <p class="gray-text">Atmel AVR</p>
                        </span>

                        <span class="text-center mx-2">
                            <img src="{{asset('landing/img/teknologi/raspiberry_icon.png')}}">
                            <p class="gray-text">Raspberry Pi</p>
                        </span>

                    </div>
               
               </div>

    
            </div>    
        </div>

        <!--- ======== End Sepcial Materi ======== --->

        </section>

        <!-- ======= End Materi =========== -->

        <!-- ======== Start Features ======== -->
        <section class="features" id="features">
            <div class="container text-center">
                <div class="heading">
                    <h2>Mitra handal bersama kami</h2>
                </div>
                <!-- Boxes-->
                <div class="slick-slider">
                    <!-- Box Mitra -1 -->
                    <div class="box">
                        <img src="img/mitra/rumah-diklat.jpg"  height="190" width="190" class="m-auto">
                        <h3>Rumah Diktat</h3>
                        
                    </div>
                    <!-- Box Mitra-2 -->
                    <div class="box">
                        <img src="img/mitra/ppmultindo.png" alt=""  height="190" width="190"  class="m-auto">
                        <h3>PPMULTINDO</h3>
                        
                    </div>
                    
                    <!-- Box Mitra-3 -->
                    <div class="box">
                        <img src="https://play-lh.googleusercontent.com/b-EhYHVMZc0JhNHuijdkMADFpGGU_P2nG90tj5YBeL7HN2nttw3k8ovBcZAvFWYHINH1" alt=""  height="190" width="190"  class="m-auto">
                        <h3>IMNU Academy</h3>
                       
                    </div>
                    <!-- Box Mitra-4 -->
                    <div class="box">
                        <img src="img/mitra/trainit.png" alt=""  height="190" width="190"  class="m-auto">
                        <h3>TRAINIT</h3>
                       
                    </div>
                    <!-- Box Mitra-5 -->
                    <div class="box">
                        <img src="img/pakarpedia.png" height="190" width="190"  class="m-auto">
                        <h3>PAKARPEDIA</h3>
                    </div>
                    <!-- Box Mitra-6 -->
                    <div class="box">
                        <img src="img/ciuss.png" height="190" width="190"  class="m-auto">
                        <h3>CIUSS</h3>
                    </div>
                    <!-- Box Mitra-7 -->
                    <div class="box">
                        <img src="img/mitra/omahkemas.jpg" height="190" width="190"  class="m-auto">
                        <h3>OMAHKemas</h3>
                    </div>
                    <!-- Box Mitra-8 -->
                    <div class="box">
                        <img src="img/mitra/blkazzahro.png" height="190" width="190"  class="m-auto">
                        <h3>BLK-AZZAHRO</h3>
                    </div>

                    <!-- Box Mitra-8 -->
                    <div class="box">
                        <img src="img/mitra/talentanusantara.png" height="190" width="190"  class="m-auto">
                        <h3>TALENTA NUSANTARA</h3>
                    </div>
                </div>
            </div>
        </section>
        <!-- ======== End Features ======== -->

        <!-- ======== Start Get Started ======== -->
        <!-- <section class="get-started">
            <div class="container text-center text-white">
                <h2>GET STARTED</h2>
                <p>7 -day free trial. No credit card required</p>
                <a href="https://g-academy.net/register" class="btn-1">Get Started</a>
            </div>
        </section> -->
        <!-- ======== End Get Started ======== -->

        <!-- ======== Start web developer ======== -->
        <section class="customer">
            <div class="container">
                <div class="row d-flex align-items-center">
                    <div class="col-md-6">
                        <div class="left">
                            <img src="{{asset('landing/img/teknologi/web.jpg')}}" alt="" class="img-fluid" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="right">
                            <h5 class="mt-0">Pengembang Web Moderen</h5>
                            <p class="p-1">Solusi tepat kursus Web Programming dengan materi dasar dan praktek langsung serta pengetahuan tentang teknologi terbaru membuat website rancanganmu uptodate.</p>
                            <div class="d-lg-flex">
                                <img class="img-thumbnail img-fluid mr-1" src="{{asset('landing/img/teknologi/bootstrap_icon.png')}}" alt="">
                                <img class="img-thumbnail img-fluid mr-1" src="{{asset('landing/img/teknologi/vue_icon.png')}}" alt="">
                                <img class="img-thumbnail img-fluid mr-1" src="{{asset('landing/img/teknologi/codeigniter_icon.png')}}" alt="">
                                <img class="img-thumbnail img-fluid mr-1" src="{{asset('landing/img/teknologi/laravel_icon.png')}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ======== End web developer ======== -->

        <!-- ======== Start android ======== -->
        <section class="worked">
            <div class="container">
                <div class="row align-items-center">
                    <!-- left -->
                    <div class="col-lg-7">
                        <div class="box gray-text">
                            <h2>Pengembang Aplikasi Android</h2>
                            <p>Solusi tepat kursus Android Programming dengan praktek membuat apps android sesuai perancangan siswa dengan materi sebagai berikut:</p>
                            <p><H5>Materi Perancangan</H5>Tentor berdiskusi dengan siswa agar untuk bersama-sama membuat perancangan sesuai studi kasus siswa. tujuan diskusi ini adalah agar perancangan benar-benar sesuai dengan keinginan siswa. Perancangan juga dapat diubah sewaktu-waktu selama masih dalam aplikasi yang sama.</p>
                            
                            <p><H5>Materi Database</H5>Tentor memberikan materi database sesuai dengan perancangan, database yang digunakan adalah MySQL yang familiar. Mulai dari membuat tabel-tabel database serta relasinya.</p>
                            
                            <p><H5>Materi Layout</H5> Materi layout diberikan dengan praktek membuat layout apps android sesuai perancangan siswa. software yang digunakan adalah android studio.</p>
                           
                            <p><H5>Materi API & Programming Android</H5> API adalah data yang diambil dari database MySQL ditampilkan pada apps android yang dibuat. atau sebaliknya, data yang diinputkan pada apps android akan tersimpan di MySQL. semua fitur yang diminta siswa akan dibuat pada materi ini.</p>
                           
                        </div>
                    </div>
                    <!-- Right -->
                    <div class="col-lg-5">
                        <img src="{{asset('landing/img/teknologi/andro.jpg')}}" alt="android" class="img-fluid">
                    </div>
                </div>
            </div>
        </section>
        <!-- ======== End android ======== -->

        <!-- ======== Start Algoritma ======== -->
        <section class="download">
            <div class="container">
                <div class="row d-flex justify-content-center align-items-center icon">
                    <div class="col-md-9 d-lg-flex align-items-center">
                    <span class="px-4">
                        <h1><i class="fas fa-award fa-2x"></i></h1>
                    </span>
                    <span>
                        <h2>Pahami Algoritma yang sering digunakan dalam beberapa Sistem Pengambil Keputusan, Sistem Pakar & Data Mining.</h2>
                    </span>
                    </div>
                    <div class="col-md-3">
                        <a href="https://g-academy.net/register" class="btn-1">Gabung</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- ======== End Algoritma ======== -->


        <!-- ======== Animastion =========== -->

        <section class="animation border">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 d-flex align-content-center flex-wrap">
                        <h2>Desainer Grafis Kreatif</h2>
                        <p class="gray-text pr-lg-5 mr-lg-5">Salurkan bakat kreatif kamu dengan bentuk digital. Mentor kami siap membantu anda dengan pengalaman dibidang digital kreatif.</p>
                    </div>
                    <div class="col-lg-6">
                        <img src="{{asset('landing/img/teknologi/animasi_part.jpg')}}" alt="Kursus Animasi" class="img-fluid">
                    </div>
                </div>
            </div>
        </section>

        <!-- ======== End Animastion =========== -->

        <!-- ======== End microcontroller =========== -->

        <section class="microcontroller my-3 bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 p-lg-0">
                        <img class="img-fluid" src="{{asset('landing/img/teknologi/android_studio.png')}}" alt="Android Studio">
                    </div>
                    <div class="col-lg-8 p-lg-0 d-flex flex-wrap align-content-center">
                        <h2>Microcontroller untuk IoT</h2>
                        <p class="gray-text">Belajar microcontroller dengan beberapa studi kasus yang telah dilakukan oleh mentor, sehingga pengetahuan anda seputar microcontroller akan bertambah. Mulai dari pemanfaatan untuk sehari-hari maupun untuk skala industri.</p>
                    </div>
                </div>
            </div>
        
        </section>
        <!-- ======== End microcontroller =========== -->

        <!-- ======== Start Mentor ======== -->
        <section class="our-team" id="our-team">
            <div class="container text-center">
                <div class="heading">
                    <h2>Mentor Berpengalaman</h2>
                    <p>Mentor-mentor yang kompeten dan ahli dibidangnya siap mendampingi anda.</p>
                </div>
                <div class="slick-slider">
                    <!-- Box-1 -->
                    <div class="box">
                        <img  src="{{asset('landing/img/mentor/edi.jpg')}}" alt="mentor_edi" class="m-auto" width="190" height="190">
                        <h3>Edy Siswanto, MM,M.Kom</h3>
                        <span>Ms. Office Mentor</span>
                        <div class="gray-line m-auto"></div>
                        <div class="social d-flex justify-content-center align-items-cente">
                            <a href="#0" class="d-flex justify-content-center align-items-center icon">
                                <i class="fa fa-facebook" aria-hidden="true"></i>
                            </a>
                            <a href="#0" class="d-flex justify-content-center align-items-center icon">
                                <i class="fa fa-twitter" aria-hidden="true"></i>
                            </a>
                            <a href="#0" class="d-flex justify-content-center align-items-center icon">
                                <i class="fa fa-github" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                    <!-- Box-2 -->
                    <div class="box">
                        <img src="{{asset('landing/img/mentor/sholikhan.jpg')}}" alt="mentor_sholikhan"  class="m-auto"width="190" height="190">
                        <h3>Muhammad Sholikhan,M.Kom </h3>
                        <span>design graphic Mentor</span>
                        <div class="gray-line m-auto"></div>
                        <div class="social d-flex justify-content-center align-items-cente">
                            <a href="#0" class="d-flex justify-content-center align-items-center icon">
                                <i class="fa fa-facebook" aria-hidden="true"></i>
                            </a>
                            <a href="#0" class="d-flex justify-content-center align-items-center icon">
                                <i class="fa fa-twitter" aria-hidden="true"></i>
                            </a>
                            <a href="#0" class="d-flex justify-content-center align-items-center icon">
                                <i class="fa fa-github" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                    <!-- Box-3 -->
                    <div class="box">
                        <img src="{{asset('landing/img/mentor/nur.jpg')}}" alt="mentor_nur"  heiht="190" width="190" class="m-auto">
                        <h3>Nur Rokhman,M.Kom </h3>
                        <span>Design graphic Mentor</span>
                        <div class="gray-line m-auto"></div>
                        <div class="social d-flex justify-content-center align-items-cente">
                            <a href="#0" class="d-flex justify-content-center align-items-center icon">
                                <i class="fa fa-facebook" aria-hidden="true"></i>
                            </a>
                            <a href="#0" class="d-flex justify-content-center align-items-center icon">
                                <i class="fa fa-twitter" aria-hidden="true"></i>
                            </a>
                            <a href="#0" class="d-flex justify-content-center align-items-center icon">
                                <i class="fa fa-github" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                    <!-- Box-1 -->
                    <div class="box">
                        <img src="{{asset('landing/img/mentor/abidin.jpg')}}" alt="mentor_abidin" heiht="190" width="190" class="m-auto">
                        <h3>Rohmad Abidin,M.Kom </h3>
                        <span>Mobile Application Mentor</span>
                        <div class="gray-line m-auto"></div>
                        <div class="social d-flex justify-content-center align-items-center">
                            <a href="#0" class="d-flex justify-content-center align-items-center icon">
                                <i class="fa fa-facebook" aria-hidden="true"></i>
                            </a>
                            <a href="#0" class="d-flex justify-content-center align-items-center icon">
                                <i class="fa fa-twitter" aria-hidden="true"></i>
                            </a>
                            <a href="#0" class="d-flex justify-content-center align-items-center icon">
                                <i class="fa fa-github" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                    <!-- Box-2 -->
                    <div class="box">
                        <img src="{{asset('landing/img/mentor/bagus.jpg')}}" alt="mentor_bagus"  height="190" width="190" class="m-auto">
                        <h3>Bagus Sudirman,M.Kom</h3>
                        <span>Desktop Appilcation Mentor</span>
                        <div class="gray-line m-auto"></div>
                        <div class="social d-flex justify-content-center align-items-center">
                            <a href="#0" class="d-flex justify-content-center align-items-center icon">
                                <i class="fa fa-facebook" aria-hidden="true"></i>
                            </a>
                            <a href="#0" class="d-flex justify-content-center align-items-center icon">
                                <i class="fa fa-twitter" aria-hidden="true"></i>
                            </a>
                            <a href="#0" class="d-flex justify-content-center align-items-center icon">
                                <i class="fa fa-github" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                    <!-- Box-3 -->
                    <div class="box">
                        <img src="{{asset('landing/img/mentor/zaenal.jpg')}}" alt="mentor_zaenal" height="190" width="190" class="m-auto">
                        <h3>Zaenal Mustofa,M.Kom</h3>
                        <span>Analize Desaian and Data Mining Mentor</span>
                        <div class="gray-line m-auto"></div>
                        <div class="social d-flex justify-content-center align-items-cente">
                            <a href="#0" class="d-flex justify-content-center align-items-center icon">
                                <i class="fa fa-facebook" aria-hidden="true"></i>
                            </a>
                            <a href="#0" class="d-flex justify-content-center align-items-center icon">
                                <i class="fa fa-twitter" aria-hidden="true"></i>
                            </a>
                            <a href="#0" class="d-flex justify-content-center align-items-center icon">
                                <i class="fa fa-github" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                <!-- Box-4 -->
                    <div class="box">
                        <img src="{{asset('landing/img/mentor/lawrence.jpg')}}" alt="mentor_lawrence" height="190" width="190" class="m-auto">
                        <h3>Lawrence Adi, S.Kom</h3>
                        <span>Microcontroller Mentor</span>
                        <div class="gray-line m-auto"></div>
                        <div class="social d-flex justify-content-center align-items-center">
                            <a href="#0" class="d-flex justify-content-center align-items-center icon">
                                <i class="fa fa-facebook" aria-hidden="true"></i>
                            </a>
                            <a href="#0" class="d-flex justify-content-center align-items-center icon">
                                <i class="fa fa-twitter" aria-hidden="true"></i>
                            </a>
                            <a href="#0" class="d-flex justify-content-center align-items-center icon">
                                <i class="fa fa-github" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
            </div>
        </section>
        <!-- ======== End Mentor ======== -->

        <!-- ======== Start Webinar ======== -->
        <section class="video">
            <div class="container">
                <div class="row">
                <div class="col">
                    <div class="slick-slider">
                            <div class="box">
                                <img src="{{asset('landing/img/webinar/workshop-1.jpg')}}" alt="" class="img-fluid">
                            </div>
                            <div class="box">
                                <img src="{{asset('landing/img/webinar/workshop-2.jpg')}}" alt="" class="img-fluid">
                            </div>
                            <div class="box">
                                <img src="{{asset('landing/img/webinar/workshop-3.jpg')}}" alt="" class="img-fluid">
                            </div>
                            <div class="box">
                                <img src="{{asset('landing/img/webinar/workshop-4.jpg')}}" alt="" class="img-fluid">
                            </div>
                            <div class="box">
                                <img src="{{asset('landing/img/webinar/workshop-5.jpg')}}" alt="" class="img-fluid">
                            </div>
                    </div>
                </div>
                </div>
                <div class="row">
                    <!-- Right -->
                    <div class="col pt-3">
                        <div class="right">
                            <h2>Kolaborasi bersama Tenaga Ahli Kami</h2>
                            <p>Kami menyediakan kolaborasi bersama tenaga ahli kami untuk seminar/pelatihan maupun webinar bersama anda. Sebagai tenaga ahli kami memiliki bebarapa kualifikasi yang bisa dipertanggung jawabkan didalam setiap materi yang disampaikan.</p>
                            <a href="http://wa.me/+6285640236283" target="_blank" class="btn-1">Hubungi Kami</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ======== End Webinar ======== -->
        <!-- ======== join mentor ======== -->
        

<section id="contact">
   <div class="container">
        <div class="row contact">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="heading font-weight-bold">Kami yakin anda yang terbaik</h2>
                <p class="gray-text">Mentoring memiliki tantangan yang sangat menarik dan penuh dengan ide-ide yang harus ditemukan dalam setiap kegiatan belajar. Hal ini dikarenakan kita akan bertemu dengan bermacam-macam tipe dan karakter siswa.</p>
              
            <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Kirim CV
</button>   
            </div>
            <div class="col-lg-6 d-flex justify-content-center align-items-center" style="background-color:#eff4f8;">
                <img src="{{asset('landing/img/teknologi/envelope.jpg')}}" alt="envelope" class="img-fluid">
            </div>
        </div>
   </div>
</section>  

<!--- MODAL JOIN MENTOR -->
<!-- Modal -->
<div class="modal fade p-0 p-lg-2" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body d-lg-flex justify-content-center p-0">
         <iframe
      id="JotFormIFrame-211721982555055"
      title="Form"
      onload="window.parent.scrollTo(0,0)"
      allowtransparency="true"
      allowfullscreen="true"
      allow="geolocation; microphone; camera"
      src="https://form.jotform.com/211721982555055"
      frameborder="0"
      style="
      min-width:100%;
      height:539px;
      border:none;"
      scrolling="no"
    >
    </iframe>
    <script type="text/javascript">
      var ifr = document.getElementById("JotFormIFrame-211721982555055");
      if (ifr) {
        var src = ifr.src;
        var iframeParams = [];
        if (window.location.href && window.location.href.indexOf("?") > -1) {
          iframeParams = iframeParams.concat(window.location.href.substr(window.location.href.indexOf("?") + 1).split('&'));
        }
        if (src && src.indexOf("?") > -1) {
          iframeParams = iframeParams.concat(src.substr(src.indexOf("?") + 1).split("&"));
          src = src.substr(0, src.indexOf("?"))
        }
        iframeParams.push("isIframeEmbed=1");
        ifr.src = src + "?" + iframeParams.join('&');
      }
      window.handleIFrameMessage = function(e) {
        if (typeof e.data === 'object') { return; }
        var args = e.data.split(":");
        if (args.length > 2) { iframe = document.getElementById("JotFormIFrame-" + args[(args.length - 1)]); } else { iframe = document.getElementById("JotFormIFrame"); }
        if (!iframe) { return; }
        switch (args[0]) {
          case "scrollIntoView":
            iframe.scrollIntoView();
            break;
          case "setHeight":
            iframe.style.height = args[1] + "px";
            break;
          case "collapseErrorPage":
            if (iframe.clientHeight > window.innerHeight) {
              iframe.style.height = window.innerHeight + "px";
            }
            break;
          case "reloadPage":
            window.location.reload();
            break;
          case "loadScript":
            if( !window.isPermitted(e.origin, ['jotform.com', 'jotform.pro']) ) { break; }
            var src = args[1];
            if (args.length > 3) {
                src = args[1] + ':' + args[2];
            }
            var script = document.createElement('script');
            script.src = src;
            script.type = 'text/javascript';
            document.body.appendChild(script);
            break;
          case "exitFullscreen":
            if      (window.document.exitFullscreen)        window.document.exitFullscreen();
            else if (window.document.mozCancelFullScreen)   window.document.mozCancelFullScreen();
            else if (window.document.mozCancelFullscreen)   window.document.mozCancelFullScreen();
            else if (window.document.webkitExitFullscreen)  window.document.webkitExitFullscreen();
            else if (window.document.msExitFullscreen)      window.document.msExitFullscreen();
            break;
        }
        var isJotForm = (e.origin.indexOf("jotform") > -1) ? true : false;
        if(isJotForm && "contentWindow" in iframe && "postMessage" in iframe.contentWindow) {
          var urls = {"docurl":encodeURIComponent(document.URL),"referrer":encodeURIComponent(document.referrer)};
          iframe.contentWindow.postMessage(JSON.stringify({"type":"urls","value":urls}), "*");
        }
      };
      window.isPermitted = function(originUrl, whitelisted_domains) {
        var url = document.createElement('a');
        url.href = originUrl;
        var hostname = url.hostname;
        var result = false;
        if( typeof hostname !== 'undefined' ) {
          whitelisted_domains.forEach(function(element) {
              if( hostname.slice((-1 * element.length - 1)) === '.'.concat(element) ||  hostname === element ) {
                  result = true;
              }
          });
          return result;
        }
      }
      if (window.addEventListener) {
        window.addEventListener("message", handleIFrameMessage, false);
      } else if (window.attachEvent) {
        window.attachEvent("onmessage", handleIFrameMessage);
      }
      </script>
      </div>
      </div>
      <div class="modal-footer bg-white position-relative px-2 py-4 rounded-top" style="margin:-73px -20px 0px;z-index:1;">
        <button type="button" class="btn btn-secondary bg-white border-0 " data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--- end MODAL JOIN MENTOR -->
        
        <!-- ======== End join mentor ======== -->

    <footer class="footer pb-1">
        <div class="container text-white">
            <div class="row">
                <div class="col-lg-4  mb-lg-0 mb-5">
                    <div>
                        <img src="{{asset('landing/img/logo.png')}}" class="img-fluid border-right pr-lg-3" alt="g-academy logo">
                        <img src="{{asset('landing/img/gudangsoft.png')}}" class="img-fluid pl-lg-2"  alt="gudangsoft logo">
                    </div>
                    <div>
                        <p class="mt-3">G-Academy adalah salah satu kegiatan usaha dari gudangsoft <sup>&reg;</sup> dibidang mentoring dan pendampingan sektor teknologi informasi digital.  </p>
                    </div>
                </div>

                <div class="col-lg-4  mb-lg-0 mb-5">
                    <div class="d-flex flex-column">
                                <p class="font-weight-bold">Kontak G-Academy</p>
                                <span class="d-flex align-items-center my-1">
                                    <i class="fab fa-whatsapp fa-1x mr-3" aria-hidden="true"></i>
                                    <span>085640236283</span>
                                </span>
                                <span class="d-flex align-items-center my-1">
                                    <i class="fa fa-envelope fa-1x mr-3" aria-hidden="true"></i>
                                    <span>gudangsoft.net@gmail.com</span>
                                </span>
                    </div>
                </div>

                <div class="col-lg-4 mb-lg-0 mb-5">
                    <div class="d-flex flex-column">
                        <p class="font-weight-bold">Lokasi</p>
                        <span class="d-flex align-items-baseline">    
                            <i class="fas fa-map-marker-alt fa-1x mr-3" aria-hidden="true"></i>
                            <span>Sulonjari, Bakalrejo, Guntur, Kabupaten Demak, Jawa Tengah 59565</span>
                        </span>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col text-lg-center">
                <p >
                    G-Academy.net <?php echo date("Y",time());?> <sup>&copy;</sup>  
                    Design by <a href="https://github.com/aripdev" target="_blank"><i class="fa fa-github text-white mr-2"></i><span class="text-white">aripdev</span></a>
            </p>
                            </div>
            </div>
        </div>
    </footer>

    
    <script src="{{asset('landing/js/plugins/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('landing/js/plugins/popper.min.js')}}"></script>
    <script src="{{asset('landing/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('landing/js/plugins/slick.min.js')}}"></script>
    <script src="{{asset('landing/js/plugins/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('landing/js/plugins/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('landing/js/plugins/wow.min.js')}}"></script>
    <script src="{{asset('landing/js/plugins/magnific-popup.min.js')}}"></script>
    <script src="{{asset('landing/js/main.js')}}"></script>
</body>
</html>
