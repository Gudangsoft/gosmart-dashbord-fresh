@extends('backend.layouts.master')
@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header sty-one">
      <h1 class="text-black">Semua Materi</h1>
      <ol class="breadcrumb">
        <li><a href="#">Dashboard</a></li>
        <li class="sub-bread"><i class="fa fa-angle-right"></i> Materi</li>
      </ol>
    </div>

    <div class="content">
        <div class="info-box">
        <h4 class="text-black">Editable with Datatable</h4>
        <div id="basicscenario"></div>
        </div>

        <div class="info-box">
        <h4 class="text-black">Static Data</h4>
        <div id="staticdata"></div>
        </div>

        <div class="info-box">
        <h4 class="text-black">Soarting</h4>
        <div class="col-md-2 row">
                                      <select id="sortingField" class="custom-select form-control input-sm m-b-10">
                                          <option>Name</option>
                                          <option>Age</option>
                                          <option>Address</option>
                                          <option>Country</option>
                                          <option>Married</option>
                                      </select>
                                  </div>
                                  <div id="soarting"></div>
        </div>


    </div>


<!-- /.content -->
@endsection
