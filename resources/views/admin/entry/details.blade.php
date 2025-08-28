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
            <div class="col-md-4">

              <div class="form-group">
                  <label>Agent Name: </label>
                  {{ $single->agent->name }}
              </div>

              <div class="form-group">
                  <label>RL No: </label>
                  {{ $single->rl_no }}
              </div>

              <div class="form-group">
                  <label>Country: </label>
                  {{ $single->country }}
              </div>

              <div class="form-group">
                  <label>Passenger Name: </label>
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
                  <label>Medical Report:</label>
                  {{ $single->medical_report }}
              </div>

              <div class="form-group">
                  <label>GCC Medical Report:</label>
                  {{ $single->gcc_medical_report }}
              </div>

              <div class="form-group">
                  <label>Note: </label>
                  {{ ($single->note) ? $single->note : 'N/A' }}
              </div>

            </div>

            <div class="col-md-4">
              <div class="form-group">
                  <label>MOFA NO: </label>
                  {{ ($single->mofa_no) ? $single->mofa_no : 'N/A' }}
              </div>

              <div class="form-group">
                  <label>Visa NO: </label>
                  {{ ($single->visa_no) ? $single->visa_no : 'N/A' }}
              </div>

              <div class="form-group">
                  <label>Visa Issued Date: </label>
                  {{ ($single->visa_issued_date) ? $single->visa_issued_date : 'N/A' }}
              </div>

              <div class="form-group">
                  <label>Finger And TTC Note: </label>
                  {{ ($single->finger_ttc_note) ? $single->finger_ttc_note : 'N/A' }}
              </div>

              <div class="form-group">
                  <label>Manpower Date: </label>
                  {{ ($single->manpower_date) ? $single->manpower_date : 'N/A' }}
              </div>
            </div>

            <div class="col-md-4">
              @if(($single->is_returned != 'YES') && ($single->status != 'MANPOWER'))
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
                    <span class="badge btn-primary">Ready to Delivery</span><br><br>
                  @elseif($single->status == 'DELIVERED')
                    <span class="badge btn-success">DELIVERED</span><br><br>
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