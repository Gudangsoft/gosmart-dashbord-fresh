@if (isset($data['announcement']))
    <div class="modal fade" id="announcement">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body reviews-form">
                    <h3 class="modal-title mt-3">Info Update <i class="fa fa-bullhorn"></i></h3>
                    <div class="card mt-4 p-2" style="background-color: #198754;">
                        <h5 style="color:#fff;">{{ ucwords($data['announcement']->title) }}</h5>
                    </div>
                    <div class="card mt-2 p-2">
                        <h6>{!! $data['announcement']->content !!}</h6>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" style="border: 1px solid #198754; color:#198754; padding:5px; background-color:#fff;border-radius:5px;" data-dismiss="modal">close</button>
                </div>
            </div>
        </div>
    </div>
@endif
