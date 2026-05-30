<div class="modal fade" id="edit-event" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputuname">Judul</label>
                            <div class="input-group">
                                <input class="form-control" id="exampleInputuname" type="text" wire:model.defer="title">
                            </div>
                            @if ($errors->has('title'))
                                <p class="text-danger">{{ $errors->first('title') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Deskripsi</label>
                            <div class="input-group">
                                <textarea wire:model.defer="description" id="" rows="6" class="form-control"></textarea>
                            </div>
                            @if ($errors->has('description'))
                                <p class="text-danger">{{ $errors->first('description') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Berbayar</label>
                            <select name="" id="" class="form-control" wire:model.defer="premium">
                                <option value="2">TIDAK</option>
                                <option value="1">YA</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pwd1">Biaya</label>
                            <div class="input-group">
                                <input class="form-control" id="price" placeholder="" type="number"  wire:model.defer="price" name="">
                            </div>
                            <label for="pwd1">Nama Bank</label>
                            <div class="input-group">
                                <input placeholder="Nama Bank" wire:model.defer="bankName" class="form-control form-control-line mb-2" type="text">
                            </div>
                            <label for="pwd1">Rekening</label>
                            <div class="input-group">
                                <input placeholder="Nomor Rekening" wire:model.defer="noRekening" class="form-control form-control-line mb-2" type="number">
                            </div>
                            <label for="pwd1">Pemilik</label>
                            <div class="input-group">
                                <input placeholder="Nama Pemilik" wire:model.defer="ownerName" class="form-control form-control-line" type="text">
                            </div>

                            @if ($errors->has('price'))
                                <p class="text-danger">{{ $errors->first('price') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="pwd1">Link Group (WA/TELEGRAM)</label>
                            <div class="input-group">
                                <input class="form-control" id="partisipan" placeholder="" type="text"  wire:model.defer="link" name="">
                            </div>
                            @if ($errors->has('link'))
                                <p class="text-danger">{{ $errors->first('link') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="pwd1">Kontak Whatsapp Aktif</label>
                            <div class="input-group">
                                <input class="form-control" id="contact" placeholder="" type="number"  wire:model.defer="contact" name="">
                            </div>
                            @if ($errors->has('contact'))
                                <p class="text-danger">{{ $errors->first('contact') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="pwd1">Partisipan Maksimal</label>
                            <div class="input-group">
                                <input class="form-control" id="partisipan" placeholder="" type="number"  wire:model.defer="participant" name="">
                            </div>
                            @if ($errors->has('participant'))
                                <p class="text-danger">{{ $errors->first('participant') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="pwd1">Time</label>
                            <div class="input-group">
                                <input class="form-control"type="datetime-local" wire:model.defer="time" name="">
                            </div>
                            @if ($errors->has('time'))
                                <p class="text-danger">{{ $errors->first('time') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="pwd1">Berakhir</label>
                            <div class="input-group">
                                <input class="form-control"type="datetime-local" wire:model.defer="endTime" name="">
                            </div>
                            @if ($errors->has('time'))
                                <p class="text-danger">{{ $errors->first('endTime') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block mt-2" wire:click.prevent="update()">Simpan</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="detail-event" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{!! $title !!}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card mb-2">
                    <div class="card-body">
                        <img src="{{ asset('events-images/'.$image) }}">
                    </div>
                </div>
                <div class="card mb-2">
                    <div class="card-body">
                        <p><strong>Waktu :</strong></p>
                        {{ $time }} | {{ $hour }} - {{ $endTime }} | {{ $endHour }}
                    </div>
                </div>
                @if ($price != null)
                    <div class="card mb-2">
                        <div class="card-body">
                            <p><strong>Biaya :</strong></p>
                            Rp {{ number_format($price) }}
                        </div>
                    </div>
                @endif
                <div class="card mb-2">
                    <div class="card-body">
                        <p><strong>Partisipan :</strong></p>
                        {{ $count_registed }}
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <p><strong>Keterangan :</strong></p>
                        {!! $description !!}
                    </div>
                    <div class="card-body">
                        <p><strong>Link :</strong></p>
                        {{  $link  }}
                    </div>
                </div>
                <a href="/dashboard/events/{{ $event_id }}" class="btn btn-success btn-block mt-2">Peserta</a>
                <button type="submit" class="btn btn-default btn-block mt-2" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
