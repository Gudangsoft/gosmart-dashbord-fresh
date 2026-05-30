<div>
    @if ($type == 'link')
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputuname">Judul</label>
                    <div class="input-group">
                        <input class="form-control" id="exampleInputuname" type="text" wire:model="title">
                    </div>
                    @if ($errors->has('title'))
                        <p class="text-danger">{{ $errors->first('title') }}</p>
                    @endif
                </div>


                <div class="form-group">
                    <label for="pwd1">Link Event</label>
                    <div class="input-group">
                        <input class="form-control" id="partisipan" placeholder="" type="text"  wire:model="link" name="">
                    </div>
                    @if ($errors->has('link'))
                        <p class="text-danger">{{ $errors->first('link') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Berbayar</label>
                    <select name="" id="" class="form-control" wire:model="premium">
                        <option value="2">TIDAK</option>
                    <option value="1">YA</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pwd1">Biaya</label>
                    <div class="input-group">
                        <input class="form-control" id="price" placeholder="" type="number"  wire:model="price" name="">
                    </div>

                    @if ($errors->has('price'))
                        <p class="text-danger">{{ $errors->first('price') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label>Photo</label>
                    <div class="col">
                        <i for="input-file-now">Max file size 5 MB</i>
                        <input type="file" wire:model="image" name="photo" id="input-file-now" accept="image/*" class="dropify" data-default-file=""/>
                    </div>
                    @if ($errors->has('image'))
                        <p class="text-danger">{{ $errors->first('image') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="pwd1">Time</label>
                    <div class="input-group">
                        <input class="form-control"type="datetime-local" wire:model="time" name="">
                    </div>
                    @if ($errors->has('time'))
                        <p class="text-danger">{{ $errors->first('time') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="pwd1">Berakhir</label>
                    <div class="input-group">
                        <input class="form-control"type="datetime-local" wire:model="endTime" name="">
                    </div>
                    @if ($errors->has('time'))
                        <p class="text-danger">{{ $errors->first('endTime') }}</p>
                    @endif
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block mt-2" wire:click.prevent="store()">Simpan</button>
    @else
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputuname">Judul</label>
                    <div class="input-group">
                        <input class="form-control" id="exampleInputuname" type="text" wire:model="title">
                    </div>
                    @if ($errors->has('title'))
                        <p class="text-danger">{{ $errors->first('title') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Deskripsi</label>
                    <div class="input-group">
                        <textarea wire:model="description" id="" rows="6" class="form-control"></textarea>
                    </div>
                    @if ($errors->has('description'))
                        <p class="text-danger">{{ $errors->first('description') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Berbayar</label>
                    <select name="" id="" class="form-control" wire:model="premium">
                        <option value="2">TIDAK</option>
                    <option value="1">YA</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pwd1">Biaya</label>
                    <div class="input-group">
                        <input class="form-control" id="price" placeholder="" type="number"  wire:model="price" name="">
                    </div>

                    @if ($errors->has('price'))
                        <p class="text-danger">{{ $errors->first('price') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <div class="panel-heading mt-2" role="tab" id="headingTen">
                        <label class="btn btn-sm btn-default"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTen" aria-expanded="false" aria-controls="collapseTen">Pembayaran <i class="fa fa-credit-card"></i></a> </label>
                    </div>
                    <div class="panel-body">
                        <input placeholder="Nama Bank" wire:model="bankName" class="form-control form-control-line mb-2" type="text">
                        <input placeholder="Nomor Rekening" wire:model="noRekening" class="form-control form-control-line mb-2" type="number">
                        <input placeholder="Nama Pemilik" wire:model="ownerName" class="form-control form-control-line" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label for="pwd1">Link Group (WA/TELEGRAM)</label>
                    <div class="input-group">
                        <input class="form-control" id="partisipan" placeholder="" type="text"  wire:model="link" name="">
                    </div>
                    @if ($errors->has('link'))
                        <p class="text-danger">{{ $errors->first('link') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="pwd1">Kontak Whatsapp Aktif</label>
                    <div class="input-group">
                        <input class="form-control" id="contact" placeholder="" type="number"  wire:model="contact" name="">
                    </div>
                    @if ($errors->has('contact'))
                        <p class="text-danger">{{ $errors->first('contact') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="pwd1">Partisipan Maksimal</label>
                    <div class="input-group">
                        <input class="form-control" id="partisipan" placeholder="" type="number"  wire:model="participant" name="">
                    </div>
                    @if ($errors->has('participant'))
                        <p class="text-danger">{{ $errors->first('participant') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label>Photo</label>
                    <div class="col">
                        <i for="input-file-now">Max file size 5 MB</i>
                        <input type="file" wire:model="image" name="photo" id="input-file-now" class="dropify" data-default-file=""/>
                    </div>
                    @if ($errors->has('image'))
                        <p class="text-danger">{{ $errors->first('image') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="pwd1">Time</label>
                    <div class="input-group">
                        <input class="form-control"type="datetime-local" wire:model="time" name="">
                    </div>
                    @if ($errors->has('time'))
                        <p class="text-danger">{{ $errors->first('time') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="pwd1">Berakhir</label>
                    <div class="input-group">
                        <input class="form-control"type="datetime-local" wire:model="endTime" name="">
                    </div>
                    @if ($errors->has('time'))
                        <p class="text-danger">{{ $errors->first('endTime') }}</p>
                    @endif
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block mt-2" wire:click.prevent="store()">Simpan</button>
    @endif
</div>
