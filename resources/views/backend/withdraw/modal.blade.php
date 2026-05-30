<div class="modal fade" id="modalWithdraw" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" style="color:#222222;">Masukan Jumlah</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form action="{{ route('withdraw.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group has-success has-feedback">
                        <div class="input-group">
                            <span class="input-group-addon">RP</span>
                            <input type="hidden" class="form-control" name="saldo" id="saldo" value="{{ $profile['total_income'] }}">
                            <input type="number" class="form-control" name="withdraw" id="withdraw" autofocus required>
                        </div>
                        {{-- <span class="fa fa-check form-control-feedback" aria-hidden="true"></span> <span id="inputGroupSuccess1Status" class="sr-only">(success)</span> --}}
                        <div style="margin-top: 3px;" id="CheckLimit"></div>
                        <fieldset class="form-group mt-2">
                            <textarea class="form-control" name="description_withdraw" id="descTextarea" rows="3" placeholder="Keterangan singkat"></textarea>
                        </fieldset>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" disabled id="btnWithdraw" class="btn btn-primary btn-block">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('#modalWithdraw').on('shown.bs.modal', function(){
        $('#withdraw').focus();
    });
</script>
