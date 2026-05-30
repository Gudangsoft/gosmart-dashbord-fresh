@if(Session::has('msg'))
<!-- Message Start -->
    <div class="message">
        <div class="message-icon">
            <img src="{{asset('assets')}}/images/menu-icon/icon-6.png" alt="">
        </div>
        <div class="message-content">
            <p>{{ session()->get('msg') }}</p>
        </div>
    </div>
<!-- Message End -->
@endif

<!-- Graph Top Start -->
<div class="graph">
    <div class="row">
        <div class="col-12">
            <div class="graph-title">
                <h4 class="title" style="margin-right:30px;">Data statistik laporan G-Academy</h4>
                <div class="graph-btn">
                    <a class="btn btn-primary btn-hover-dark" href="#">Revenue Report <i class="icofont-rounded-down"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="graph-content">
                <div id="uniqueReport"></div>
            </div>


        </div>
    </div>
</div>
<!-- Graph Top End -->
<div class="row mt-7">
    <div class="col-xl-12">
        <h3>Laporkan segala keluhan anda disini</h3>
    </div>
    <div class="col-xl-12">
        <form action="/learning/reports" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="single-form">
                <textarea name="report_text">isi aduan anda</textarea>
            </div>
            <div class="col-12 text-right">
                <div class="single-form">
                    <button class="btn btn-primary btn-hover-dark w-100">Kirim</button>
                </div>
                </form>
            </div>
        </form>
    </div>
</div>
