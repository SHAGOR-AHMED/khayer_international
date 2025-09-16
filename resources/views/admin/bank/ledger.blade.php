@extends('admin.layout.default')
@section('title')
  Bank Ledger
@endsection
@section('content')

  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      
        <div class="box box-warning">
          <div class="box-header with-border">
            <h3 class="box-title">Bank Ledger</h3>
            <div class="box-tools pull-right">
              <a href="{{ route('bank.index') }}" class="btn btn-success"><i class="fa fa-eye"></i>&nbsp;View All</a>
            </div>
          </div>
          <div class="box-body">
          <form action="{{ route('bank.report') }}" method="post" enctype="multipart/form-data" autocomplete="off">
          @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="Name">Date Range (From) </label>
                        <input type="text" class="form-control datepicker" name="date_range_from" placeholder="Enter Date" value="{{ date('01-m-Y') }}">
                    </div>

                    <div class="form-group">
                        <label for="Name">Date Range (To) </label>
                        <input type="text" class="form-control datepicker" name="date_range_to" placeholder="Enter Date" value="{{ date('d-m-Y') }}">
                    </div>

                    <div class="form-group">
                        <label for="Name">Bank Name <span class="text-red">*</span></label>
                        <select class="form-control" name="bank_id" required>
                        @foreach($all_banks as $id => $bank_name)
                            <option value="{{ $id }}">{{ $bank_name }}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <button style="width:100%" type="submit" name="submit" class="btn btn-success"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> View Report</button>
                </div>
            </div>
          </form>         
          </div><!-- /.box-body -->
        </div><!-- /.box -->
     
      
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
@endsection