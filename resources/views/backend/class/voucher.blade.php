<div class="info-box">
    <div class="mb-2">
        <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#add-voucher-custom"> <i class="fa fa-plus"></i>&nbsp;&nbsp;Custom Code</button>
        <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#add-voucher"> <i class="fa fa-plus"></i>&nbsp;&nbsp;Random Code</button>
    </div>
    <div class="table-responsive">
        <table id="channel" class="table table-bordered table-hover" data-name="cool-table">
            <thead>
                <tr>
                    <th>CODE</th>
                    <th>STATUS</th>
                    <th>DISKON</th>
                    <th>MASA AKTIF</th>
                    <th>OPSI</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($data['voucher']))
                    @foreach ($data['voucher'] as $k=>$v)
                        <tr>
                            <td>{{ $v->code }}</td>
                            <td>
                                @if ($v->status == 1)
                                    <span class="label label-success">ACTIVE</span>
                                @elseif ($v->status == 2)
                                    <span class="label label-primary">USE</span>
                                @else
                                    <span class="label label-danger">EXPIRED</span>
                                @endif
                            </td>
                            <td>Rp {{ number_format($v->discount) }}</td>
                            <td>
                                @php
                                    $now[$k] = \Carbon\Carbon::parse($v->updated_at);
                                    $to[$k]  = \Carbon\Carbon::parse($v->expired_at);
                                    $days[$k] = $now[$k]->diffInDays($to[$k]);
                                @endphp
                                {{ $days[$k] }} Hari
                            </td>
                            <td>
                                <div class="btn-group m-1">
                                    <a href="#" title="edit" class="btn btn-sm btn-success p-2" data-toggle="modal" data-target="#edit{{ $v->id }}"><i class="fa fa-pencil"></i></a>
                                    {{-- <a href="" class="btn btn-sm {{ $v['status'] == 'p' ? 'btn-warning':'btn-dark'}} p-2"><i class="fa {{ $v['status'] == 'p' ? 'fa-check':'fa-remove'}}"></i></a> --}}
                                    <a href="{{ route('voucher.delete', $v->id) }}" title="delete" class="btn btn-sm btn-danger p-2"  onclick="return confirm('Menghapus dapat menghilangkan semua data terkait   . Yakin hapus ?')"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        @include('backend.class.modal-voucher-action')
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@include('backend.class.modal-voucher')
