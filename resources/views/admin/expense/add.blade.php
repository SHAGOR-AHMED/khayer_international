@extends('admin.layout.default')
@section('title')
  Add Expense
@endsection
@section('content')

  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      @isset($add)
        <div class="box box-warning">
          <div class="box-header with-border">
            <h3 class="box-title">Create New Expense</h3>
            <div class="box-tools pull-right">
              <a href="{{ route('expense.index') }}" class="btn btn-success btn-sm" style="margin-left: 250px;"><i class="fa fa-eye"></i>&nbsp;View All</a>
            </div>
          </div>
          
          <div class="box-body">
          <form action="{{ route('expense.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
          @csrf
            <div class="row">
              <div class="col-md-6 col-md-offset-3">
                <div class="form-group">
                    <label for="Name">Transaction Date <span class="text-red">*</span></label>
                    <input type="text" class="form-control datepicker" name="transaction_date" placeholder="Enter Date" value="{{ date('d-m-Y') }}" required>
                    <span class="text-danger">{{ $errors->has('transaction_date') ? $errors->first('transaction_date') : '' }}</span>
                </div>

                <div class="form-group">
                    <label for="Name">Expense From<span class="text-red">*</span></label>
                    <select class="form-control" name="bank_id" required>
                      @foreach($all_banks as $id => $bank_name)
                        <option value="{{ $id }}">{{ $bank_name }}</option>
                      @endforeach
                    </select>
                    <span class="text-danger">{{ $errors->has('bank_id') ? $errors->first('bank_id') : '' }}</span>
                </div>

                <div class="form-group">
                    <label for="Name">Amount <span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="amount" placeholder="Enter Amount" value="{{ old('amount') }}" required>
                    <span class="text-danger">{{ $errors->has('amount') ? $errors->first('amount') : '' }}</span>
                </div>

                <div class="form-group">
                    <label>Description <span class="text-red">*</span></label>
                    <textarea class="form-control" name="description" placeholder="Enter Description" required>{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="address">Attached</label>
                    <input type="file" id="userfile" class="form-control" name="image" value="" onchange="getPreview('userfile','img_preview','none');">
                    <img src="<?= asset('admin/img/unknown.png'); ?>" style="width:100px; margin-top:5px" id="img_preview" class="img-responsive img-thumbnail"/><br>
                    <code>(Max photo size: 400x400, 512kb)</code>
                </div>

                <div class="form-group">
                  <button style="width:100%" type="submit" name="submit" class="btn btn-success"><i class="fa fa-bookmark" aria-hidden="true"></i> Save Data</button>
                </div>

              </div>

            </div>
          </form>         
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      @endisset
      @isset($edit)
        
      @endisset
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

  <script>
    function globalToggle(para1, para2) {
      var payment = $("#" + para1).val();
      if (payment === 'Cheque') {
        $("#" + para2).show();
      } else {
        $("#" + para2).hide();
      }
    }
  </script>
@endsection