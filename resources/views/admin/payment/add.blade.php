@extends('admin.layout.default')
@section('title')
    @isset($add)
        Add Payment
    @endisset
    @isset($edit)
        Edit Payment
    @endisset
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
                            <a href="{{ route('payment.index') }}" class="btn btn-success btn-sm" style="margin-left: 250px;"><i
                                    class="fa fa-eye"></i>&nbsp;View All</a>
                        </div>
                    </div>

                    <div class="box-body">
                        <form action="{{ route('payment.store') }}" method="post" enctype="multipart/form-data"
                            autocomplete="off">
                            @csrf
                            <div class="row">
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Name">Transaction Date <span class="text-red">*</span></label>
                                        <input type="text" class="form-control datepicker" name="transaction_date"
                                            placeholder="Enter Date" value="{{ date('d-m-Y') }}" required>
                                        <span
                                            class="text-danger">{{ $errors->has('transaction_date') ? $errors->first('transaction_date') : '' }}</span>
                                    </div>

                                    <div class="form-group">
                                        <label for="Name">Supplier Name <span class="text-red">*</span></label>
                                        <select class="form-control liveSearch" name="supplier_id" required>
                                            @foreach ($all_suppliers as $id => $office_name)
                                                <option value="{{ $id }}">{{ $office_name }}</option>
                                            @endforeach
                                        </select>
                                        <span
                                            class="text-danger">{{ $errors->has('supplier_id') ? $errors->first('supplier_id') : '' }}</span>
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Supplier Type<span class="text-red">*</span></label>
                                        <select class="form-control" name="type" id="type" required
                                            onchange="typeToggle('type','rate','pay')">
                                            <option value="">Please Select</option>
                                            <option value="BD">BANGLADESH</option>
                                            <option value="FOREIGN">FOREIGN</option>
                                        </select>
                                        <span
                                            class="text-danger">{{ $errors->has('type') ? $errors->first('type') : '' }}</span>
                                    </div>
                                    <!-- for foreign supplier payment -->
                                    <div class="form-group" style="display:none; margin-top:2px;" id="pay">
                                        <label for="Name">BD Amount <span class="text-red">*</span></label>
                                        <input type="text" class="form-control" name="bdamount" id="bdamount"
                                            placeholder="Enter BD Amount" value="" onkeyup="rateConversion()">
                                        <span
                                            class="text-danger">{{ $errors->has('bdamount') ? $errors->first('bdamount') : '' }}</span>
                                    </div>
                                    <div class="form-group" style="display:none; margin-top:2px;" id="rate">
                                        <label for="Name">Rate <span class="text-red">*</span></label>
                                        <input type="text" class="form-control" name="payrate" id="payrate"
                                            placeholder="Enter Rate" value="">
                                        <span
                                            class="text-danger">{{ $errors->has('payrate') ? $errors->first('payrate') : '' }}</span>
                                    </div>

                                    <div class="form-group">
                                        <label for="Name">Total Amount <span class="text-red">*</span></label>
                                        <input type="text" class="form-control" name="amount" id="amount"
                                            placeholder="Enter Amount" value="{{ old('amount') }}" required>
                                        <span
                                            class="text-danger">{{ $errors->has('amount') ? $errors->first('amount') : '' }}</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Payment Mode<span class="text-red">*</span></label>
                                        <select class="form-control" name="payment_mode" id="payment_mode" required
                                            onchange="globalToggle('payment_mode','cheque')">
                                            <option value="">Please Select</option>
                                            <option value="Cash">Cash</option>
                                            <option value="Cheque">Bank</option>
                                        </select>
                                        <span
                                            class="text-danger">{{ $errors->has('payment_mode') ? $errors->first('payment_mode') : '' }}</span>
                                    </div>
                                    <!-- for bank payment -->
                                    <div style="display:none; margin-top:2px;" id="cheque">
                                        <div class="form-group">
                                            <label for="Name">Bank Name <span class="text-red">*</span></label>
                                            <select class="form-control" name="bank_id">
                                                @foreach ($all_banks as $id => $bank_name)
                                                    <option value="{{ $id }}">{{ $bank_name }}</option>
                                                @endforeach
                                            </select>
                                            <span
                                                class="text-danger">{{ $errors->has('bank_id') ? $errors->first('bank_id') : '' }}</span>
                                        </div>

                                        <div class="form-group">
                                            <label for="Name">Cheque No <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" name="cheque_no"
                                                placeholder="Enter Cheque No" value="{{ old('cheque_no') }}">
                                            <span
                                                class="text-danger">{{ $errors->has('cheque_no') ? $errors->first('cheque_no') : '' }}</span>
                                        </div>

                                        <div class="form-group">
                                            <label for="Name">Cheque Date <span class="text-red">*</span></label>
                                            <input type="text" class="form-control datepicker" name="cheque_date"
                                                placeholder="Enter Date" value="">
                                            <span
                                                class="text-danger">{{ $errors->has('cheque_date') ? $errors->first('cheque_date') : '' }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Name">Money Receipt No <span class="text-red">*</span></label>
                                        <input type="text" class="form-control" name="money_receipt_no"
                                            placeholder="Enter Money Receipt No" value="{{ old('money_receipt_no') }}"
                                            required>
                                        <span
                                            class="text-danger">{{ $errors->has('money_receipt_no') ? $errors->first('money_receipt_no') : '' }}</span>
                                    </div>

                                    <div class="form-group">
                                        <label>Remarks</label>
                                        <textarea class="form-control" name="remarks" placeholder="Enter Remarks">{{ old('remarks') }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="address">Attached</label>
                                        <input type="file" id="userfile" class="form-control" name="image"
                                            value="" onchange="getPreview('userfile','img_preview','none');">
                                        <img src="<?= asset('admin/img/unknown.png') ?>" style="width:100px; margin-top:5px"
                                            id="img_preview" class="img-responsive img-thumbnail" /><br>
                                        <code>(Max photo size: 400x400, 512kb)</code>
                                    </div>

                                    <div class="form-group">
                                        <button style="width:100%" type="submit" name="submit" class="btn btn-success"><i
                                                class="fa fa-bookmark" aria-hidden="true"></i> Save Data</button>
                                    </div>

                                </div>

                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            @endisset

            @isset($edit)
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Payment</h3>
                        <div class="box-tools pull-right">
                            <a href="{{ route('payment.index') }}" class="btn btn-success btn-sm"
                                style="margin-left: 250px;"><i class="fa fa-eye"></i>&nbsp;View All</a>
                        </div>
                    </div>

                    <div class="box-body">
                        <form action="{{ route('payment.update') }}" method="post" enctype="multipart/form-data"
                            autocomplete="off">
                            @csrf
                            <input type="hidden" name="id" value="{{ $single->id }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Name">Transaction Date <span class="text-red">*</span></label>
                                        <input type="text" class="form-control datepicker" name="transaction_date"
                                            placeholder="Enter Date"
                                            value="{{ old('transaction_date', date('d-m-Y', strtotime($single->transaction_date))) }}"
                                            required>
                                        <span
                                            class="text-danger">{{ $errors->has('transaction_date') ? $errors->first('transaction_date') : '' }}</span>
                                    </div>

                                    <div class="form-group">
                                        <label for="Name">Supplier Name <span class="text-red">*</span></label>
                                        <select class="form-control liveSearch" name="supplier_id" required>
                                            @foreach ($all_suppliers as $id => $office_name)
                                                <option value="{{ $id }}"
                                                    {{ $single->supplier_id == $id ? 'selected' : '' }}>{{ $office_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span
                                            class="text-danger">{{ $errors->has('supplier_id') ? $errors->first('supplier_id') : '' }}</span>
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Supplier Type<span class="text-red">*</span></label>
                                        <select class="form-control" name="type" id="type_edit" required
                                            onchange="typeToggle('type_edit','rate_edit','pay_edit')">
                                            <option value="">Please Select</option>
                                            <option value="BD" {{ $single->type == 'BD' ? 'selected' : '' }}>BANGLADESH
                                            </option>
                                            <option value="FOREIGN" {{ $single->type == 'FOREIGN' ? 'selected' : '' }}>FOREIGN
                                            </option>
                                        </select>
                                        <span
                                            class="text-danger">{{ $errors->has('type') ? $errors->first('type') : '' }}</span>
                                    </div>
                                    <!-- for foreign supplier payment -->
                                    <div class="form-group"
                                        style="display:{{ $single->type == 'FOREIGN' ? 'block' : 'none' }}; margin-top:2px;"
                                        id="pay_edit">
                                        <label for="Name">BD Amount <span class="text-red">*</span></label>
                                        <input type="text" class="form-control" name="bdamount" id="bdamount_edit"
                                            placeholder="Enter BD Amount" value="{{ old('bdamount', $single->bdamount) }}"
                                            onkeyup="rateConversion()">
                                        <span
                                            class="text-danger">{{ $errors->has('bdamount') ? $errors->first('bdamount') : '' }}</span>
                                    </div>
                                    <div class="form-group"
                                        style="display:{{ $single->type == 'FOREIGN' ? 'block' : 'none' }}; margin-top:2px;"
                                        id="rate_edit">
                                        <label for="Name">Rate <span class="text-red">*</span></label>
                                        <input type="text" class="form-control" name="payrate" id="payrate_edit"
                                            placeholder="Enter Rate" value="{{ old('payrate', $single->payrate) }}">
                                        <span
                                            class="text-danger">{{ $errors->has('payrate') ? $errors->first('payrate') : '' }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="Name">Total Amount <span class="text-red">*</span></label>
                                        <input type="text" class="form-control" name="amount" id="amount_edit"
                                            placeholder="Enter Amount" value="{{ old('amount', $single->amount) }}" required>
                                        <span
                                            class="text-danger">{{ $errors->has('amount') ? $errors->first('amount') : '' }}</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Payment Mode<span class="text-red">*</span></label>
                                        <select class="form-control" name="payment_mode" id="payment_mode_edit" required
                                            onchange="globalToggle('payment_mode_edit','cheque_edit')">
                                            <option value="">Please Select</option>
                                            <option value="Cash" {{ $single->payment_mode == 'Cash' ? 'selected' : '' }}>
                                                Cash</option>
                                            <option value="Cheque" {{ $single->payment_mode == 'Cheque' ? 'selected' : '' }}>
                                                Bank</option>
                                        </select>
                                        <span
                                            class="text-danger">{{ $errors->has('payment_mode') ? $errors->first('payment_mode') : '' }}</span>
                                    </div>
                                    <!-- for bank payment -->
                                    <div style="display:{{ $single->payment_mode == 'Cheque' ? 'block' : 'none' }}; margin-top:2px;"
                                        id="cheque_edit">
                                        <div class="form-group">
                                            <label for="Name">Bank Name <span class="text-red">*</span></label>
                                            <select class="form-control" name="bank_id">
                                                @foreach ($all_banks as $id => $bank_name)
                                                    <option value="{{ $id }}"
                                                        {{ $single->bank_id == $id ? 'selected' : '' }}>{{ $bank_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <span
                                                class="text-danger">{{ $errors->has('bank_id') ? $errors->first('bank_id') : '' }}</span>
                                        </div>

                                        <div class="form-group">
                                            <label for="Name">Cheque No <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" name="cheque_no"
                                                placeholder="Enter Cheque No"
                                                value="{{ old('cheque_no', $single->cheque_no) }}">
                                            <span
                                                class="text-danger">{{ $errors->has('cheque_no') ? $errors->first('cheque_no') : '' }}</span>
                                        </div>

                                        <div class="form-group">
                                            <label for="Name">Cheque Date <span class="text-red">*</span></label>
                                            <input type="text" class="form-control datepicker" name="cheque_date"
                                                placeholder="Enter Date"
                                                value="{{ old('cheque_date', $single->cheque_date ? date('d-m-Y', strtotime($single->cheque_date)) : '') }}">
                                            <span
                                                class="text-danger">{{ $errors->has('cheque_date') ? $errors->first('cheque_date') : '' }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Name">Money Receipt No <span class="text-red">*</span></label>
                                        <input type="text" class="form-control" name="money_receipt_no"
                                            placeholder="Enter Money Receipt No"
                                            value="{{ old('money_receipt_no', $single->money_receipt_no) }}" required>
                                        <span
                                            class="text-danger">{{ $errors->has('money_receipt_no') ? $errors->first('money_receipt_no') : '' }}</span>
                                    </div>

                                    <div class="form-group">
                                        <label>Remarks</label>
                                        <textarea class="form-control" name="remarks" placeholder="Enter Remarks">{{ old('remarks', $single->remarks) }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="address">Attached</label>
                                        <input type="file" id="userfile_edit" class="form-control" name="image"
                                            value="" onchange="getPreview('userfile_edit','img_preview_edit','none');">
                                        @if ($single->image)
                                            <img src="{{ asset('admin/documents/' . $single->image) }}"
                                                style="width:100px; margin-top:5px" id="img_preview_edit"
                                                class="img-responsive img-thumbnail" />
                                        @else
                                            <img src="<?= asset('admin/img/unknown.png') ?>"
                                                style="width:100px; margin-top:5px" id="img_preview_edit"
                                                class="img-responsive img-thumbnail" />
                                        @endif
                                        <br>
                                        <code>(Max photo size: 400x400, 512kb)</code>
                                    </div>

                                    <div class="form-group">
                                        <button style="width:100%" type="submit" name="submit" class="btn btn-success"><i
                                                class="fa fa-edit" aria-hidden="true"></i> Update Data</button>
                                    </div>

                                </div>

                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
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

        function typeToggle(para1, para2, para3) {
            var type = $("#" + para1).val();
            if (type === 'FOREIGN') {
                $("#" + para2).show();
                $("#" + para3).show();
            } else {
                $("#" + para2).hide();
                $("#" + para3).hide();
            }
        }

        function rateConversion() {
            @isset($add)
                var payrate = $("#payrate").val();
                var bdamount = $("#bdamount").val();
                var totalAmount = (bdamount / payrate);
                $("#amount").val(totalAmount);
            @endisset

            @isset($edit)
                var payrate = $("#payrate_edit").val();
                var bdamount = $("#bdamount_edit").val();
                var totalAmount = (bdamount / payrate);
                $("#amount_edit").val(totalAmount);
            @endisset
        }
    </script>
@endsection
