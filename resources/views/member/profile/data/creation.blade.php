<h3 class="title"><span>Karya Saya</span></h3>
<div class="admin-top-bar flex-wrap">
    <div class="top-bar-filter-right">
        <div class="filter-btn">
            <a href="/learning/creation/create" class="btn btn-primary btn-hover-dark" data-toggle="modal" data-target="#exampleModal">Create</a>
        </div>
    </div>
</div>

<div class="message mt-8">
    <div class="message-icon">
        <img src="{{asset('assets')}}/images/menu-icon/icon-6.png" alt="">
    </div>
    <div class="message-content">
        <p>Ini adalah halaman karya yang bisa kamu isi dari hasil karya yang sudah kamu buat atau miliki. Silahkan tambahkan jika kamu memiliki karya seperti apilkasi web atau mobile dan juga lainnya.<br><br></p>
    </div>
</div>

@if(Session::has('delete'))
    <div class="message bg-danger text-light mt-8">
        <div class="message-icon">
            <img src="{{asset('assets')}}/images/menu-icon/icon-2.png" alt="">
        </div>
        <div class="message-content">
            <p>{{ session()->get('delete') }}</p>
        </div>
    </div>
@endif
@if(Session::has('msg'))
    <div class="message bg-info text-light mt-8">
        <div class="message-icon">
            <img src="{{asset('assets')}}/images/menu-icon/icon-2.png" alt="">
        </div>
        <div class="message-content">
            <p>{{ session()->get('msg') }}</p>
        </div>
    </div>
@endif

<div class="engagement-courses table-responsive">

    <div class="courses-list">
        <ul>
            @if (isset($data['row']))
                @foreach ($data['row'] as $item)
                    <li>
                        <div class="courses">
                            <div class="thumb">
                                <img src="{{asset('img')}}/solution-1.png" alt="">
                            </div>
                            <div class="content">
                                <h4 class="title"><a href="#">{!! $item->name !!}</a></h4>
                            </div>
                        </div>
                        <div class="button">
                            <a class="btn" href="{{ $item->url }}">View</a>
                        </div>
                        <div class="button">
                            <a class="btn btn-primary" href="{{ route('creation.edit', $item->id) }}">Edit</a>
                        </div>
                        <div class="button">
                            <a class="btn btn-danger" href="{{ route('creation.delete', $item->id) }}">Delete</a>
                        </div>
                    </li>
                @endforeach
            @endif
            @if ($data['row']->isEmpty())
                <li>
                    <div class="courses">
                        <div class="thumb">
                            <img src="{{asset('assets')}}/images/courses/circle-shape.png" alt="">
                        </div>
                        <div class="content">
                            <h4 class="title"><a href="#">Nama karya kamu</a></h4>
                        </div>
                    </div>
                    <div class="button">
                        <a class="btn" href="#">View</a>
                    </div>
                    <div class="button">
                        <a class="btn btn-primary" href="#">Detail</a>
                    </div>
                    <div class="button">
                        <a class="btn btn-danger" href="#">Delete</a>
                    </div>
                </li>
            @endif
            </ul>
        </div>
        <div class="mt-2">
            {{ $data['row']->links() }}
        </div>
</div>

