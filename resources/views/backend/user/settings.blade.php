<div class="tab-pane active" id="settings" role="tabpanel">
    <div class="card-body">
        @if($errors->any())
            @foreach($errors->all() as $error)
            <div class="alert alert-danger" role="alert"> {{$error}} </div>
            @endforeach
        @endif
        <form action="/dashboard/profile_setting" method="POST" enctype="multipart/form-data" class="form-horizontal form-material">
            @csrf
            <div class="form-group">
                <label class="col-md-12">Full Name</label>
                <div class="col-md-12">
                <input value="{{$profile['name']}}" name="fullname" class="form-control form-control-line" type="text" required>
                </div>
            </div>
            <div class="form-group">
                <label for="example-email" class="col-md-12">Email</label>
                <div class="col-md-12">
                <input value="{{$profile['email']}}" name="email" class="form-control form-control-line" name="example-email" id="example-email" type="email" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12">Phone No <small><i>(Whatsapp Recommended)</i></small></label>
                <div class="col-md-12">
                <input value="{{$profile['phone']}}" name="phone" class="form-control form-control-line" type="text" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12">Photo</label>
                <div class="col-md-12">
                    <i for="input-file-now">Gambar dengan ukuran 1080 x 1080 pixel atau square 1:1 sangat direkomendasikan</i>
                    <input type="file" name="photo" id="input-file-now" class="dropify" data-default-file="{{ $profile['photo'] }}"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12 mt-3">TTD E-Certificate</label>
                <div class="col-md-12">
                    <i for="input-file-now">* Maksimal 1280 x 766 pixel</i>
                    <input type="file" name="signature" id="input-file-now" class="dropify" data-default-file="/{{ isset($data['signature_url']) ? $data['signature_url'] : ''}}"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12">Education</label>
                <div class="col-md-12">
                <input value="{{ $profile['education'] ? $profile['education'] : old('education') }}" name="education" class="form-control form-control-line" type="text">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12">Bio</label>
                <div class="col-md-12">
                    <textarea class="form-control" name="description">{!!$profile['bio'] ? $profile['bio'] : old('description')!!}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12">Address</label>
                <div class="col-md-12">
                    <textarea name="address" rows="6" class="form-control form-control-line">{{$profile['address']}}</textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <div class="panel-heading" role="tab" id="headingTen">
                        <label class="btn btn-sm btn-default"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTen" aria-expanded="false" aria-controls="collapseTen">Add Payment <i class="fa fa-plus"></i></a> </label>
                    </div>
                    <div id="collapseTen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTen">
                        <div class="panel-body">
                            <input placeholder="Nama Bank" value="{{$profile['bank']}}" name="bank" class="form-control form-control-line mb-2" type="text">
                            <input placeholder="Nomor Rekening" value="{{$profile['no_rekening']}}" name="no_rekening" class="form-control form-control-line mb-2" type="number">
                            <input placeholder="Nama Pemilik" value="{{$profile['owner_name']}}" name="owner_name" class="form-control form-control-line" type="text">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                <button class="btn btn-success">Update Profile</button>
                </div>
            </div>
        </form>
    </div>
</div>
