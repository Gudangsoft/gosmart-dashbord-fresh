<div class="section section-padding-02 mt-n1">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h4 class="widget-title">Portofolio member</h4>
                <h5 class="mt-2"><span class="badge badge-success">{{$counter}} Karya</span> </h5>
            </div>
            <div class="col-6 text-right">
                <h5><a href="/creations" class="btn btn-primary btn-small">View All</a></h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="widget-post">
                    <ul class="post-items">
                        @if (isset($data))
                            @foreach($data as $k => $c)
                            <li>
                                <div class="single-post">
                                    <div class="post-thumb">
                                        <a href="{{ $c->url }}"><img src="assets/images/blog/blog-04.jpg" alt="{{ $c->name }}"></a>
                                    </div>
                                    <div class="post-content">
                                        <h5 class="title"><a href="{{ $c->url }}">{{ $c->name }}</a></h5>
                                        <span class="date"><i class="icofont-calendar"></i> {{ \Carbon\Carbon::parse($c->created_at)->isoFormat('dddd, D MMMM Y') }}</span>
                                            <span class="date"><i class="icofont-user"></i> {{ $c->getuser->name }}</span>
                                    </div>
                                </div>
                            </li>
                            @if ($k == 3)
                                @break
                            @endif
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="widget-post">
                    <ul class="post-items">
                        @if (isset($data))
                            @foreach($data as $key => $creation)
                            @if ($key > 3)
                                <li>
                                    <div class="single-post">
                                        <div class="post-thumb">
                                            <a href="{{ $creation->url }}"><img src="assets/images/blog/blog-04.jpg" alt="{{ $creation->name }}"></a>
                                        </div>
                                        <div class="post-content">
                                            <h5 class="title"><a href="{{ $creation->url }}">{{ $creation->name }}</a></h5>
                                            <span class="date"><i class="icofont-calendar"></i> {{ \Carbon\Carbon::parse($c->created_at)->isoFormat('dddd, D MMMM Y') }}</span>
                                            <span class="date"><i class="icofont-user"></i> {{ $creation->getuser->name }}</span>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if ($key == 7)
                                @break
                            @endif
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
