@extends('backend.layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header sty-one">
      <h1 class="text-black">Kelas Baru</h1>
      <ol class="breadcrumb">
        <li><a href="#">Dashboard</a></li>
        <li class="sub-bread"><i class="fa fa-angle-right"></i> kelas</li>
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
          @if(Session::has('sukses'))
            <div class="alert alert-success" role="alert">Kelas berhasil ditambah  </div>
          @endif
          @if(Session::has('msg'))
            <div class="alert alert-success" role="alert">{{session()->get('msg')}}</div>
          @endif
        </div>
        <form class="form" action="/dashboard/class_save" method="POST" role="form" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="col-12 mb-2">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Kelas</label>
                            <div class="input-group">
                                <input class="form-control" name="class_id" id="exampleInputuname" placeholder="x" type="hidden" value="{{$data['class_id']}}">
                                <input class="form-control" name="action" id="exampleInputuname" placeholder="x" type="hidden" value="{{$data['action']}}">
                                <input class="form-control" name="name" id="exampleInputuname" placeholder="cth: Pemrograman Web" type="text" value="{{$data['title'] ? $data['title'] : old('title')}}">
                            </div>
                        </div>
                        <label>Harga <i class="text-danger">(+10% sistem)</i></label>
                        <div class="input-group mb-3">
                            <input class="form-control" name="price" id="inputPrice" placeholder="cth: 100.000" type="text" value="{{$data['price'] ? $data['price'] : old('price')}}"/>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputuname">Diskon</label>
                            <div class="input-group">
                                <input class="form-control" id="exampleInputuname" placeholder="Masukan angka, contoh: 30" name="discount" value="{{$data['discount'] ? $data['discount'] : old('discount')}}" type="text">
                                <div class="input-group-addon"><b>%</b></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputuname">Kategori</label>
                            <div class="input-group">
                                <select class="form-control custom-select" name="category_id" required>
                                    @if (isset($data['category_name']))
                                        <option value="{{ $data['category_id'] }}">{{ $data['category_name'] }}</option>
                                    @endif
                                    <option value="">-- PILIH --</option>
                                    @foreach ($data['category'] as $k=>$v)
                                        <option value="{{ $v->id }}">{{ $v->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <label>Deskripsi</label>
                                    <textarea id="classic" name="description" >{!!$data['description'] ? $data['description'] : old('description') !!}</textarea>
                            </div>
                            <div class="col-xl-6">
                                <label>Tambah Gambar</label>
                                <div class="form-group">
                                    <div class="card">
                                        <div class="card-body">
                                            <label for="input-file-now">Resolusi gambar 400 x 400 pixel sangat direkomendasikan</label>
                                            <input type="file" name="image" id="input-file-now" class="dropify" data-default-file="{{$data['image']}}"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-4">
                                <label class="control-label">Tipe</label>
                                <select class="form-control custom-select" name="premium">
                                    @if (isset($data['is_premium']))
                                        @if($data['is_premium'] != null)
                                            @php
                                                if($data['is_premium'] == true){
                                                    $is_premium = "PREMIUM";
                                                }else{
                                                    $is_premium =  "FREE";
                                                }
                                            @endphp
                                            <option value="{{$data['is_premium']}}">{{ucfirst($is_premium)}}</option>
                                        @endif
                                    @endif
                                    <option value="0">FREE</option>
                                    <option value="1">PREMIUM</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <label class="control-label">Level</label>
                                <select class="form-control custom-select" name="level">
                                @if($data['level'] != null)
                                    <option value="{{$data['level']}}">{{ucfirst($data['level_name'])}}</option>
                                @endif
                                @foreach($data['level_list'] as $k=>$v)
                                    <option value="{{$v['id']}}">{{ucfirst($v['name'])}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="col-4">
                                <label class="control-label">Tags</label>
                                <input class="form-control" name="tags" placeholder="cth: coding, tutorial" type="text" value="{{$data['tags'] ? $data['tags'] : old('tags')}}"/>
                            </div>
                            <div class="col-12 mt-3">
                                <label class="control-label">Source</label>
                                <input type="text" name="source_url" id="" class="form-control mr-2" placeholder="isi url source jika ada">
                            </div>
                            <div class="col-12 mt-3">
                                <label class="control-label">Tools kelas</label>
                                <div class="multipleSelection">
                                    <div class="selectBox"
                                        onclick="showCheckboxes()">
                                        <select class="form-control custom-select">
                                            <option>-- Pilih --</option>
                                        </select>
                                        <div class="overSelect"></div>
                                    </div>

                                    <div id="checkBoxes">
                                        @foreach ($data_tools as $k=>$v)
                                            <label for="first">
                                                <input type="checkbox" id="first" name="tools[]" value="{{$v['tools_id']}}"
                                                @if ($v['check'] == true)
                                                    checked
                                                @endif/>
                                                {{$v['tools_title']}}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @if ($data['action'] == 'create')
                                <div class="col-12 mt-3" id='dynamic_input_materi'>
                                    <label class="control-label">Link Materi</label>
                                    <div class="entry input-group mb-1">
                                        <input class="form-control mr-2" name="url_materi[]" type="text" placeholder="https://www.youtube.com/watch?v=I7szH0cXXX" required/>
                                        <span class="input-group-btn">
                                        <button class="btn btn-primary btn-add" type="button">
                                                <span class="fa fa-plus"></span>
                                        </button>
                                        </span>
                                    </div>
                                </div>
                            @endif
                        </div>
                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Tambah</button>
                            <a href="javascript:history.back()" class="btn btn-default">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- /.content -->
    @push('script')
    <script>
        var fnumber = document.getElementById("inputPrice");
        fnumber.addEventListener('keyup', function(evt){
            var n = parseInt(this.value.replace(/\D/g, ''), 10);
            fnumber.value = n.toLocaleString()
        }, false);
    </script>
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
    @endpush

@endsection
