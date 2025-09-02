@extends('admin.layout.default')
@section('title')
  Entry Details Information
@endsection
@section('content')

  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Entry Details Information</h3>
          <div class="box-tools pull-right">
            <a href="{{ route('entry.index') }}" class="btn btn-success">View All</a>
          </div>
        </div>
        <div class="box-body">
        
          <div class="row">
            
            @include('admin.common.details')
            
            <div class="col-md-4">

              @if($single->status == 'DELIVERED')
                <div class="form-group">
                  <h1 style="color:green;">This Application has been DELIVERED </h1>
                </div>
                <div class="form-group">
                  <label>Delivered Date: </label>
                  {{ $single->delivered_date }}
                </div>
              @else

                @if(($single->is_returned != 'YES') && ($single->status != 'MANPOWER') && ($single->status != 'COLLECT') )
                  <form action="{{ route('entry.return_application') }}" method="post" enctype="multipart/form-data">
                  @csrf
                    <div class="form-group">
                        <label>Return Cause <code>(Only If Return The Application)</code> </label>
                        <textarea class="form-control" name="return_cause" placeholder="Enter Return Cause" required></textarea>
                        <span class="text-danger">{{ $errors->has('return_cause') ? $errors->first('return_cause') : '' }}</span>
                    </div>

                    <input type="hidden" name="id" value="<?php echo $single->id; ?>"  />

                    <div>
                      <button style="width:100%" type="submit" name="submit" class="btn btn-success"><i class="fa fa-bookmark" aria-hidden="true"></i> Save Data</button>
                    </div>
                  </form>
                @else
                  @if($single->is_returned == 'YES')
                    <div class="form-group">
                      <h1 style="color:#ff0000;">This Application has been RETURNED </h1>
                    </div>
                    <div class="form-group">
                      <label>Return Cause: </label>
                      {{ $single->return_cause }}
                    </div>
                  @else
                    @if($single->status == 'MANPOWER')
                      <h3>Current Status: </h3><span class="badge btn-warning">MANPOWER</span><br><br>
                    @elseif($single->status == 'COLLECT')
                      <h3>Current Status: </h3><span class="badge btn-primary">Ready to Delivery</span><br><br>
                    @endif
                  @endif
                @endif
              
                
              @endif

            </div>

          </div>
        
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
@endsection