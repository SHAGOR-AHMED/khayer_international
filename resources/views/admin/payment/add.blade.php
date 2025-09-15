@extends('admin.layout.default')
@section('title')
  Create New Payment
@endsection
@section('content')

  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      @isset($add)
        <div class="box box-warning">
          <div class="box-header with-border">
            <h3 class="box-title">Create New Payment</h3>
            <div class="box-tools pull-right">
              <a href="{{ route('payment.index') }}" class="btn btn-success"><i class="fa fa-eye"></i>&nbsp;View All</a>
            </div>
          </div>
          <div class="box-body">
          <form action="{{ route('payment.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
          @csrf
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                    <label for="Name">Transaction Date <span class="text-red">*</span></label>
                    <input type="text" class="form-control datepicker" name="transaction_date" placeholder="Enter Date" value="{{ date('d-m-Y') }}" required>
                    <span class="text-danger">{{ $errors->has('transaction_date') ? $errors->first('transaction_date') : '' }}</span>
                </div>

                <div class="form-group">
                    <label for="Name">Agent Name <span class="text-red">*</span></label>
                    <select class="form-control liveSearch" name="agent_id" required>
                      @foreach($all_agents as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                      @endforeach
                    </select>
                    <span class="text-danger">{{ $errors->has('agent_id') ? $errors->first('agent_id') : '' }}</span>
                </div>

                <div class="form-group">
                    <label for="password">Payment Mode<span class="text-red">*</span></label>
                    <select class="form-control" name="payment_mode" id="payment_mode" required onchange="globalToggle('payment_mode','cheque')">
                      <option value="">Please Select</option>
                      <option value="Cash">Cash</option>
                      <option value="Cheque">Bank</option>
                    </select>
                    <span class="text-danger">{{ $errors->has('payment_mode') ? $errors->first('payment_mode') : '' }}</span>
                </div>
                <!-- for bank payment -->
                <div style="display:none; margin-top:2px;" id="cheque">
                  <div class="form-group">
                    <label for="Name">Bank Name <span class="text-red">*</span></label>
                    <select class="form-control" name="bank_id">
                      @foreach($all_banks as $id => $bank_name)
                        <option value="{{ $id }}">{{ $bank_name }}</option>
                      @endforeach
                    </select>
                    <span class="text-danger">{{ $errors->has('bank_id') ? $errors->first('bank_id') : '' }}</span>
                  </div>

                  <div class="form-group">
                    <label for="Name">Cheque No <span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="cheque_no" placeholder="Enter Cheque No" value="{{ old('cheque_no') }}" required>
                    <span class="text-danger">{{ $errors->has('cheque_no') ? $errors->first('cheque_no') : '' }}</span>
                  </div>

                  <div class="form-group">
                    <label for="Name">Cheque Date <span class="text-red">*</span></label>
                    <input type="text" class="form-control datepicker" name="cheque_date" placeholder="Enter Date" value="">
                    <span class="text-danger">{{ $errors->has('cheque_date') ? $errors->first('cheque_date') : '' }}</span>
                  </div>
                </div>

                <div class="form-group">
                    <label for="Name">Amount <span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="amount" placeholder="Enter Amount" value="{{ old('amount') }}" required>
                    <span class="text-danger">{{ $errors->has('amount') ? $errors->first('amount') : '' }}</span>
                </div>

                 <div class="form-group">
                    <label for="Name">Money Receipt No <span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="money_receipt_no" placeholder="Enter Money Receipt No" value="{{ old('money_receipt_no') }}" required>
                    <span class="text-danger">{{ $errors->has('money_receipt_no') ? $errors->first('money_receipt_no') : '' }}</span>
                </div>

                <div class="form-group">
                    <label>Remarks</label>
                    <textarea class="form-control" name="remarks" placeholder="Enter Remarks">{{ old('remarks') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="address">Attached</label>
                    <input type="file" id="userfile" class="form-control" name="image" value="" onchange="getPreview('userfile','img_preview','none');">
                    <img src="<?= asset('admin/img/unknown.png'); ?>" style="width:100px; margin-top:5px" id="img_preview" class="img-responsive img-thumbnail"/><br>
                    <code>(Max photo size: 400x400, 512kb)</code>
                </div>

              </div>

              <div class="form-group">
                <button style="width:100%" type="submit" name="submit" class="btn btn-success"><i class="fa fa-bookmark" aria-hidden="true"></i> Save Data</button>
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