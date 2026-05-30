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
        <p>Berikut adalah riwayat pembayaran kelas anda, segera lunasi jika status pembayaran masih pending. Anda juga bisa menghubungi admin jika pembayaran belum diproses<br><br><br></p>
    </div>
</div>

<div class="engagement-courses table-responsive">

    <div class="courses-top">
        <ul>
            <li>Class</li>
            <li>Price</li>
            <li>Status</li>
        </ul>
    </div>

    <div class="courses-list">
        <ul>
            @if (isset($data['pay_data']['data']))
                @foreach ($data['pay_data']['data'] as $k=>$v)
                    <li>
                        <div class="courses">
                            <div class="thumb">
                                <img src="{{ $v['image'] }}" alt="Courses">
                            </div>
                            <div class="content">
                                <h4 class="title"><a href="{{ $v['image'] }}">{!! $v['title'] !!}</a></h4>
                            </div>
                        </div>
                        <div class="taught">
                            <span>{{ $v['price'] }}</span>
                        </div>
                        <div class="student">
                            <span>{{ $v['paid'] }}</span>
                        </div>
                        <div class="button">
                            <a class="btn" href="/learning/pay_status/{{ $v['id']}}">Detail</a>
                        </div>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>

</div>
