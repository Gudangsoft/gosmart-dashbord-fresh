<h3 class="title">Edit <span>your profile</span></h3>
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
<div class="graph">
    <div class="row">
        {{-- <div class="register-login-form"> --}}
            <div class="col-xl-6">
                <form action="/learning/profile_update" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="single-form">
                    <label for="">Username</label>
                    <input type="text" name="id" placeholder="Name" value="{{ $data['id'] }}" hidden>
                    <input type="text" name="username" placeholder="Name" value="{{ $data['name'] }}">
                </div>
                <div class="single-form">
                    <label for="">Phone</label>
                    <input type="number" name="phone" placeholder="+62123123" value="{{ $data['phone'] }}">
                </div>
                <div class="single-form">
                    <label for="">Education</label>
                    <input type="text" name="education" placeholder="Shool/University/Profession" value="{{ $data['education']}}">
                </div>

            </div>
            <div class="col-xl-6">
                <div class="single-form">
                    <label for="">Address</label>
                    <textarea name="address">{{ isset($data['address']) ? $data['address'] : ''}}</textarea>
                </div>
                <div class="single-form">
                    <label for="input-file-now-custom-2">Photo</label>
                    <input accept="image/*" type='file' id="imgInp" name="photo"/>
                    <img id="blah" src="{{ $data['image'] }}" alt="your image" />
                </div>
            </div>
            <div class="col-12 text-right">
                <div class="single-form">
                    <button class="btn btn-primary btn-hover-dark w-100">Save</button>
                </div>
                </form>
            </div>
        {{-- </div> --}}
    </div>

</div>
