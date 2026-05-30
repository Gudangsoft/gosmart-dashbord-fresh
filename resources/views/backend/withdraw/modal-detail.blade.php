<div class="modal fade" id="modalDetail{{ $v->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="content">
                    <div class="m-b-3">

                        <div class="row mt-2">
                            <div class="col">
                                <table class="table table-striped">
                                    <tr>
                                        <td><strong>NAMA</strong></td>
                                        <td><strong>BANK</strong></td>
                                        <td><strong>NO REKENING</strong></td>
                                        <td><strong>JUMLAH</strong></td>
                                        <td><strong>KET</strong></td>
                                    </tr>
                                    <tr>
                                        <td>{{ $v->user->name }}</td>
                                        <td>{{ $v->getpayment->bank_name }}</td>
                                        <td><strong>{{ $v->getpayment->no_rekening }}</strong></td>
                                        <td><strong>{{ 'Rp '.number_format($v->withdraw_total,0,',','.') }}</strong></td>
                                        <td>{!! $v->description !!}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="callout callout-warning" style="margin-bottom: 0!important;">
                            <h4><i class="fa fa-info"></i> Petujuk:</h4>
                                <ol>
                                    <li>Siapkan alat pembayaran</li>
                                    <li>Admin dapat melakukan transfer ke rekening <span class="btn btn-sm btn-dark">{{ $v->getpayment->no_rekening }}</span></li>
                                    <li>Masukan nominal transfer sebesar <span class="btn btn-sm btn-dark">{{ 'Rp '.number_format($v->withdraw_total,0,',','.') }}</span></li>
                                    <li>Klik konfirmasi jika transfer berhasil</li>
                                    <li>Atau Laporankan transfer berhasil kepada user melalui chat <a href="https://wa.me/{{ $v->user->phone }}/?text=Halo%20saya%20{{ isset(auth()->user()->name) ? auth()->user()->name : null}},%20Administrator%20dari%20G-Academy.net%0A%0ASaya%20ingin%20memberitahukan%20bahwa%20penarikan%20dana%20atas%20nama%20{{ $v->user->name }}%20sebesar%20{{ 'Rp '.number_format($v->withdraw_total,0,',','.') }}%20telah%20berhasil%20kami%20proses%0A%0AMohon%20cek%20kembali%20melalui%20dashboad%20dan%20rekening%20anda.%0A%0ATerimakasih." class="btn btn-sm btn-success"><i class="fa fa-whatsapp"></i> whatsapp</a></li>
                                </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
