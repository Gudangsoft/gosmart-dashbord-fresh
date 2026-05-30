<h4 class="title">Helo, {{ $data['profile']['name'] }}</h4>
<div class="overview-box">
    <a href="/learning/detail_class/{{ $data['profile']['name'] }}">
        <div class="single-box">
            <h5 class="title">Total Kelas</h5>
            <div class="count">{{ $data['data']['class_total'] }}</div>
            <p><span>{{ $data['data']['class_finish'] }}</span> Selesai</p>
        </div>
    </a>

    <div class="single-box">
        <h5 class="title">Total Materi</h5>
        <div class="count">{{ $data['data']['materi_total'] }}</div>
        <p><span>{{ $data['data']['materi_finish'] }}</span> Selesai</p>
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


<!-- Graph Top Start -->
<div class="graph">
    <div class="graph-title">
        <h4 class="title">Complete Course</h4>

    </div>

    <div class="graph-content">
        list kelas
    </div>

    <div class="graph-btn">
        <a class="btn btn-primary btn-hover-dark" href="#">Revenue Report <i class="icofont-rounded-down"></i></a>
    </div>
</div>
<!-- Graph Top End -->
