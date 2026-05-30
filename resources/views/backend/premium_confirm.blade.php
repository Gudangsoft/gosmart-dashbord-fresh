@extends('backend.layouts.master')
@section('content')
<div class="content-header sty-one">
    <h1 class="text-black">Premium Member</h1>
    <ol class="breadcrumb">
        <li><a href="#">Dashboard</a></li>
        <li class="sub-bread"><i class="fa fa-angle-right"></i> Premium member</li>
    </ol>
</div>

<!-- Main content -->
<div class="content">
    <div class="info-box">
        <h4 class="text-black">Data Export</h4>
        <p>Export data to Copy, CSV, Excel, PDF & Print</p>
        @if(Session::has('sukses'))
        <div class="alert alert-success" role="alert">{{session()->get('sukses')}}  </div>
        @endif
        @if(Session::has('hidden'))
        <div class="alert alert-success" role="alert">Data berhasil dihidden  </div>
        @endif
        @if(Session::has('delete'))
        <div class="alert alert-success" role="alert">Data berhasil dihapus  </div>
        @endif
        <div class="table-responsive">
            <table id="premium-confirm" class="table table-bordered table-hover" data-name="cool-table">
            <thead>
                <tr>
                <th>Kelas</th>
                <th>Full Name</th>
                <th>Email</th>
                <!-- <th>Subject</th> -->
                <th>Status</th>
              
                <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
            @if ($rows == false)
                <tr>
                    <td colspan="6">Belum ada permintaan kelas</td>
                </tr>
            @else
            @foreach($rows as $row)
                <tr>
                <td>{{$row->getClass->name}}</td>
                <td>{{$row->getUser->name}}</td>
                <td>{{$row->getUser->email}}</td>
                <!-- <td>Sed cursus dapibus diam</td> -->
                @if($row->premium == true)
                    <td><span class="label label-success">SUCCESS</span></td>
                @elseif($row->premium == false)
                    <td><span class="label label-default">PENDING</span></td>
                @endif
               
                <td>
                    <div class="btn-group m-1">
                        <button type="button" class="btn btn-sm btn-primary">
                           confirm
                        </button>
                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> <span class="sr-only">Toggle Dropdown</span> </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/dashboard/premium_change/1/{{$row->id}}">SUCCESS</a></li>
                            <li><a href="/dashboard/premium_change/0/{{$row->id}}">PENDING</a></li>
                        </ul>
                    </div>
                </td>
                </tr>
            @endforeach
            @endif
            </tbody>
            <!-- <tfoot>
                <tr>
                <th>ID #</th>
                <th>Opended by</th>
                <th>Cust.Email</th>
                <th>Subject</th>
                <th>Status</th>
                <th>Assign to</th>
                <th>Date</th>
                </tr>
            </tfoot> -->
            </table>
        </div>
    </div>
</div>
    <!-- /.content -->


@endsection
