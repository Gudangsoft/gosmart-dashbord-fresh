<div class="courses-details-tab">
    <div class="details-tab-menu">
        <ul class="nav justify-content-center">
            @if (!empty($data['tools']['data']))
                <li><button class="active" data-bs-toggle="tab" data-bs-target="#toolsclass">Tools Class</button></li>
                <li><a href="{{ $data['tools']['source'] }}" target="blank"><button class="active">Source</button></a></li>
            @else
                <h5 class="mt-2">Tools dan source hanya tersedia pada kelas premium</h5>
            @endif
        </ul>
    </div>
    <div class="details-tab-content">
        <div class="tab-content">

            <div class="tab-pane fade show active" id="toolsclass">

                <div class="tab-instructors">
                    <div class="row">
                        @if (isset($data['tools']['data']))
                            @foreach ($data['tools']['data'] as $k=>$v)
                                <div class="col-md-3 col-6">
                                    <div class="single-team">
                                        <div class="team-thumb">
                                            <a href="{{ $v['url'] }}"><img src="{{ $v['image'] }}" alt="Author"></a>
                                            <div class="team-content">
                                                <h4 class="name">{{ $v['title'] }}</h4>
                                                <a href="{{ $v['url'] }}" target="blank"><button class="small-btn-success">download</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
