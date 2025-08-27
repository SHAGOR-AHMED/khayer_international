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
                <form action="{{ route('embassy.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                  <div class="form-group">
                      <label for="Name">MOFA NO <span class="text-red">*</span></label>
                      <input type="text" class="form-control" name="mofa_no" placeholder="Enter MOFA NO" value="" required>
                      <span class="text-danger">{{ $errors->has('mofa_no') ? $errors->first('mofa_no') : '' }}</span>
                  </div>

                  <div class="form-group">
                      <label for="password">VISA NO<span class="text-red">*</span></label>
                      <input type="text" class="form-control" name="visa_no" placeholder="Enter VISA NO" value="" required>
                      <span class="text-danger">{{ $errors->has('visa_no') ? $errors->first('visa_no') : '' }}</span>
                  </div>

                  <div class="form-group">
                      <label for="password">Visa Issued Date<span class="text-red">*</span></label>
                      <input type="text" class="form-control datepicker" name="visa_issued_date" placeholder="Enter Visa Issued Date" value="" required>
                      <span class="text-danger">{{ $errors->has('visa_issued_date') ? $errors->first('visa_issued_date') : '' }}</span>
                  </div>

                  <div class="form-group">
                      <label>Finger And TTC Note<span class="text-red">*</span></label>
                      <textarea class="form-control" name="finger_ttc_note" placeholder="Finger And TTC Note" required></textarea>
                      <span class="text-danger">{{ $errors->has('finger_ttc_note') ? $errors->first('finger_ttc_note') : '' }}</span>
                  </div>

                  <input type="hidden" name="id" value="<?php echo $single->id; ?>"  />

                  <div>
                    <button style="width:100%" type="submit" name="submit" class="btn btn-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update Data</button>
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