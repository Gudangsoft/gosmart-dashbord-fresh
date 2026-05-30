<h4 class="title">Helo, {{ $data['profile']['name'] }}</h4>
<div class="overview-box">
    <a href="/learning/detail_class/{{ $data['profile']['name'] }}">
        <div class="single-box">
            <h5 class="title" id="title_class">Total Kelas</h5>
            <div class="count" id="total_class">{{ $data['data']['class_total'] }}</div>
            <p><span id="total_class_complete">{{ $data['data']['class_finish'] }}</span> Selesai</p>
        </div>
    </a>

    <div class="single-box">
        <h5 class="title" id="title_materi">Total Materi</h5>
        <div class="count">{{ $data['data']['materi_total'] }}</div>
        <p><span id="total_materi_complete">{{ $data['data']['materi_finish'] }}</span> Selesai</p>
    </div>

    <div class="single-box">
        <h5 class="title">Voucher</h5>
        <div class="count">
            0
        </div>
        <p><span>0 </span>Expired</p>
    </div>
    <div class="single-box bg-dark" style="color:#fff!important;">
        <h5 class="title" style="color:#fff!important;">Ranking</h5>
        <div class="count">
            BRONZE
        </div>
        <p><span>+100 Hari ke Silver</span></p>
    </div>
</div>

<div class="graph">
    <div class="graph-title">
        <h4 class="title" style="margin-right: 50px;">Data aktivitas sukses dari {{ auth()->user()->name }}</h4>

        <div class="months-select">
            <select>
                <option data-display="Tahun">Sekarang</option>
                {{-- <option value="1">Last 6 months</option>
                <option value="1">Last 3 months</option>
                <option value="1">Last 2 months</option>
                <option value="1">Last 1 months</option>
                <option value="1">Last 1 week</option> --}}
            </select>
        </div>
    </div>

    <div class="graph-content">
        <div id="uniqueReport"></div>
    </div>

    <div class="graph-btn">
        {{-- <a class="btn btn-primary btn-hover-dark" href="#">Revenue Report <i class="icofont-rounded-down"></i></a> --}}
    </div>
</div>

<script src="{{asset('assets')}}/js/plugins/apexcharts.min.js"></script>
<script src="{{asset('assets')}}/js/overview.js"></script>


