
<div class="col-lg-5">
    <div class="sidebar">

        <div class="sidebar-widget widget-information">
            <div class="info-price">

                <span class="price">{{ isset($data['event']->price) ? 'Rp '.$data['event']->price : 'GRATIS' }}</span>
            </div>
            <div class="info-list">
                <ul>
                    @if ($data['event']->category_id != 0)
                        <li><i class="icofont-price"></i> <strong>Kuota Peserta</strong> <span>{{$data['event']->participant - $data['register']}}</span></li>
                    @endif
                    <li><i class="icofont-folder"></i> <strong>Jadwal</strong></li>
                    <li style="padding-bottom:10px;">
                        {{ \Carbon\Carbon::parse($data['event']->time)->isoFormat('DD MMMM Y') }} {{ \Carbon\Carbon::parse($data['event']->time)->Format('H:i') }} WIB - {{ \Carbon\Carbon::parse($data['event']->end_time)->isoFormat('DD MMMM Y') }} {{ \Carbon\Carbon::parse($data['event']->end_time)->Format('H:i') }} WIB
                    </li>
                </ul>
            </div>
            <div class="info-btn">
                <div class="row">
                    <div class="col">
                        @if (isset(auth()->user()->id))
                            @if ($data['event']->category_id > 0)
                                <a href="/event/join/{{$data['event']->id }}" class="btn btn-primary btn-block">Join</a>
                            @endif
                        @endif
                        @if ($data['event']->category_id == 0)
                            <a href="{{ $data['event']->url_meet }}" class="btn btn-primary btn-block">Daftar sekarang</a>
                        @else
                            <a href="/event/registed/{{ $data['event']->id }}" class="btn btn-primary btn-block">Daftar sekarang</a>
                        @endif
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
