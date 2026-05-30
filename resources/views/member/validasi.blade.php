@extends('member.layouts.master')
@section('content')
<div id="content-wrapper">
    <div class="container-fluid">
               <!-- Contact Us -->
      <section class="section-padding">
         <div>
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <h3 class="mt-1 mb-4">Konfirmasi Pembayaran</h3>
                    <h6 class="text-dark">Nama :</h6>
                    <p>{{ucwords($profile['name'])}}</p>
                    <h6 class="text-dark">Email :</h6>
                    <p>{{$profile['email']}}</p>
                    <h6 class="text-dark">Phone :</h6>
                    <p>{{$profile['phone']}}</p>
                    <h6 class="text-dark">Kelas diambil :</h6>
                    <p>{{$data['class_name']}}</p>
                    <h6 class="text-dark">Status :</h6>
                    <p><button class="btn btn-sm {{$data['msg'] == 'LUNAS' ? 'btn-success' : 'btn-primary'}}" disabled>{{$data['msg']}}</button></p>


                </div>
                <div class="col-lg-8 col-md-8">
                    <div class="card">
                        <div class="card-body">
                        @if($data['status'] == 'pay')
                            <p>
                                Konfirmasi : <a href="{{$data['url_wa']}}" class='btn btn-success btn-sm border-none'> Whatsapp </a> | <a href="mailto::{{$data['email']}}?subject=Feedback&body={{$data['subject_email']}}" class='btn btn-secondary btn-sm border-none'> e-Mail </a>
                                <div class="mb-3">
                                    <img src="{{$data['image']}}" alt="{{$data['msg']}}" style="max-width:400px;max-height:650px;">
                                </div>
                                <h5>
                                    Terimakasih, proeses pembayaran sedang kami verifikasi.
                                </h5>
                            </p>
                        @elseif($data['status'] == 'premium')
                            <p>
                                Informasi lainnya melalui : <a href="{{$data['url_wa']}}" class='btn btn-success btn-sm border-none'> Whatsapp </a> | <a href="mailto::{{$data['email']}}?subject=Feedback&body={{$data['subject_email']}}" class='btn btn-secondary btn-sm border-none'> e-Mail </a>
                                <div class="mb-3">
                                    <img src="{{$data['image']}}" alt="{{$data['msg']}}" style="max-width:400px;max-height:650px;">
                                </div>
                                <h3>
                                    {{strtoupper('pembayaran lunas untuk kelas '.$data['class_name'])}}
                                </h3>
                            </p>
                        @else
                        <form action="{{route('pay')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <h4 class="text-black">Upload bukti pembayaran (max : 5MB)</h4>
                            <label for="input-file-now-custom-2">Photo atau Screenshoot dengan jelas</label>
                            <input type="file" name="pay" id="input-file-now-custom-2" class="dropify" data-height="300" />
                            <input type="hidden" name="class_id" value="{{$data['class_id']}}">
                            <button type="submit" class="btn btn-info border-none mt-3 btn-block">KIRIM</button>
                        </form>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
         </div>
      </section>
      <!-- End Contact Us -->
      <hr>
    </div>
    @include('member.layouts.footer')
    @if(Session::has('msg-notpay'))
    <div class="modal fade" id="alertPay" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">G-Academy</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                            <h6>Silakan konfirmasi bukti pembayaran anda.</h6>
                    </p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">OK</button>
                    <!-- <button class="btn btn-primary" type="button">Ok</button> -->
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
