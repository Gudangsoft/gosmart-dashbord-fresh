<div class="admin-top-bar">
    <div class="months-select">
        <h3>CERTIFICATE</h3>
    </div>
</div>
<div class="message mt-8">
    <div class="message-icon">
        <img src="{{asset('assets')}}/images/menu-icon/icon-6.png" alt="">
    </div>
    <div class="message-content">
        <p><b>Pesan :</b><br>Pastikan anda melakukan download sertifat untuk lebih mudah dalam mengecek keaslian serifikat dari kami. Sertifikat ini dapat memudahkan anda untuk membantu dalam mencari passion di dunia kerja.<br>Segera kumpulkan dan dapapatkan rank terbaik dengan mengikuti kelas free dan berbayar<br>yang tersedia di G Academy</p>
    </div>
</div>
<div class="engagement-courses table-responsive">
    <div class="courses-list">
        <ul>
            @if (isset($data['data_certificate']['data']))
                @foreach ($data['data_certificate']['data'] as $k=>$v)
                    <li>
                        <div class="courses">
                            <div class="thumb">
                                <img src="{{ $v['image'] }}" alt="Courses">
                            </div>
                            <div class="content">
                                <h4 class="title">{!! $v['class'] !!}</a></h4>
                            </div>
                        </div>
                        <div class="taught">
                            <span>{{ $v['code'] }}</span>
                        </div>
                        <div class="button">
                            <a class="btn btn-success" href="{{ $v['url'] }}">Cetak</a>
                        </div>
                        <div class="button">
                            {{-- <a class="btn" href="{{ asset($v['url_download']) }}">Download</a> --}}
                            <a class="btn" href="{{ route('download-certificate', $v['code']) }}">Download</a>
                        </div>
                    </li>
                @endforeach
            @else
                    Data tidak ditemukan
            @endif

        </ul>
    </div>
</div>
