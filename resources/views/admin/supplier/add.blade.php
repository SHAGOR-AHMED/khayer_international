@extends('admin.layout.default')
@section('title')
  Create New Supplier
@endsection
@section('content')

  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      @isset($add)
        <div class="box box-warning">
          <div class="box-header with-border">
            <h3 class="box-title">Create New Supplier</h3>
            <div class="box-tools pull-right">
              <a href="{{ route('supplier.index') }}" class="btn btn-success">View All</a>
            </div>
          </div>
          <div class="box-body">
          <form action="{{ route('supplier.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
          @csrf
            <div class="row">
              <div class="col-md-6 col-md-offset-3">
                <div class="form-group">
                    <label for="Name">Office Name <span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="office_name" placeholder="Enter Office Name" value="{{ old('office_name') }}" required>
                    <span class="text-danger">{{ $errors->has('office_name') ? $errors->first('office_name') : '' }}</span>
                </div>

                <div class="form-group">
                    <label for="password">Phone No</label>
                    <input type="text" class="form-control" name="phone" placeholder="Enter Phone No" value="{{ old('phone') }}">
                </div>

                <div class="form-group">
                    <label for="password">Balance</label>
                    <input type="text" class="form-control" name="balance" placeholder="Enter Balance" value="{{ old('balance') }}">
                </div>

                <div class="form-group">
                    <label>Address <span class="text-red">*</span></label>
                    <textarea class="form-control" name="address" placeholder="Enter Address" required>{{ old('address') }}</textarea>
                    <span class="text-danger">{{ $errors->has('address') ? $errors->first('address') : '' }}</span>
                </div>

                <div>
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
            <form action="{{ route('supplier.update') }}" name="form" method="post" name="edit" enctype="multipart/form-data" autocomplete="off">
                @csrf
              <div class="row">
                <div class="col-md-6 col-md-offset-3">
                  <div class="form-group">
                      <label for="regional_branch_name">Office Name <span class="text-red">*</span></label>
                      <input type="text" class="form-control" name="office_name" placeholder="Enter Name" value="{{ $single->office_name }}" required>
                      <span class="text-danger">{{ $errors->has('office_name') ? $errors->first('office_name') : '' }}</span>
                  </div>

                  <div class="form-group">
                      <label for="password">Phone No</label>
                      <input type="text" class="form-control" name="phone" placeholder="Enter Phone No" value="{{ $single->phone }}">
                  </div>

                  <div class="form-group">
                    <label>Address <span class="text-red">*</span></label>
                    <textarea class="form-control" name="address" placeholder="Enter Address" required>{{ $single->address }}</textarea>
                    <span class="text-danger">{{ $errors->has('address') ? $errors->first('address') : '' }}</span>
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