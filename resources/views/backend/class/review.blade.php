<div class="card-body">
    <div class="row">
        <div class="col">
            <div class="box box-primary">
              <!-- /.box-header -->
              <div class="box-body no-padding">
                <div class="mailbox-controls">
                  <!-- Check all button -->
                  <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i> </button>
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                  </div>
                  <!-- /.btn-group -->
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                  <div class="pull-right"> 1-50/200
                    <div class="btn-group">
                      <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                      <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                    </div>
                    <!-- /.btn-group -->
                  </div>
                  <!-- /.pull-right -->
                </div>
                <div class="table-responsive mailbox-messages">
                  <table class="table table-hover no-wrap table-striped">
                    <tbody>
                        <tr>
                            <td></td>
                            {{-- <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td> --}}
                            <td class="mailbox-name"><strong>Nama</strong></td>
                            <td class="mailbox-subject"><strong>Review</strong></td>
                            <td class="mailbox-attachment"><strong>Bintng</strong></td>
                        </tr>
                    @if (isset($data['review']['comment']))
                        @foreach ($data['review']['comment'] as $k=>$v)
                            <tr>
                                <td><input type="checkbox"></td>
                                {{-- <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td> --}}
                                <td class="mailbox-name">{{ $v['name'] }}</td>
                                <td class="mailbox-subject">{!! $v['text'] !!}</td>
                                <td class="mailbox-attachment">{{ $v['rating'] }}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                  </table>
                  <!-- /.table -->
                </div>
                <!-- /.mail-box-messages -->
              </div>
              <!-- /.box-body -->
              <div class="box-footer no-padding m-b-2">
                <div class="mailbox-controls">
                  <!-- Check all button -->
                  <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i> </button>
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                  </div>
                  <!-- /.btn-group -->
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                  <div class="pull-right"> 1-50/200
                    <div class="btn-group">
                      <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                      <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                    </div>
                    <!-- /.btn-group -->
                  </div>
                  <!-- /.pull-right -->
                </div>
              </div>
            </div>
            <!-- /. box -->
        </div>
    </div>
</div>
