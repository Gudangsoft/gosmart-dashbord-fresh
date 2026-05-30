@extends('backend.layouts.master')
@section('content')
@include('sweetalert::alert')
<div class="content-header sty-one">
    <h1 class="text-black">Event</h1>
    <ol class="breadcrumb">
    <li><a href="/dashboard">Dashboard</a></li>
    <li class="sub-bread"><i class="fa fa-angle-right"></i> Event</li>
    </ol>
</div>

<!-- Main content -->
<div class="content">
    <div class="info-box">
        <livewire:event></livewire:event>
    </div>
</div>
@push('script')
    <script>
        window.addEventListener('openModalDetail', event => {
            $("#detail-event").modal('show');
        });
        window.addEventListener('openModalEdit', event => {
            $("#edit-event").modal('show');
        });
        window.addEventListener('openModalDelete', event => {
            $("#delete-event").modal('show');
        });
        window.addEventListener('closeModalEdit', event => {
            $("#edit-event").modal('hide');
        });

        window.addEventListener('closeModalEvent', event => {
            $("#add-event").modal('hide');
        });

        window.addEventListener('openModalDetailLink', event => {
            $("#detail-event-link").modal('show');
        });
        window.addEventListener('openModalEditLink', event => {
            $("#edit-event-link").modal('show');
        });
        window.addEventListener('openModalDeleteLink', event => {
            $("#delete-event-link").modal('show');
        });
        window.addEventListener('closeModalEditLink', event => {
            $("#edit-event-link").modal('hide');
        });

        window.addEventListener('closeModalEventLink', event => {
            $("#add-event-link").modal('hide');
        });
    </script>
@endpush
@endsection
