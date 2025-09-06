@extends('admin.layout.default')
@section('title')
  Manpower Details Information
@endsection
@section('content')

  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Manpower Details Information</h3>
          <div class="box-tools pull-right">
            <a href="{{ route('manpower.index') }}" class="btn btn-success">View All</a>
          </div>
        </div>
        <div class="box-body">
        
          <div class="row">
            
            @include('admin.common.details')

            <div class="col-md-4">
              @if($single->is_returned != 'YES')
                <form action="{{ route('manpower.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                  
                  <div class="form-group">
                      <label for="password">Manpower Date<span class="text-red">*</span></label>
                      <input type="text" class="form-control datepicker" name="manpower_date" placeholder="Enter Manpower Date" value="{{ $single->manpower_date }}" required>
                      <span class="text-danger">{{ $errors->has('manpower_date') ? $errors->first('manpower_date') : '' }}</span>
                  </div>

                  <input type="hidden" name="id" value="{{ $single->id }}" />

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