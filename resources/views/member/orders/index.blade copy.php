<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/css/order.css">

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"></script>
    {{-- <script src="{{asset('assets')}}/js/vendor/jquery-3.5.1.min.js"></script> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>



</head>
<body>
    <div class="container">
        <div class="row m-0">
            <div class="col p-0 ">
                <div class="box-left">
                    <p class="textmuted h8">Invoice</p>
                    <p class="fw-bold h7">{{ $data['user']->name }}</p>
                    <p class="textmuted h8 mb-2">{{ $data['user']->address }}</p>
                    <div class="h8">
                        <div class="row m-0 border mb-3">
                            <div class="col-6 pe-0 ps-2">
                                <p class="textmuted py-2"><strong class="fw-bold h7">Items</strong></p>
                                @foreach ($data['cart']['data'] as $k=>$v)
                                    <span class="d-block py-2 border-bottom">{{ ucwords($v['data_class']['class']['title']) }}</span>
                                @endforeach
                            </div>
                            <div class="col-6 text-end pr-2">
                                <p class="textmuted py-2"><strong class="fw-bold h7">Harga</strong></p>
                                @foreach ($data['cart']['data'] as $k=>$v)
                                    <input type="hidden" id="list-price-form{{ $v['data_class']['class']['id'] }}" value="{{ $v['price'] }}">
                                    <span class="d-block py-2 border-bottom">Rp <span id="{{ $v['data_class']['class']['id'] }}">{{ number_format($v['price']) }}</span> <s id="price-old{{ $v['data_class']['class']['id'] }}" style="display: none;">{{ number_format($v['price']) }}</s></span>
                                @endforeach
                            </div>
                        </div>
                        <div class="d-flex h7 mb-4">
                            <p class="">Total Oder</p>
                            <input type="hidden" id="total-price-form" value="{{ $data['cart']['price_total'] }}">
                            <p class="ms-auto" id="total-price">Rp {{ number_format($data['cart']['price_total']) }}</p>
                        </div>
                    </div>
                    <div class="">
                        <p class="h5 fw-bold mb-1">Voucher Kelas</p>
                        <p class="textmuted h6 mb-2">Masukan kode voucher di bawah jika ada</p>
                        <div class="alert alert-success" id="alert-voucher">
                            <div id="msg" class="h6"></div>
                        </div>
                        <div class="alert alert-danger" id="alert-voucher-danger">
                            <div id="msg-danger"></div>
                        </div>
                        @if(Session::has('warning'))
                            <div class="alert alert-success" role="alert">{{ session()->get('warning') }}</div>
                        @endif
                        <div class="form">
                            <div class="row">
                                <div class="col-12">
                                    <form action="" method="post">
                                    @csrf
                                        @foreach ($data['cart']['data'] as $k=>$v)
                                            <input type="hidden" name="class_list[]" id="class_list" value="{{ $v['data_class']['class']['id'] }}">
                                        @endforeach
                                        <div class="card border-0">
                                            <input class="form-control ps-5" type="text" id="code-voucher" name="code_voucher" placeholder="Kode Voucher"> <span class="far fa-credit-card"></span>
                                        </div>
                                        <button id="check-voucher" class="btn btn-dark d-block h8 mt-1">REDEEM <span class="ms-3 fas fa-arrow-right"></span></button>
                                    </form>
                                </div>
                            </div>
                            <div class="btn btn-primary d-block h8 mt-4" id="order">BAYAR SEKARANG <span class="ms-3 fas fa-arrow-right"></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('member.orders.modal')
</body>
<script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#alert-voucher').hide();
    $('#alert-voucher-danger').hide();

    // Redeem Voucher
    $("#check-voucher").click(function(e){

        e.preventDefault();
        var code_voucher    = $("#code-voucher").val();

        var class_id        = $("input[name='class_list[]']").map(function(){return $(this).val();}).get()
        var url = '{{ route('carts.voucher') }}';

        $.ajax({
        url:url,
        method:'POST',
        data:
            {
                code_voucher:code_voucher,
                // class_id:class_id,
            },

        success:function(response){
            if(response.success){
                $('#alert-voucher-danger').hide();
                $('#alert-voucher').show();
                let msg                 = document.getElementById("msg").innerHTML=response.message;

                let price_list_form     = $("#list-price-form"+response.classid).val();
                let price_old           = document.getElementById("price-old"+response.classid).style.display = 'inline';

                let calc                = Math.round(price_list_form - response.discount);
                let discount            = document.getElementById(response.classid).innerHTML=calc;
                let discount_form       = document.getElementById("list-price-form"+response.classid).value=calc;

                let total_price_form    = $("#total-price-form").val();
                let total_price         = Math.round(total_price_form - response.discount);
                let total               = document.getElementById("total-price").innerHTML= new Intl.NumberFormat("id-ID", { style: "currency", currency: "IDR", minimumFractionDigits: 0}).format(total_price);
                let total_form          = document.getElementById("total-price-form").value=total_price;

                // alert(discount) //Message come from controller
            }else{
                $('#alert-voucher').hide();
                $('#alert-voucher-danger').show();

                let msg = document.getElementById("msg-danger").innerHTML=response.message;
            }
        },
        error:function(error){
            console.log(error)
        }
        });
    });

    // Checkout Order
    $("#order").click(function(e){
        e.preventDefault();
        var code_voucher    = $("#code-voucher").val();

        var class_id        = $("input[name='class_list[]']").map(function(){return $(this).val();}).get()
        var url = '{{ route('cart.checkout') }}';

        $.ajax({
        url:url,
        method:'POST',
        data:
            {
                class_id:class_id,
            },
        success:function(response){

        },
        error:function(error){
            alert('error');
        }
        });
    });


</script>
</html>/
