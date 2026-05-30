@extends('member.layouts.master')
@section('content')
<div id="content-wrapper">
    <div class="container-fluid">
        <div class="video-block section-padding">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-title">
                        <div class="btn-group float-right right-action">

                        </div>
                        <h6>Kelas Belajar G-Academy</h6>
                    </div>
                </div>
                @foreach($class as $c)
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="category-item mt-0 mb-0">
                        <a href="/learning/class_detail/{{$c->class_id}}">
                            <img class="img-fluid" src="/home-images/kelas/{{$c->image}}" alt="">
                            <h6>{{ucfirst($c->name)}} <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Verified"><i class="fas fa-check-circle text-success"></i></span></h6>
                            <div class="channels-card-image-btn"><a href="#"><strong>IDR {{$c->price}}</strong></a></div>
                            <p>74,853 user</p>
                            <p>
                                {{-- <a href="/learning/class_detail/{{$c->class_id}}" class="btn btn-sm btn-dark border-none">FREE</a> --}}
                                <a href="/learning/get_class/premium/{{$c->class_id}}/{{auth()->user()->id}}" class="btn btn-sm btn-danger border-none"><i class="fas fa-unlock"></i> GET PREMIUM</a>
                            </p>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center pagination-sm mb-0">

                <li class="page-item"> {{$class->links()}}</li>

                </ul>
            </nav>
        </div>
    </div>
            <!-- /.container-fluid -->
    @include('member.layouts.footer')
    @if(Session::has('msg'))
    <div class="modal fade" id="alertPay" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">G-Academy</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                            <h6>Mohon maaf, anda sudah belangganan kalas ini.</h6>
                    </p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <!-- <button class="btn btn-primary" type="button">Ok</button> -->
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
