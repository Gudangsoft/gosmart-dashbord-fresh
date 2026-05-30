<div class="modal fade" id="edit{{ $v->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Voucher Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('voucher.update') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Jumlah voucher</label>
                    <input type="hidden" name="id" value="{{ $v->id }}" id="">
                    <input type="text" class="form-control" name="code" value="{{ $v->code }}" id="" placeholder="cth : 10" disabled>
                </div>
                <div class="form-group">
                    <label>Potongan harga</label>
                    <input type="text" class="form-control" name="discount" value="{{ $v->discount }}" id="" placeholder="cth : 5000">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
