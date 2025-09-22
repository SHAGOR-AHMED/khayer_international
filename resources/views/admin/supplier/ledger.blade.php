@extends('admin.layout.default')
@section('title')
  Supplier Ledger
@endsection
@section('content')

  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Supplier Ledger</h3>
                <div class="box-tools pull-right">
                </div>
            </div>
            <div class="box-body">
                <form action="{{ route('supplier.report') }}" method="post" enctype="multipart/form-data" target="_blank">
                @csrf
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="form-group">
                                <label for="Name">Date Range (From) </label>
                                <input type="text" class="form-control datepicker" name="date_range_from" placeholder="Enter Date" value="{{ date('01-m-Y') }}">
                            </div>

                            <div class="form-group">
                                <label for="Name">Date Range (To) </label>
                                <input type="text" class="form-control datepicker" name="date_range_to" placeholder="Enter Date" value="{{ date('d-m-Y') }}">
                            </div>

                            <div class="form-group">
                                <label for="Name">Supplier Name <span class="text-red">*</span></label>
                                <select class="form-control liveSearch" name="supplier_id" required>
                                @foreach($all_suppliers as $id => $office_name)
                                    <option value="{{ $id }}">{{ $office_name }}</option>
                                @endforeach
                                </select>
                                <span class="text-danger">{{ $errors->has('supplier_id') ? $errors->first('supplier_id') : '' }}</span>
                            </div>

                            <div>
                                <button style="width:100%" type="submit" name="submit" class="btn btn-success"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> View Report</button>
                            </div>
                        </div>
                    </div>
                </form>         
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
@endsection