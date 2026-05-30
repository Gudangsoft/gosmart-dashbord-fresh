<div class="admin-top-bar">
    <div class="months-select">
        <select>
            <option data-display="PAID">PAID</option>
            <option value="1">PENDING</option>
        </select>
    </div>
</div>

<div class="message mt-8">
    <div class="message-icon">
        <img src="{{asset('assets')}}/images/menu-icon/icon-6.png" alt="">
    </div>
    <div class="message-content">
        <p>Berikut adalah data data kelas yang sudah anda pilih dan siap untuk berlangganan. Pastikan memilih kelas yang sesuai dengan kebutuhan anda.<br><br><br></p>
    </div>
</div>
@if(Session::has('warning'))
<div class="message mt-8">
    <div class="message-icon">
        <img src="{{asset('assets')}}/images/menu-icon/icon-6.png" alt="">
    </div>
    <div class="message-content">
        <p>{{ session()->get('warning') }}</p>
    </div>
</div>

@endif
<div class="engagement-courses table-responsive">

    <div class="courses-list">
        <ul>
            @if (isset($data['cart_data']['data']))
                @foreach ($data['cart_data']['data'] as $k=>$v)
                    <li>
                        <div class="courses">
                            <div class="thumb">
                                <img src="{{ $v['data_class']['class']['image'] }}" alt="{{ $v['data_class']['class']['title'] }}">
                            </div>
                            <div class="content">
                                <h4 class="title"><a href="{{ $v['data_class']['class']['url'] }}">{!! $v['data_class']['class']['title'] !!}</a></h4>
                            </div>
                        </div>
                        <div class="taught">
                            <span>Rp {{ number_format($v['price']) }}</span>
                        </div>
                        <div class="button">
                            <a class="btn" href="{{ $v['data_class']['class']['url'] }}">Details</a>
                        </div>
                        <div class="button">
                            <a class="btn btn-danger" href="{{ route('carts.cancel', $v['data_class']['class']['id']) }}">Batal</a>
                        </div>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
    {{-- <div class="new-courses" style="background-image: url(assets/images/new-courses-banner.jpg);">
        <div class="new-courses-title">
            <h4 class="title">Masukan kode voucher jika ada</h4>
        </div>
        <div class="new-courses-btn" style="margin-left: 10px;">

            <input type="text" name="code" class="form-control form-control-lg">
        </div>
    </div> --}}
    <div class="new-courses" style="background-image: url(assets/images/new-courses-banner.jpg);">
        <div class="new-courses-title">
            <h3 class="title">Total bayar Rp {{ number_format($data['cart_data']['price_total']) }}</h3>
        </div>
        <div class="new-courses-btn" style="margin-left: 10px;">
            <form action="{{ route('cart.order') }}" method="POST">
            @csrf
                @if (isset($data['cart_data']['data']))
                    @foreach ($data['cart_data']['data'] as $k=>$v)
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" required>
                        <input type="hidden" name="class_id[{{ $k }}]" value="{{ $v['class_id'] }}" required>
                    @endforeach
                @endif
                <button type="submit" class="btn">Order Sekarang </button>
            </form>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-12">
    </div>
</div>
