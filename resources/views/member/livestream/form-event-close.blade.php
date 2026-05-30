

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Registrasi Webinar PTIC : INSPIRING PROFESSIONAL #SERIES 30 : &quot;Smart Berbisnis di Era Pandemi&quot; Telah Di Tutup</title>
    <!-- CSS files -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link href="https://registrasi.stekom.ac.id/assets/vendor/css/tabler.min.css" rel="stylesheet"/>

    <link rel="stylesheet" href="https://registrasi.stekom.ac.id/assets/administrator/select2/css/select2.min.css">
    <link rel="stylesheet" href="https://registrasi.stekom.ac.id/assets/administrator/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600&display=swap" rel="stylesheet">

	<style>
        .form-group.required .col-form-label:after {
            content:"*";
            color:red;
        }
        .form-group.required:not(.form-check-label)  .form-label:after {
            content:"*";
            color:red;
        }


    </style>

  </head>
  <body class="antialiased" style="font-family: 'Roboto Slab', serif;">
    <div class="wrapper">

      <div class="page-wrapper">
        <div class="container-xl">

        </div>



<div class="page-body">
    <div class="container-xl" style="max-width:800px">



            <div class="card mt-3">
                <div class="card-header py-1 bg-success">
                <!-- <h3 class="card-title">Invoices</h3> -->
                </div>

                <div class="card-body">
                        <div class="text-center">
                            <span class="font-weight-bold text-success" style="font-size:24px">FORM REGISTRASI TELAH DITUTUP</span>
                        </div>
                        <div class="w-100"></div>
                        <div class="text-center mt-2">
                            <span class="font-weight-bold" style="font-size:22px">{!! $data['row']->title !!}</span>
                        </div>
                        <div class="w-100"></div>
                        <div class="text-center mt-2">
                            <span class="font-weight-bold">{{ \Carbon\Carbon::parse($data['row']->time)->isoFormat('DD MMMM Y') }} {{ \Carbon\Carbon::parse($data['row']->time)->Format('H:i') }} WIB - {{ \Carbon\Carbon::parse($data['row']->end_time)->isoFormat('DD MMMM Y') }} {{ \Carbon\Carbon::parse($data['row']->end_time)->Format('H:i') }} WIB</span>
                        </div>

                                                                        <div class="w-100"></div>
                        <div class="text-center mt-2" style="line-height:0.8">
                            {{-- <span class="font-weight-bold text-danger" style="font-size:18px">Jangan Lupa Gabung Group Telegram Untuk Informasi Webinar</span><br><br><a href="https://t.me/+0fALDzQPYE0yYThl" class="badge bg-success badge-pill p-3" target="_BLANK">https://t.me/+0fALDzQPYE0yYThl</a> --}}
                        </div>
                        <div class="mb-3 p-2" style="border:2px solid #20b35a;border-radius:5px">
                            <span class="font-weight-bold">Tertarik untuk belajar di G-Academy ? <a href="https://g-academy.net/register" target="_BLANK">klik link ini</a> , nikmati kelas gratis dan premium secara permanen!</span>
                        </div>

                </div>
            </div>


    </div>
</div>



      </div>
    </div>

    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="https://registrasi.stekom.ac.id/assets/vendor/js/tabler.min.js"></script>

    <script src="https://registrasi.stekom.ac.id/assets/administrator/select2/js/select2.full.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){

          $("#select1").select2({
              placeholder: "Please Select"
          });
          $("#select2").select2({
              placeholder: "Please Select"
          });

          $('#select2bs4').select2({
          theme: 'bootstrap4'
          });

          $('#select2bs41').select2({
          theme: 'bootstrap4'
          });



        });
    </script>

    <div class="modal modal-blur fade" id="sukses" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="modal-status bg-success"></div>
          <div class="modal-body text-center py-4">
            <!-- Download SVG icon from http://tabler-icons.io/i/circle-check -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-green icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><path d="M9 12l2 2l4 -4" /></svg>
            <h3>Succedeed</h3>
            <div class="text-muted"></div>
          </div>
          <div class="modal-footer bg-success py-1">
          </div>
        </div>
      </div>
    </div>

  </body>
</html>
