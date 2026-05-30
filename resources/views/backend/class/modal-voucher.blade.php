<div class="modal fade" id="add-voucher-custom" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Voucher Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('voucher.custom') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Code</label>
                    <input type="hidden" name="class_id" value="{{ $data['data']['class']['id'] }}" id="">
                    <input type="text" class="form-control" name="voucher_code" value="" id="" placeholder="PROMOCODE">
                </div>
                <div class="form-group">
                    <label>Potongan harga</label>
                    <input type="text" class="form-control" name="discount" value="" id="" placeholder="cth : 5000">
                </div>
                <div class="form-group">
                    <label>Masa berlaku</label>
                    <input type="datetime-local" class="form-control" name="expired" value="" id="" placeholder="Masa aktif">
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
<div class="modal fade" id="add-voucher" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Voucher Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('voucher.store') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Jumlah voucher</label>
                    <input type="hidden" name="class_id" value="{{ $data['data']['class']['id'] }}" id="">
                    <input type="text" class="form-control" name="voucher_total" value="" id="" placeholder="cth : 10">
                </div>
                <div class="form-group">
                    <label>Potongan harga</label>
                    <input type="text" class="form-control" name="discount" value="" id="" placeholder="cth : 5000">
                </div>
                <div class="form-group">
                    <label>Masa berlaku</label>
                    <input type="datetime-local" class="form-control" name="expired" value="" id="" placeholder="Masa aktif">
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

