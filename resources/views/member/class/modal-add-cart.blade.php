<div class="modal fade" id="cartSuccessModal{{ $data['detail']['class']['id'] }}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sukses</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Kelas {{ ucwords($data['detail']['class']['title']) }} telah berhasil ditambahkan ke dalam keranjang
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="cartFailed">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger">Gagal</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Kelas {{ ucwords($data['detail']['class']['title']) }} sudah ada atau dimiliki
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
