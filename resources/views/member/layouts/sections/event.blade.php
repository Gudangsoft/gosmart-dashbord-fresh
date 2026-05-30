<div class="section">
    <div class="container">

        <div class="courses-wrapper-02">

            <div class="section-title shape-03 text-center">
                <h2 class="main-title">Event <span> Webinar</span></h2>
            </div>
            <div class="row">
                @if (isset($data['event']['data']))
                    @foreach ($data['event']['data'] as $k=>$v)
                        <div class="col-lg-3 col-md-6">
                            <div class="single-blog">
                                <div class="blog-image">
                                    <img src="{{$v['image']}}" alt="Courses">
                                </div>
                                <div class="blog-content">
                                    <div class="blog-author">
                                        <div class="author">
                                            <div class="author-thumb">
                                                <a href="{{ $v['url_author'] }}"><img src="{{ $v['author_image'] }}" alt="Author"></a>
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
                                        <span> <i class="icofont-calendar"></i> {{ $v['date'] }}</span>
                                        <span> <i class="icofont-ui-user-group"></i> {{ $v['participant_visit'] }}
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <a href="/event/{{ $v['id'] }}" class="btn btn-secondary btn-hover-primary btn-block">Info</a>
                                        </div>
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
    </div>
</div>
