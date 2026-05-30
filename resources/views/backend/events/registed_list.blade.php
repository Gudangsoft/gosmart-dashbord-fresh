@extends('backend.layouts.master')
@section('content')
@include('sweetalert::alert')
<div class="content-header sty-one">
    <h1 class="text-black">Event</h1>
    <ol class="breadcrumb">
    <li><a href="/dashboard">Dashboard</a></li>
    <li class="sub-bread"><i class="fa fa-angle-right"></i> Event</li>
    <li class="sub-bread"><i class="fa fa-angle-right"></i> Peserta</li>
    </ol>
</div>

<!-- Main content -->
<div class="content">
    <div class="info-box">
        <div>
            <div class="table-responsive">
                <table id="example2" class="table table-bordered table-hover" data-name="cool-table">
                <thead>
                    <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>WhatsApp</th>
                    <th>Pekerjaan</th>
                    <th>ٍAction</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rows as $item)
                        <tr>
                            <td>{{ $item->username }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->whatsapp }}</td>
                            <td>{{ $item->profession }}</td>
                            <td>
                                <div class="btn-group m-1">
                                    <a href="#" title="detail" class="btn btn-sm btn-default p-2" data-toggle="modal" data-target="#detail-registed{{ $item->id }}"><i class="fa fa-eye"></i></a>
                                    <a href="{{ route('eventregister.delete', $item->id) }}" title="detail" class="btn btn-sm btn-danger text-white btn-default p-2"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        <div class="modal fade" id="detail-registed{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card mb-2">
                                            <div class="card-body">
                                                <p><strong>Username :</strong></p>
                                                {{ $item->username }}
                                            </div>
                                        </div>
                                        <div class="card mb-2">
                                            <div class="card-body">
                                                <p><strong>Email :</strong></p>
                                                {{ $item->email }}
                                            </div>
                                            <div class="card-body">
                                                <p><strong>Whatsapp :</strong></p>
                                                {{ $item->whatsapp }}
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <p><strong>Istitusi/Perusahaan :</strong></p>
                                                {{ $item->company }}
                                            </div>
                                            <div class="card-body">
                                                <p><strong>Pekerjaan :</strong></p>
                                                {{ $item->profession }}
                                            </div>
                                            <div class="card-body">
                                                <p><strong>Pendidikan :</strong></p>
                                                {{ $item->member_option }}
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-default btn-block mt-2" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection
