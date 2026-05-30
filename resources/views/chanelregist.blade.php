@extends('layouts.coba')

@section('content')
<div class="text-center mb-5 login-main-left-header pt-4">
   <img src="{{asset('img/favicon.png')}}" class="{{asset('img-fluid')}}" alt="LOGO">
   <h5 class="mt-3 mb-3">ADD YOUR CHANEL</h5>
   <p>Silahkan Masukan Chanel anda <br> Sesuai dengan Nama Anda</p>
</div>

    <form action="/add-chanel" method="POST"enctype="multipart/form-data">
      @csrf
      <div class="form-group">
         <label>{{ __('Name Lengkap') }}</label>
         <input type="text" class="form-control  @error('nama_lengkap') is-invalid @enderror" name="nama_lengkap" required placeholder="Nama Lengkap"/>
      @error('nama_lengkap')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
    </div>
        <div class="form-group">
           <label>{{ __('Name Chanel') }}</label>
           <input type="text" class="form-control  @error('nama_chanel') is-invalid @enderror" name="nama_chanel" required placeholder="Nama Chanel"/>
        @error('nama_chanel')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
          <div class="form-group">
             <label>{{ __('Link Chanel') }}</label>
             <input type="text" class="form-control  @error('link_chanel') is-invalid @enderror" name="link_chanel" required placeholder="Link Chanel"/>
          @error('link_chanel')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>

           <div class="form-group">
              <label for="e4">Gambar</label>
              <input type="file" placeholder="Contrary to popular belief, Lorem Ipsum (2019) is not." id="e4" class="form-control @error('chanel_img') is-invalid @enderror"name="chanel_img">
              @error('chanel_img')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
           </div>

      <button type="submit" class="btn btn-outline-primary">Save Changes</button>
       </form>


       @endsection
