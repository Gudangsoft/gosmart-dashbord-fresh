<div class="table-responsive">
    <div class="row mb-2">
        <div class="col-md-9">
        </div>
    </div>
    <table id="all-materi" class="table table-bordered table-hover" data-name="cool-table">
    <thead>
        <tr>
        <th>ID #</th>
        <th>Title</th>
        <th>Status</th>
        <th>Premium</th>
        <th>Created at</th>
        </tr>
    </thead>
    <tbody>
    @if (isset($data['content']['content']))
        @foreach($data['content']['content'] as $k=>$v)
        <tr>
            <td>{{$v['id']}}</td>
            <td>{{$v['title']}}</td>
            <td>{{$v['status']}}</td>
            @if($v['is_premium'] == true)
                <td><span class="label label-warning">premium</span></td>
            @else
                <td><span class="label label-danger">free</span></td>
            @endif
            <td>{{$v['created_at']}}</td>
        </tr>
        @endforeach
    @endif

    </tbody>
    </table>
</div>
