@extends('layouts.admin')

@section('content')

<div id="content-wrapper">
  <div class="container-fluid pb-0">
     <div class="video-block section-padding">
        <div class="row">
           <div class="col-md-12">
              <div class="main-title">
                 <div class="btn-group float-right right-action">
                    <a href="#" class="right-action-link text-gray" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Sort by <i class="fa fa-caret-down" aria-hidden="true"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                       <a class="dropdown-item" href="#"><i class="fas fa-fw fa-star"></i> &nbsp; Top Rated</a>
                       <a class="dropdown-item" href="#"><i class="fas fa-fw fa-signal"></i> &nbsp; Viewed</a>
                       <a class="dropdown-item" href="#"><i class="fas fa-fw fa-times-circle"></i> &nbsp; Close</a>
                    </div>
                 </div>
                 <h6>Channels</h6>
              </div>
           </div>
           

                  </div>
                </div>
                
                
                <!-- /.box-header -->
                
                
               <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header"><i class="fa fa-table"></i> Data Table Example</div>
                <div class="card-body">
                  <div class="table-responsive">
                  <table id="default-datatable" class="table table-bordered">
                    <thead>
                    <tr>
                      <th>id</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Email Verifed</th>
                      <th>Created</th>
                      <th>action</th>
                    </tr>
                  </thead>
                  @foreach ($user as $row)
                  <tbody>
                    <tr>
                      <td>{{$row->id}}</td>
                      <td>{{$row->name}}</td>
                      <td>{{$row->email}}</td>
                      <td>{{$row->email_verified_at}}</td>
                      <td>{{$row->created_at}}</td>
                        <td> <a href="{{('/gudangsoftnet/user')}}/{{$row->id}}" class="btn btn-danger btn-sm mt-1" onclick="return confirm('Yakin mau dihapus')">Delete</a></td>
                    </tfoot>
                  </tr>
                  @endforeach
                </table>
                </div>
                </div>
                </div>
                </div>
                </div>

          
                    


          
            
@endsection
