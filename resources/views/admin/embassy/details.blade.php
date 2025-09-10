@extends('admin.layout.default')
@section('title')
  Embassy Details Information
@endsection
@section('content')

  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Embassy Details Information</h3>
          <div class="box-tools pull-right">
            <a href="{{ route('embassy.index') }}" class="btn btn-success">View All</a>
          </div>
        </div>
        <div class="box-body">
        
          <div class="row">

            @include('admin.common.details')

            <div class="col-md-4">
              @if($single->is_returned != 'YES')
                <form action="{{ route('embassy.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                  
                  <div class="form-group">
                      <label for="password">VISA NO <span class="text-red">*</span></label>
                      <input type="text" class="form-control" name="visa_no" placeholder="Enter VISA NO" value="{{ $single->visa_no }}" required>
                      <span class="text-danger">{{ $errors->has('visa_no') ? $errors->first('visa_no') : '' }}</span>
                  </div>

                  <div class="form-group">
                      <label for="Name">ID NO</label>
                      <input type="text" class="form-control" name="id_no" placeholder="Enter ID NO" value="{{ $single->id_no }}">
                  </div>

                  <div class="form-group">
                      <label for="password">Wakala Date</label>
                      <input type="text" class="form-control datepicker" name="wakala_date" placeholder="Enter Wakala Date" value="{{ $single->wakala_date }}">
                  </div>

                  <div class="form-group">
                      <label for="Name">MOFA NO <span class="text-red">*</span></label>
                      <input type="text" class="form-control" name="mofa_no" placeholder="Enter MOFA NO" value="{{ $single->mofa_no }}" required>
                      <span class="text-danger">{{ $errors->has('mofa_no') ? $errors->first('mofa_no') : '' }}</span>
                  </div>

                  <div class="form-group">
                      <label for="password">Tasheer Finger Date</label>
                      <input type="text" class="form-control datepicker" name="tasheer_finger_date" placeholder="Enter Tasheer Finger Date" value="{{ $single->tasheer_finger_date }}">
                  </div>

                  <div class="form-group">
                      <label for="password">Visa Issued Date</label>
                      <input type="text" class="form-control datepicker" name="visa_issued_date" placeholder="Enter Visa Issued Date" value="{{ $single->visa_issued_date }}">
                  </div>

                  <div class="form-group">
                      <label>Finger And TTC Note</label>
                      <textarea class="form-control" name="finger_ttc_note" placeholder="Finger And TTC Note">{{ $single->finger_ttc_note }}</textarea>
                  </div>

                  <input type="hidden" name="id" value="{{ $single->id }}"  />

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