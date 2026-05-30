@extends('member.layouts.dashboard')
@include('sweetalert::alert')
@section('content')
<div class="section overflow-hidden position-relative" id="wrapper">

    @include('member.dashboard.sidebar-menu')

    <div class="page-content-wrapper py-0">

        @include('member.profile.tab-menu')

        <div class="main-content-wrapper">
            <div class="container-fluid">

                <h3 class="title">Edit <span>karya saya</span></h3>
                <div class="flex-wrap">
                        <p>Tunjukan karyamu untuk menarik calon perusahaanmu</p>
                        @if(Session::has('msg'))
                            <div class="message">
                                <div class="message-icon">
                                    <img src="{{asset('assets')}}/images/menu-icon/icon-6.png" alt="">
                                </div>
                                <div class="message-content">
                                    <p>{{ session()->get('msg') }}</p>
                                </div>
                            </div>
                        @endif
                        @if(Session::has('error'))
                            <div class="message bg-danger text-light">
                                <div class="message-icon">
                                    <img src="{{asset('assets')}}/images/menu-icon/icon-5.png" alt="">
                                </div>
                                <div class="message-content">
                                    <p>{{ session()->get('error') }}</p>
                                </div>
                            </div>
                        @endif

                        <div class="graph">
                            <div class="row">
                                    <div class="col-12">
                                        <form action="/learning/creation/update" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="single-form">
                                            <label for="">Judul</label>
                                            <input type="text" name="id" placeholder="Name" value="{{ $data['creation']->id }}" hidden>
                                            <input type="text" name="name" value="{{ $data['creation']->name }}">
                                        </div>
                                        <div class="single-form">
                                            <label for="">Url</label>
                                            <input type="link" name="url" placeholder="https://" value="{{ $data['creation']->url }}">
                                        </div>
                                        <div class="single-form">
                                            <label for="">Description</label>
                                            <textarea name="description">{!! $data['creation']->description !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 text-right">
                                        <div class="single-form">
                                            <button class="btn btn-primary btn-hover-dark w-100">Save</button>
                                        </div>
                                        </form>
                                    </div>
                            </div>
                        </div>

                </div>

            </div>
        </div>

    </div>

</div>

@endsection
