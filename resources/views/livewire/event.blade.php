<div>
    <x-livewire-alert::scripts />

    <div class="mb-2">
        <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#add-event"> <i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah Event</a>
        <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#add-event-link"> <i class="fa fa-link"></i>&nbsp;&nbsp;Tambah Link</a>
    </div>
    <div class="modal fade" id="add-event" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @livewire('event-create', ['type' => null])
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add-event-link" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Link Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @livewire('event-create', ['type' => 'link'])
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table id="example2" class="table table-bordered table-hover" data-name="cool-table">
        <thead>
            <tr>
            <th>Judul</th>
            <th>Premium</th>
            <th>Biaya</th>
            <th>Register</th>
            <th>Add By</th>
            <th>Created at</th>
            <th>ٍAction</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->premium == 1 ? 'premium' : 'free' }}</td>
                    <td>{{ number_format($item->price) }}</td>
                    <td>{{ number_format($item->count) }}</td>
                    <td>{{ $item->getUser->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->created_at)->isoFormat('dddd, d MMMM Y') }}</td>
                    <td>
                        <div class="btn-group m-1">
                            <a href="#" wire:click="detailEvent({{ $item->id }})" title="detail" class="btn btn-sm btn-default p-2"><i class="fa fa-eye"></i></a>
                            <a href="#" wire:click="editEvent({{ $item->id }})" title="edit" class="btn btn-sm btn-success p-2"><i class="fa fa-pencil"></i></a>
                            <a href="#" wire:click="deleteEvent({{ $item->id }})" title="delete" class="btn btn-sm btn-danger p-2"><i class="fa fa-trash"></i></a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
        </table>
    </div>
    @include('backend.events.modal')
</div>
