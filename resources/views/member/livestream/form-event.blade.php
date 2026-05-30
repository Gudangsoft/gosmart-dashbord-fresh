

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Registrasi {!! $data['row']->title !!}</title>
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
  <body class="antialiased" style="font-family: sans-serif;">
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
                            <span class="font-weight-bold text-success" style="font-size:24px">FORM REGISTRASI</span>
                        </div>
                        <div class="w-100"></div>
                        <div class="text-center mt-2">
                            <span class="font-weight-bold" style="font-size:22px">{!! $data['row']->title !!}</span>
                        </div>
                        <div class="w-100"></div>
                        <div class="text-center mt-2">
                            @if ($data['row']->premium == 1)
                            <div class="mb-3 p-2" style="background-color: #20b35a;color:#fff;border-radius:5px">
                                <span class="font-weight-bold"  style="font-size:22px;padding:10px;background-color:#20b35a;">Biaya Rp {{ number_format($data['row']->price) }}</span>
                            </div>
                            @endif
                        </div>
                        <div class="text-center mt-2">
                            <span class="font-weight-bold">{{ \Carbon\Carbon::parse($data['row']->time)->isoFormat('DD MMMM Y') }} {{ \Carbon\Carbon::parse($data['row']->time)->Format('H:i') }} WIB - {{ \Carbon\Carbon::parse($data['row']->end_time)->isoFormat('DD MMMM Y') }} {{ \Carbon\Carbon::parse($data['row']->end_time)->Format('H:i') }} WIB</span>
                        </div>
                        <div class="w-100"></div>



                </div>
            </div>

              <div class="card mt-3">
                <div class="card-header py-1 bg-success">
                <!-- <h3 class="card-title">Invoices</h3> -->
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="form-input" style="margin-bottom: 50px;background-color:#ef5555;color:#fff;padding:5px;">
                            <label for="first"><h3>Peringatan!</h3></label>
                            <label for="firstx">
                                <h3>
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}
                                    @endforeach
                                </h3>
                            </label>
                        </div>
                    @endif
                    @if (Session::has('error'))
                        <div class="form-input" style="margin-bottom: 50px;background-color:#ef5555;color:#fff;padding:5px;">
                            <label for="first"><h3>Peringatan!</h3></label>
                            <label for="firstx"><h3>{{ session()->get('error') }}</h3></label>
                        </div>
                    @endif

                  <div  class="mb-3" >
                      <span class="" style="color:red">Yang Bertanda [*] wajib di isi !!!</span>
                  </div>

                  <form method="POST" action="{{ route('event.store') }}" class="register-form" id="register-form">
                    @csrf
                      <div class="form-group required mb-3">
                          <label class="form-label font-weight-bold">Nama Lengkap</label>
                          <span class="text-primary">Tuliskan nama lengkap dan gelar lengkap anda (untuk penulisan di sertifikat).</span>
                          <input type="text" class="form-control " id="nama_lengkap" name="username" placeholder="Enter nama lengkap" value="">
                          <div class="invalid-feedback">
                              <i class="bx bx-radio-circle"></i>                          </div>
                      </div>
                      <div class="form-group required mb-3">
                          <label class="form-label font-weight-bold">Nama Institusi atau Perusahaan</label>
                          <span class="text-primary">Tuliskan nama institusi atau perusahaan anda. </span>
                          <input type="text" class="form-control " id="institusi" name="company" placeholder="Enter institusi" value="">
                          <div class="invalid-feedback">
                              <i class="bx bx-radio-circle"></i>                          </div>
                      </div>
                      <div class="form-group required mb-3">
                          <label class="form-label font-weight-bold">Pekerjaan</label>
                          <span class="text-primary">Tuliskan Pekerjaan Anda.</span>
                          <input type="text" class="form-control " id="pekerjaan" name="profession" placeholder="Enter nama pekerjaan" value="">
                          <div class="invalid-feedback">
                              <i class="bx bx-radio-circle"></i>                          </div>
                      </div>
                      <div class="form-group required mb-3">
                          <label class="form-label font-weight-bold">Email</label>
                          <span class="text-primary">Tuliskan email valid yang bisa dihubungi (untuk pengiriman sertifikat).</span>
                          <input type="text" class="form-control " id="email" name="email" placeholder="Enter email" value="">
                          <div class="invalid-feedback">
                              <i class="bx bx-radio-circle"></i>                          </div>
                      </div>
                      <div class="form-group required mb-3">
                          <label class="form-label font-weight-bold">No. WhatsApp</label>
                          <span class="text-primary">Tuliskan No WhatsApp valid yang bisa dihubungi (untuk pengiriman sertifikat).</span>
                          <input type="number" class="form-control " id="no_wa" name="whatsapp" placeholder="Enter no whatsapp" value="">
                          <div class="invalid-feedback">
                              <i class="bx bx-radio-circle"></i>                          </div>
                      </div>

                                                                  {{-- <div class="form-group  mb-3">
                          <label class="form-label font-weight-bold">Link Youtube !!!</label>
                          <a href="https://bit.ly/live-daurulang" target="_BLANK">https://bit.ly/live-daurulang</a>
                      </div> --}}

                      @if ($data['row']->premium == 1)
                        <div class="mb-3 p-2" style="background-color: #fd4a4f;color:#fff;border-radius:5px">
                            <span class="font-weight-bold">Pembayaran event dapat melalui nomor rekening {{ $data['payment']->bank_name }} {{ $data['payment']->no_rekening }} a.n {{ $data['payment']->owner_name }} sebesar Rp {{ number_format($data['row']->price) }}</span>
                        </div>
                        <div class="mb-3 p-2" style="background-color: #20b35a;color:#fff;border-radius:5px">
                            <span class="font-weight-bold"><strong>Penting !</strong> Kirim bukti pembayaran anda melalui whatsapp di {{ $data['row']->contact }} atau klik <a href="https://wa.me/{{ $data['row']->contact }}?text=Berikut%20saya%20lampirkan%20bukti%20pembayaran" style="color:#ff0;">di sini</a> untuk mendapatkan link join event.</span>
                        </div>
                      @endif
                      <div class="mb-3 p-2" style="border:2px solid #20b35a;border-radius:5px">
                          <span class="font-weight-bold">Selamat, kamu memiliki kesempatan untuk menikmati kelas gratis dan premium secara permanen di <a href="https://g-academy.net" target="_BLANK">G-Academy.net</a>, join sekarang untuk menjadi member kami, <a href="https://g-academy.net/register" target="_BLANK">klik join</a></span>
                      </div>



                      <div class="mt-4">
                        <button type="submit" class="btn btn-success ml-1">Kirim Pendaftaran</button>
                      </div>

                    </div>
                  </form>

                </div>
              </div>


    </div>
