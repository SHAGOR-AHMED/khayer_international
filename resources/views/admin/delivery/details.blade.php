@extends('admin.layout.default')
@section('title')
  Details Information
@endsection
@section('content')

  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Details Information</h3>
          <div class="box-tools pull-right">
          </div>
        </div>
        <div class="box-body">
        
          <div class="row">
            <div class="col-md-6">

              <div class="form-group">
                  <label for="type">Agent: </label>
                  {{ $single->agent->name }}
              </div>

              <div class="form-group">
                  <label for="type">RL No: </label>
                  {{ $single->rl_no }}
              </div>

              <div class="form-group">
                  <label for="type">Country: </label>
                  {{ $single->country }}
              </div>

              <div class="form-group">
                  <label for="type">Passenger: </label>
                  {{ $single->user->name }}
              </div>

              <div class="form-group">
                  <label for="Name">Kopil No:</label>
                  {{ $single->kopil_no }}
              </div>

              <div class="form-group">
                  <label for="password">PC Ref No:</label>
                  {{ $single->pc_ref_no }}
              </div>

              <div class="form-group">
                  <label for="type">Medical Report:</label>
                  {{ $single->medical_report }}
              </div>

              <div class="form-group">
                  <label for="type">GCC Medical Report:</label>
                  {{ $single->gcc_medical_report }}
              </div>

              <div class="form-group">
                  <label>Note: </label>
                  {{ $single->note }}
              </div>

            </div>

            <div class="col-md-6">
              @if($single->is_returned != 'YES')
                <form action="{{ route('delivery.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                  
                  <div class="form-group">
                      <label for="password">Delivered Date<span class="text-red">*</span></label>
                      <input type="text" class="form-control datepicker" name="delivered_date" placeholder="Enter Delivered Date" value="" required>
                      <span class="text-danger">{{ $errors->has('delivered_date') ? $errors->first('delivered_date') : '' }}</span>
                  </div>

                  <input type="hidden" name="id" value="<?php echo $single->id; ?>"  />

                  <div>
                    <button style="width:100%" type="submit" name="submit" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update Data</button>
                  </div>
                </form>
              @else
                <div class="form-group">
                  <h1 style="color:#ff0000;">This Application has been RETURNED </h1>
                </div>
                <div class="form-group">
                  <label>Return Cause: </label>
                  {{ $single->return_cause }}
                </div>
              @endif
            </div>

          </div>
        
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
@endsection