@extends('backend.layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header sty-one">
      <h1 class="text-black">Materi</h1>
      <ol class="breadcrumb">
        <li><a href="#">Dashboard</a></li>
        <li class="sub-bread"><i class="fa fa-angle-right"></i> materi</li>
      </ol>
    </div>

    <!-- Main content -->
    <div class="content">
      <div class="row" id="dynamic-wrap">
        <div class="col-lg-12">
          @if($errors->any())
            @foreach($errors->all() as $error)
              <div class="alert alert-danger" role="alert"> {{$error}} </div>
            @endforeach
          @endif
          {{-- @if(Session::has('alert'))
            <div class="alert alert-success" role="alert">{{session()->get('alert')}}  </div>
          @endif
          @if(Session::has('sukses'))
            <div class="alert alert-success" role="alert">{{session()->get('sukses')}}  </div>
          @endif --}}
        </div>
        <div class="col-lg-12">
            <div class="card ">
                <div class="card-header bg-blue">
                <h5 class="text-white m-b-0">{{$data['title_bar']}}</h5>
                </div>
                <div class="card-body">
                    <form class="form" action="/dashboard/video_add" role="form" autocomplete="off" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="row">
                        <div class="col-md-12">
                            <div class="form-group has-feedback">
                                <label class="control-label">Kelas</label>
                                <select name="siteID" id="siteID" class="form-control select2" style="width:100%">
                                    {{-- <option> Pilih kelas </option> --}}
                                    @if (isset($data['class_list']))
                                        @foreach ($data['class_list'] as $k => $v)
                                            <option value='{{ $v['class_id'] }}' > {{ strtoupper($v['name']) }} </option>
                                        @endforeach
                                    @elseif(isset($data['url']))
                                        @if ($data['url'] == 'video_update')
                                            <option value='{{ $data['class_id'] }}'> {{ strtoupper($data['class']) }} </option>
                                        @endif
                                    @endif
                                </select>
                            </div>
                            <div class="form-group has-feedback" id='dynamic_input_materi'>
                                <label class="control-label">Link Materi</label>
                                <div class="entry input-group mb-1">
                                    <input class="form-control mr-2" name="materi_id" type="hidden" value="{{ $data['id'] }}"/>
                                    <input class="form-control mr-2" name="action" type="hidden" value="{{$data['url']}}"/>
                                    <input class="form-control mr-2" name="url_materi[]" type="text" value="{{ $data['link'] }}" placeholder="https://www.youtube.com/watch?v=I7szH0cXXX" />
                                    <span class="input-group-btn">
                                    @if ($data['url'] == 'video_add')
                                        <button class="btn btn-primary btn-add" type="button">
                                                <span class="fa fa-plus"></span>
                                        </button>
                                    @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mt-4">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </div>
    <!-- /.content -->

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.min.js"></script> --}}

    <script>
        var show = true;

        function showCheckboxes() {
            var checkboxes =
                document.getElementById("checkBoxes");

            if (show) {
                checkboxes.style.display = "block";
                show = false;
            } else {
                checkboxes.style.display = "none";
                show = true;
            }
        }
    </script>
@endsection
