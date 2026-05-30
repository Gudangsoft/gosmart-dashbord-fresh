<div class="modal fade" id="modalCategoryEdit{{ $v->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" style="color:#222222;">Tambah Kategori</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form action="{{ route('category.update') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group has-feedback">
                        <label>Nama Kategori</label>
                        <div class="input-group">
                            <input class="form-control" name="id" type="hidden" value="{{ $v->id }}">
                            <input class="form-control" name="title" type="text" value="{{ $v->title }}" required>
                        </div>
                        <div style="margin-top: 3px;" id="CheckLimit"></div>
                        <fieldset class="form-group mt-2">
                            <textarea class="form-control" name="description_category_class" rows="3" placeholder="Keterangan singkat">{{ $v->description }}</textarea>
                        </fieldset>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-block">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
