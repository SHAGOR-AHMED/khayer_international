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
            <a href="{{ route('delivery.index') }}" class="btn btn-success">View All</a>
          </div>
        </div>
        <div class="box-body">
        
          <div class="row">

            @include('admin.common.details')

            <div class="col-md-4">
              @if($single->status != 'DELIVERED')
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
                  <h1 style="color:green;">This Application has been DELIVERED </h1>
                </div>
                <div class="form-group">
                  <label>Delivered Date: </label>
                  {{ $single->delivered_date }}
                </div>
              @endif
            </div>

          </div>
        
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
@endsection