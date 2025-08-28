@extends('admin.layout.default')
@section('title')
  Create New Agent
@endsection
@section('content')

  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      @isset($add)
        <div class="box box-warning">
          <div class="box-header with-border">
            <h3 class="box-title">Create New Agent</h3>
            <div class="box-tools pull-right">
              <a href="{{ route('agent.index') }}" class="btn btn-success">View All</a>
            </div>
          </div>
          <div class="box-body">
          <form action="{{ route('agent.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
          @csrf
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label for="Name">Name <span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{ old('name') }}" required>
                    <span class="text-danger">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                </div>

                <div class="form-group">
                    <label for="password">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter Email" value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label for="password">Phone No <span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="phone" placeholder="Enter Phone No" value="{{ old('phone') }}" required>
                    <span class="text-danger">{{ $errors->has('phone') ? $errors->first('phone') : '' }}</span>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                    <label>Address <span class="text-red">*</span></label>
                    <textarea class="form-control" name="address" placeholder="Enter Address" required>{{ old('address') }}</textarea>
                    <span class="text-danger">{{ $errors->has('address') ? $errors->first('address') : '' }}</span>
                </div>

                <div class="form-group">
                    <label for="address">Upload Photograph</label>
                    <input type="file" id="userfile" class="form-control" name="image" value="" onchange="getPreview('userfile','img_preview','none');">
                    <img src="<?= asset('admin/img/unknown.png'); ?>" style="width:100px; margin-top:5px" id="img_preview" class="img-responsive img-thumbnail"/><br>
                    <code>(Max photo size: 400x400, 512kb)</code>
                </div>
              </div>

            </div>

            <div class="row">
              <div class="col-md-12">
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
            <form action="{{ route('agent.update') }}" name="form" method="post" name="edit" enctype="multipart/form-data" autocomplete="off">
                @csrf
              <div class="row">
                <div class="col-md-8">
                  <div class="form-group">
                      <label for="regional_branch_name">Name <span class="text-red">*</span></label>
                      <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{ $single->name }}" required>
                      <span class="text-danger">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                  </div>

                  <div class="form-group">
                      <label for="password">Email</label>
                      <input type="email" class="form-control" name="email" placeholder="Enter Email" value="{{ $single->email }}">
                  </div>

                  <div class="form-group">
                      <label for="password">Phone No <span class="text-red">*</span></label>
                      <input type="text" class="form-control" name="phone" placeholder="Enter Phone No" value="{{ $single->phone }}" required>
                      <span class="text-danger">{{ $errors->has('phone') ? $errors->first('phone') : '' }}</span>
                  </div>

                  <div class="form-group">
                    <label>Address <span class="text-red">*</span></label>
                    <textarea class="form-control" name="address" placeholder="Enter Address" required>{{ $single->address }}</textarea>
                    <span class="text-danger">{{ $errors->has('address') ? $errors->first('address') : '' }}</span>
                  </div>

                  <input type="hidden" name="id" value="{{ $single->id }}"  />

                  <div class="form-group">
                      <label for="address">Update Photograph</label>
                      <input type="file" id="userfile" class="form-control" name="image" value="" onchange="getPreview('userfile','img_preview','none');">
                      <code>(Max photo size: 400x400, 512kb)</code>
                  </div>
                </div>
                <div class="col-md-4">
                  <img src="{{ imageShow($single->image) }}" id="img_preview" class="img-responsive img-thumbnail"/>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
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