</div>


                    <script>
						$(function() {
						   $("input[name='anggota_radio']").click(function() {
							 if ($("#lainnya").is(":checked")) {
							   $("#lainnya_in").show();
							 } else {
							   $("#lainnya_in").hide();
							 }
						   });
						 });
					</script>
					<script>
						$(function() {
						   $("input[name='f']").click(function() {
							 if ($("#lainnya").is(":checked")) {
							   $("#lainnya_in").show();
							 } else {
							   $("#lainnya_in").hide();
							 }
						   });
						 });
					</script>


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
<!-- end document-->

{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register {{ $data['row']->title }}</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset('event-registed') }}/fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="{{ asset('event-registed') }}/{{ asset('colorlib-regform') }}/vendor/nouislider/nouislider.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('event-registed') }}/css/style.css">
</head>
<body>

    <div class="main">

        <div class="container">
            <div class="signup-content">
                <div class="signup-img">
                    <img src="{{ asset('event-registed') }}/images/form-img.jpg" alt="">
                    <div class="signup-img-content">
                        <h2>Register Sekarang </h2>
                        <p>{!! $data['row']->title !!}</p>
                    </div>
                </div>
                <div class="signup-form">

                    <form method="POST" action="{{ route('event.store') }}" class="register-form" id="register-form">
                        @csrf
                        <div class="form-row">
                            <div class="form-group">
                                <div class="form-input" style="margin-bottom: 50px;background-color:#ddd;padding:5px;border-left:4px solid #222;">
                                    <label for="first"><h3>form registrasi</h3></label>
                                    <label for="firstx"><h3>"{!! $data['row']->title !!}"</h3></label>
                                </div>
                                @if ($errors->any())
                                    <div class="form-input" style="margin-bottom: 50px;background-color:#ef5555;color:#fff;padding:5px;border-left:4px solid #555;">
                                        <label for="first"><h3>Peringatan!</h3></label>
                                        <label for="firstx">
                                            <h3>
                                                @foreach ($errors->all() as $error)
                                                    {{ $error }}
                                                @endforeach
                                            </h3>
                                        </label>
                                    </div>
                                @endif
                                @if (Session::has('error'))
                                    <div class="form-input" style="margin-bottom: 50px;background-color:#ef5555;color:#fff;padding:5px;border-left:4px solid #555;">
                                        <label for="first"><h3>Peringatan!</h3></label>
                                        <label for="firstx"><h3>{{ session()->get('error') }}</h3></label>
                                    </div>
                                @endif
                                <div class="form-input">
                                    <label for="first_name" class="required">Nama Lengkap </label>
                                    <input type="hidden" name="event_id" value="{{ $data['row']->id }}" id="event_id" />
                                    <input type="text" name="username" id="first_name" placeholder="masukan nama lengkap dengan gelar jika ada"/>
                                </div>
                                <div class="form-input">
                                    <label for="company" class="required">Nama Intitusi atau Perusahaan</label>
                                    <input type="text" name="company" id="company" />
                                </div>
                                <div class="form-input">
                                    <label for="phone_number" class="required">Pekerjaan</label>
                                    <input type="text" name="profession" id="profession" />
                                </div>
                                <div class="form-input">
                                    <label for="email" class="required">Email</label>
                                    <input type="email" name="email" id="email" />
                                </div>
                                <div class="form-input">
                                    <label for="last_name" class="required">No.WhatsApp</label>
                                    <input type="text" name="whatsapp" id="whatsapp" />
                                </div>
                                <div class="form-radio">
                                    <div class="label-flex">
                                        <label for="payment">Saya Anggota</label>
                                    </div>
                                    <div class="form-radio-group">
                                        <div class="form-radio-item">
                                            <input type="radio" name="member" id="cash" value="mahasiswa" checked>
                                            <label for="cash">Mahasiswa</label>
                                            <span class="check"></span>
                                        </div>
                                        <div class="form-radio-item">
                                            <input type="radio" name="member" id="cheque" value="dosen">
                                            <label for="cheque">Dosen</label>
                                            <span class="check"></span>
                                        </div>
                                        <div class="form-radio-item">
                                            <input type="radio" name="member" id="demand" value="sma-smk">
                                            <label for="demand">SMA/SMK</label>
                                            <span class="check"></span>
                                        </div>
                                        <div class="form-radio-item">
                                            <input type="radio" name="member" id="umum" value="umum">
                                            <label for="umum">Umum</label>
                                            <span class="check"></span>
                                        </div>
                                        <div class="form-radio-item">
                                            <input type="radio" name="member" id="lainnya" value="lainnya">
                                            <label for="lainnya">Lainnya</label>
                                            <span class="check"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-submit">
                            <input type="submit" value="Daftar" class="submit" id="submit" name="submit" />
                            <input type="submit" value="Reset" class="submit" id="reset" name="reset" />
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <!-- JS -->
    <script src="{{ asset('event-registed') }}/{{ asset('colorlib-regform') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('event-registed') }}/{{ asset('colorlib-regform') }}/vendor/nouislider/nouislider.min.js"></script>
    <script src="{{ asset('event-registed') }}/{{ asset('colorlib-regform') }}/vendor/wnumb/wNumb.js"></script>
    <script src="{{ asset('event-registed') }}/{{ asset('colorlib-regform') }}/vendor/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="{{ asset('event-registed') }}/{{ asset('colorlib-regform') }}/vendor/jquery-validation/dist/additional-methods.min.js"></script>
    <script src="{{ asset('event-registed') }}/js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html> --}}
