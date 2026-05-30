Hai {{ $name }},<br><br>

Apa kabar, semoga selalu dalam keadaan sehat selalu.<br><br>
Berikut adalah data infomasi event <strong>"{{ $event->title }}"</strong><br><br>
<table border="0">
    <tr>
        <td>Waktu</td>
        <td>: {{ $event->time }}</td>
    </tr>
    <tr>
        <td colspan="2">
            <p>Deskripsi :</p>
            <p>{!! $event->description !!}</p>
        </td>

    </tr>

    @if ($event->premium == 1)
        <tr>
            <td>
                
                <span class="font-weight-bold">Pembayaran event dapat melalui nomor rekening {{ $event->bank_name }} {{ $event->no_rekening }} a.n {{ $event->owner_name }} sebesar Rp {{ number_format($data['row']->price) }}</span>
                        
            </td>
        </tr>
        <tr>
            <td colspan="2"><strong>Penting !</strong> kirim bukti transfer/pembayaran melalui WhatApp di {{ $event->contact}} agar mendapatkan link untuk join.</td>
        </tr>
    @else
        <tr>
            <td>Link Join</td>
            <td>: <a href="{{ $event->url_meet }}">{{ $event->url_meet }}</a></td>
        </tr>
    @endif
</table>
<br><br>
Terimakasih, <br>
Admin G-Academy
