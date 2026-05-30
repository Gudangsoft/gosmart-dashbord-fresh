
<div class="col-lg-5">
    <div class="sidebar">
        {{-- @php
            dd($data['main']['premium_cek'])
        @endphp --}}
        @if ($data['main']['premium_cek'] == 2 || $data['main']['premium_cek'] == 0)
            <div class="sidebar-widget widget-information">
                <div class="info-price">
                    <span class="price">Keuntungan</span>
                </div>
                <div class="info-list">
                    <ul>
                        <li><i class="icofont-folder"></i> <strong>Kategori</strong> <span>{{ $data['detail']['class']['category_title'] }}</span></li>
                        <li><i class="icofont-man-in-glasses"></i> <strong>Mentor</strong> <span>{{ $data['detail']['class']['author'] }}</span></li>
                        <li><i class="icofont-ui-video-play"></i> <strong>Materi</strong> <span>{{ $data['detail']['class']['total_materi'] }}</span></li>
                        <li><i class="icofont-bars"></i> <strong>Level</strong> <span>{{ $data['detail']['class']['level'] }}</span></li>
                        <li><i class="icofont-certificate-alt-1"></i> <strong>Sertifikat</strong> <span>{{ $data['get_certificate'] }}</span></li>
                    </ul>
                </div>
                <div class="info-btn">
                    <a href="{{ $data['main']['url'] }}" class="btn btn-primary btn-hover-dark">MULAI KELAS</a>
                </div>
            </div>
        @elseif($data['main']['premium_cek'] == 3)
            <div class="sidebar-widget widget-information">
                <div class="info-price">
                    <span class="price">Keuntungan</span>
                </div>
                <div class="info-list">
                    <ul>
                        <li><i class="icofont-folder"></i> <strong>Kategori</strong> <span>{{ $data['detail']['class']['category_title'] }}</span></li>
                        <li><i class="icofont-man-in-glasses"></i> <strong>Mentor</strong> <span>{{ $data['detail']['class']['author'] }}</span></li>
                        <li><i class="icofont-ui-video-play"></i> <strong>Materi</strong> <span>{{ $data['detail']['class']['total_materi'] }}</span></li>
                        <li><i class="icofont-bars"></i> <strong>Level</strong> <span>{{ $data['detail']['class']['level'] }}</span></li>
                        <li><i class="icofont-certificate-alt-1"></i> <strong>Sertifikat</strong> <span>{{ $data['get_certificate'] }}</span></li>
                    </ul>
                </div>
                <div class="info-btn">
                    <a href="{{ $data['main']['url'] }}" class="btn btn-primary btn-hover-dark">CEK PEMBAYARAN</a>
                </div>
            </div>
        @elseif($data['main']['premium_cek'] == 1)
            <div class="sidebar-widget widget-information">
                <div class="info-price">

                    <span class="price">{{ isset($data['detail']['class']['total_discount']) ? $data['detail']['class']['discount'] : $data['detail']['class']['price'] }}</span>
                </div>
                <div class="info-list">
                    <ul>
                        <li><i class="icofont-folder"></i> <strong>Kategori</strong> <span>{{ $data['detail']['class']['category_title'] }}</span></li>
                        <li><i class="icofont-man-in-glasses"></i> <strong>Mentor</strong> <span>{{ $data['detail']['class']['author'] }}</span></li>
                        <li><i class="icofont-ui-video-play"></i> <strong>Materi</strong> <span>{{ $data['detail']['class']['total_materi'] }}</span></li>
                        <li><i class="icofont-bars"></i> <strong>Level</strong> <span>{{ $data['detail']['class']['level'] }}</span></li>
                        <li><i class="icofont-certificate-alt-1"></i> <strong>Sertifikat</strong> <span>{{ $data['get_certificate'] }}</span></li>
                    </ul>
                </div>
                <div class="info-btn">
                    <div class="row">
                        <div class="col">
                            <form action="" id="add-carts{{ $data['detail']['class']['id'] }}" method="post">
                                @csrf
                                <input type="hidden" name="class_id" value="{{ $data['detail']['class']['id'] }}"  id="class_id{{ $data['detail']['class']['id'] }}">
                                <input type="hidden" name="price" value="{{ $data['detail']['class']['price_default'] }}" id="price{{ $data['detail']['class']['id'] }}">
                                <input type="submit" class="btn btn-primary btn-hover-dark btn-block" value="TAMBAHKAN">
                            </form>
                            @include('member.class.modal-add-cart')

                            @push('script')
                            <script type="text/javascript">

                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });

                                $("#add-carts{{ $data['detail']['class']['id'] }}").click(function(e){

                                    e.preventDefault();

                                    var class_id = $("#class_id{{ $data['detail']['class']['id'] }}").val();
                                    var price    = $("#price{{ $data['detail']['class']['id'] }}").val();
                                    var url = '{{ route('carts.store') }}';

                                    $.ajax({
                                    url:url,
                                    method:'POST',
                                    data:{
                                            class_id:class_id,
                                            price:price,
                                            },
                                    success:function(response){
                                        if(response.success){
                                            $('#cartSuccessModal{{ $data['detail']['class']['id'] }}').modal('show');
                                            var count = document.getElementById('cart-count').innerHTML=response.count;
                                            // alert(response.count) //Message come from controller
                                        }else{
                                            $('#cartFailed').modal('show');
                                        }
                                    },
                                    error:function(error){
                                        console.log(error)
                                    }
                                    });
                                });

                            </script>
                            @endpush
                        </div>
                    </div>
                </div>
            </div>

        @endif
        <div class="modal fade" id="joinNow">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">MULAI LANGGANAN KELAS {{ $data['detail']['class']['title'] }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body reviews-form">
                        <div class="alert alert-primary mt-3"><strong>Mohon melakukan pembayaran via : {{ $data['detail']['payment']['bank'] }}  {{ $data['detail']['payment']['number'] }} a.n {{ $data['detail']['payment']['username'] }}, sebesar {{ $data['detail']['class']['price'] }}</strong></div>
                        <form action="{{route('start_class')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="single-form">
                                        <input type="text" name="username" placeholder="username" value="{{ isset(auth()->user()->name) ? auth()->user()->name : '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single-form">
                                        <input type="email"name="email" placeholder="email" value="{{ isset(auth()->user()->email) ? auth()->user()->email : '' }}" readonly>
                                        <input type="hidden" name="class_id" value="{{$data['detail']['class']['id']}}">
                                        <input type="hidden" name="snap_token" value="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="single-form">
                                        <button class="btn btn-primary btn-hover-dark">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="sidebar-widget">
            <h4 class="widget-title">Share:</h4>

            <ul class="social">
                <li><a href="https://www.facebook.com/sharer/sharer.php?u={{$data['meta']['m_url']}}"target ="blank"><i class="flaticon-facebook"></i></a></li>
                <li><a href="https://twitter.com/intent/tweet?url={{$data['meta']['title']}}%0a{{$data['meta']['m_url']}}" target="_blank"><i class="flaticon-twitter"></i></a></li>
                <li><a href="https://wa.me/?text={{$data['meta']['title']}}%0a{{$data['meta']['m_url']}}" target="blank"><i class="fa fa-whatsapp"></i></a></li>
            </ul>
        </div>
    </div>
</div>

@push('script')
    @include('member.js.ajax-add-cart')
@endpush
