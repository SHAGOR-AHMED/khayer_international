@extends('admin.layout.default')
@section('title')
  Add Purchase
@endsection
@section('content')

  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      @isset($add)
        <div class="box box-warning">
          <div class="box-header with-border">
            <h3 class="box-title">Create New Purchase</h3>
            <div class="box-tools pull-right">
              <a href="{{ route('purchase.index') }}" class="btn btn-success btn-sm" style="margin-left: 250px;"><i class="fa fa-eye"></i>&nbsp;View All</a>
            </div>
          </div>
          
          <div class="box-body">
          <form action="{{ route('purchase.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
          @csrf
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label for="Name">Transaction Date <span class="text-red">*</span></label>
                    <input type="text" class="form-control datepicker" name="transaction_date" placeholder="Enter Date" value="{{ date('d-m-Y') }}" required>
                    <span class="text-danger">{{ $errors->has('transaction_date') ? $errors->first('transaction_date') : '' }}</span>
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

                <div class="form-group">
                    <label for="Name">Money Receipt No <span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="money_receipt_no" placeholder="Enter Money Receipt No" value="{{ old('money_receipt_no') }}" required>
                    <span class="text-danger">{{ $errors->has('money_receipt_no') ? $errors->first('money_receipt_no') : '' }}</span>
                </div>

                <div class="form-group">
                    <label>Remarks</label>
                    <textarea class="form-control" name="remarks" placeholder="Enter Remarks">{{ old('remarks') }}</textarea>
                </div>
               
              </div>

              <div class="col-md-6">
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
                    <input type="text" class="form-control" name="cheque_no" placeholder="Enter Cheque No" value="{{ old('cheque_no') }}">
                    <span class="text-danger">{{ $errors->has('cheque_no') ? $errors->first('cheque_no') : '' }}</span>
                  </div>

                  <div class="form-group">
                    <label for="Name">Cheque Date <span class="text-red">*</span></label>
                    <input type="text" class="form-control datepicker" name="cheque_date" placeholder="Enter Date" value="">
                    <span class="text-danger">{{ $errors->has('cheque_date') ? $errors->first('cheque_date') : '' }}</span>
                  </div>
                </div>

                <div class="form-group">
                    <label for="address">Attached</label>
                    <input type="file" id="userfile" class="form-control" name="image" value="" onchange="getPreview('userfile','img_preview','none');">
                    <img src="<?= asset('admin/img/unknown.png'); ?>" style="width:100px; margin-top:5px" id="img_preview" class="img-responsive img-thumbnail"/><br>
                    <code>(Max photo size: 400x400, 512kb)</code>
                </div>

                <div class="form-group">
                  <hr>
                  <button style="width:100%" name="submit" class="btn btn-success"><i class="fa fa-bookmark" aria-hidden="true"></i></button>
                </div>

              </div>



                <div class="col-md-3">
                  <div class="form-group">
                    <label>Product Details</label>
                    <input type="text" class="form-control" name="product_details" placeholder="Enter Details" value="" required>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                      <label>Quantity <span class="text-red">*</span></label>
                      <input type="text" class="form-control" name="product_quantity" id="product_quantity" placeholder="Enter Quantity" value="{{ old('product_quantity') }}" required>
                      <span class="text-danger">{{ $errors->has('product_quantity') ? $errors->first('product_quantity') : '' }}</span>
                  </div>
                </div>

                
                  <div class="col-md-3">
                  <div class="form-group">
                      <label>Product Price <span class="text-red">*</span></label>
                      <input type="text" class="form-control" name="product_price" id="product_price" placeholder="Enter Price" value="{{ old('product_price') }}" required onkeyup="productQty()">
                      <span class="text-danger">{{ $errors->has('product_price') ? $errors->first('product_price') : '' }}</span>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                      <label>Product Total Amount<span class="text-red">*</span></label>
                      <input type="text" class="form-control" name="product_total_amount" id="product_total_amount" value="" readonly>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="Name">Rate <span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="payrate" id="payrate" placeholder="Enter Rate" value="">
                    <span class="text-danger">{{ $errors->has('payrate') ? $errors->first('payrate') : '' }}</span>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                      <label for="Name">BD Amount <span class="text-red">*</span></label>
                      <input type="text" class="form-control" name="bdamount" id="bdamount" placeholder="Enter BD Amount" value="" onkeyup="rateConversion()">
                      <span class="text-danger">{{ $errors->has('bdamount') ? $errors->first('bdamount') : '' }}</span>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                      <label for="Name">Total Amount <span class="text-red">*</span></label>
                      <input type="text" class="form-control" name="amount" id="amount" placeholder="Enter Amount" value="{{ old('amount') }}" required readonly>
                      <span class="text-danger">{{ $errors->has('amount') ? $errors->first('amount') : '' }}</span>
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

    function rateConversion() {
      var payrate = $("#payrate").val();
      var bdamount = $("#bdamount").val();
      var totalAmount = (bdamount*payrate);
      $("#amount").val(totalAmount);
    }

    function productQty(){
      var qty = $("#product_quantity").val();
      var price = $("#product_price").val();
      var productTotalAmount = (qty*price);
      $("#product_total_amount").val(productTotalAmount);
    }

  </script>
@endsection