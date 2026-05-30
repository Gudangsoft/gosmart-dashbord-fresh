<div class="courses-wrapper-02">
    @if(Session::has('msg'))
        <div class="alert alert-primary" role="alert">
            {{session()->get('msg')}}
        </div>
    @endif
    @if(Session::has('verified'))
    <div class="alert alert-success" role="alert">
        Verifikasi email berhasil
    </div>
    @endif
    <div class="row">
        @if (isset($data['event']['data']))
            @foreach ($data['event']['data'] as $k=>$v)
                <div class="col-lg-4 col-md-6">
                    <div class="single-blog">
                        <div class="blog-image">
                            <img src="{{$v['image']}}" alt="Courses">
                        </div>
                        <div class="blog-content">
                            <div class="blog-author">
                                <div class="author">
                                    <div class="author-thumb">
                                        <a href="#"><img src="assets/images/author/author-02.jpg" alt="Author"></a>
                                    </div>
                                    <div class="author-name">
                                        <a class="name" href="{{ $v['url_author'] }}">{{ $v['created_by'] }}</a>
                                    </div>
                                </div>
                                <div class="tag">
                                    <a href="/category/{{ $v['category'] }}">{{ $v['category'] }}</a>
                                </div>
                            </div>

                            <h4 class="title"><a href="/event/{{ $v['id'] }}">{!!strtoupper($v['title'])!!}</a></h4>
                            <div class="blog-meta">
                                <span> <i class="icofont-calendar"></i> {{ $v['date'] }} | {{ $v['time'] }}</span>
                                <span> <i class="icofont-ui-user-group"></i> {{ $v['participant_visit'] }}
                            </div>
                            <div class="row">
                                <div class="col">
                                    <a href="/event/registed/{{$v['id']}}" class="btn btn-secondary btn-hover-primary btn-block">Daftar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="joinNow{{ $v['id'] }}">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Formuir Pendaftaran {!! $v['title'] !!}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body reviews-form">
                                <form action="#" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col">
                                            <div class="single-form">
                                                <input type="hidden" name="event_id" value="{{$v['id']}}">
                                                <label for="" class="font-weight-bold">Nama lengkap</label>
                                                <input type="text" name="username" class="form-control">
                                            </div>
                                            <div class="single-form">
                                                <label for="" class="font-weight-bold">Email</label>
                                                <input type="email"name="email" placeholder="email" value="">
                                            </div>
                                            <div class="single-form">
                                                <label for="" class="font-weight-bold">No.WhatsApp</label>
                                                <input type="email"name="email" placeholder="email" value="">
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
            @endforeach
            <div class="row mt-3">
                <div class="d-flex justify-content-center">
                    {{ $data['event']['rows']->onEachSide(2)->links() }}
                </div>
            </div>
        @else
            <h5 class="text-center">Segera hadir</h5>
        @endif
    </div>
</div>
