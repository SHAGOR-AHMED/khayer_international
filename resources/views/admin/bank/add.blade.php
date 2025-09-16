@extends('admin.layout.default')
@section('title')
  Create New Bank
@endsection
@section('content')

  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      @isset($add)
        <div class="box box-warning">
          <div class="box-header with-border">
            <h3 class="box-title">Create New Bank</h3>
            <div class="box-tools pull-right">
              <a href="{{ route('bank.index') }}" class="btn btn-success"><i class="fa fa-eye"></i>&nbsp;View All</a>
            </div>
          </div>
          <div class="box-body">
          <form action="{{ route('bank.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
          @csrf
            <div class="row">
              <div class="col-md-6 col-md-offset-3">
                <div class="form-group">
                    <label for="Name">Bank Name <span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="bank_name" placeholder="Enter Bank Name" value="{{ old('bank_name') }}" required>
                    <span class="text-danger">{{ $errors->has('bank_name') ? $errors->first('bank_name') : '' }}</span>
                </div>

                <div class="form-group">
                    <label for="Name">Account Name <span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="account_name" placeholder="Enter Account Name" value="{{ old('account_name') }}" required>
                    <span class="text-danger">{{ $errors->has('account_name') ? $errors->first('account_name') : '' }}</span>
                </div>

                <div class="form-group">
                    <label for="password">Account No <span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="account_no" placeholder="Enter Account No" value="{{ old('account_no') }}" required>
                    <span class="text-danger">{{ $errors->has('account_no') ? $errors->first('account_no') : '' }}</span>
                </div>

                <div class="form-group">
                    <label for="Name">Account Balance <span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="account_balance" placeholder="Enter Account Balance" value="{{ old('account_balance') }}" required>
                    <span class="text-danger">{{ $errors->has('account_balance') ? $errors->first('account_balance') : '' }}</span>
                </div>

                <div class="form-group">
                    <label>Remarks</label>
                    <textarea class="form-control" name="bank_remarks" placeholder="Enter Remarks">{{ old('bank_remarks') }}</textarea>
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
        <div class="box box-warning">
          <div class="box-header with-border">
            <h3 class="box-title">Update Information</h3>
            <div class="box-tools pull-right">
            </div>
          </div>
          <div class="box-body">
            <form action="{{ route('bank.update') }}" name="form" method="post" name="edit" enctype="multipart/form-data">
            @csrf
              <div class="row">
                <div class="col-md-6 col-md-offset-3">
                  <div class="form-group">
                    <label for="Name">Bank Name <span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="bank_name" placeholder="Enter Bank Name" value="{{ $single->bank_name }}" required>
                    <span class="text-danger">{{ $errors->has('bank_name') ? $errors->first('bank_name') : '' }}</span>
                  </div>

                  <div class="form-group">
                      <label for="Name">Account Name <span class="text-red">*</span></label>
                      <input type="text" class="form-control" name="account_name" placeholder="Enter Account Name" value="{{ $single->account_name }}" required>
                      <span class="text-danger">{{ $errors->has('account_name') ? $errors->first('account_name') : '' }}</span>
                  </div>

                  <div class="form-group">
                      <label for="password">Account No <span class="text-red">*</span></label>
                      <input type="text" class="form-control" name="account_no" placeholder="Enter Account No" value="{{ $single->account_no }}" required>
                      <span class="text-danger">{{ $errors->has('account_no') ? $errors->first('account_no') : '' }}</span>
                  </div>

                  <div class="form-group">
                      <label for="Name">Account Balance <span class="text-red">*</span></label>
                      <input type="text" class="form-control" name="account_balance" placeholder="Enter Account Balance" value="{{ $single->account_balance }}" readonly>
                  </div>

                  <div class="form-group">
                      <label>Remarks</label>
                      <textarea class="form-control" name="bank_remarks" placeholder="Enter Remarks">{{ $single->bank_remarks }}</textarea>
                  </div>

                  <input type="hidden" name="id" value="{{ $single->id }}"  />

                  <div>
                    <button style="width:100%" type="submit" name="submit" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update Data</button>
                  </div>

                </div>
                
              </div>
            </form>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      @endisset
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
@endsection
