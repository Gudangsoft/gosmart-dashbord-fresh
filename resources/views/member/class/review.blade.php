@extends('member.layouts.master')
@section('content')
@include('member.layouts.banner')
<div class="section section-padding">
    <div class="container">
        <div class="section section-padding mt-n10">
            <div class="container">
                <div class="row">
                    @if(Session::has('msg'))
                        <div class="col-12">
                            <div class="modal" id="nextAlert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        {{-- <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">G-Academy</h5>

                                        </div> --}}
                                        <div class="modal-body text-center">
                                            <h3>Review berhasil ditambahkan</h3>
                                                <p>
                                                    Terimakasih sudah memberi bintang dan tanggapan, terus belajar dan ikuti g-academy.
                                                </p>
                                        </div>
                                        <div class="modal-footer text-center">
                                            <a href="{{ config('app.url') }}/learning/content/{{ $data['materi_slug'] }}" class="btn btn-dark btn-block">Kembali Materi</a>
                                            <a href="{{ config('app.url') }}/class/{{ $data['class_slug'] }}" class="btn btn-primary btn-block">Kembali Kelas</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-12">
                            <form action="{{route('end_materi')}}" method="POST">
                            @csrf
                            <p>
                                <h6>Halo, {{ucfirst(auth()->user()->name)}}</h6>
                                <p>
                                    Kamu telah menyelesaikan semua materi dari kelas <strong>{!!$data['class_name']!!}</strong>.
                                    Review kelas ini dengan dengan mengirimkan bintang dan ulasan dibawah ini : <br>
                                    <div class="form-group text-center" id="rating-ability-wrapper">
                                        <label class="control-label" for="rating">
                                        <span class="field-label-header">Seberapa menarik materi ini ?</span><br>
                                        <span class="field-label-info"></span>

                                        <input type="hidden" id="selected_rating" name="selected_rating" value="" required="required">
                                        </label>
                                        <h2 class="bold rating-header" style="">
                                        <span class="selected-rating">0</span><small> / 5</small>
                                        </h2>
                                        <button type="button" class="btnrating btn btn-default btn-lg" data-attr="1" id="rating-star-1">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </button>
                                        <button type="button" class="btnrating btn btn-default btn-lg" data-attr="2" id="rating-star-2">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </button>
                                        <button type="button" class="btnrating btn btn-default btn-lg" data-attr="3" id="rating-star-3">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </button>
                                        <button type="button" class="btnrating btn btn-default btn-lg" data-attr="4" id="rating-star-4">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </button>
                                        <button type="button" class="btnrating btn btn-default btn-lg" data-attr="5" id="rating-star-5">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <div class="single-form">
                                                    <textarea name="review_text" placeholder="Tulis ulasan anda" id="comment" autofocus></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </p>
                                <input type="hidden" name="materi_id" value="{{$data['materi_id']}}" required="required">
                                <input type="hidden" name="class_id" value="{{$data['class_id']}}" required="required">
                                <button class="btn btn-primary btn-block" type="submit">Konfirmasi</a>
                            </p>
                            </form>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
