@extends('admin.layout.default')
@section('title')
  Update Info
@endsection
@section('content')

  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      @isset($edit)
        <div class="box box-warning">
          <div class="box-header with-border">
            <h3 class="box-title">Update Information</h3>
            <div class="box-tools pull-right"></div>
          </div>

          <div class="box-body">
            <div class="row">
              <form action="{{ route('client.update') }}" name="form"  method="post" name="edit" enctype="multipart/form-data" autocomplete="off" onsubmit="return(validate())">
                @csrf
                <div class="col-md-6">

                    <div class="form-group">
                        <label for="regional_branch_name">Name <span class="text-red">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{ $single->name }}" required>
                        <span class="text-danger">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                    </div>

                    <div class="form-group">
                        <label for="password">Email <span class="text-red">*</span></label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" value="{{ $single->email }}" required>
                        <span class="text-danger">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
                    </div>

                    <div class="form-group">
                        <label for="password">Phone No <span class="text-red">*</span></label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone No" value="{{ $single->phone }}" required>
                        <span class="text-danger">{{ $errors->has('phone') ? $errors->first('phone') : '' }}</span>
                    </div>

                    <div class="form-group">
                      <label for="password">Date Of Birth <span class="text-red">*</span></label>
                      <input type="date" class="form-control" name="dob" value="{{ $single->dob }}" required>
                      <span class="text-danger">{{ $errors->has('dob') ? $errors->first('dob') : '' }}</span>
                    </div>

                    <div class="form-group">
                      <label>Passport No <span class="text-red">*</span></label>
                      <input type="text" class="form-control" name="passport_no" placeholder="Enter Passport No" value="{{ $single->passport_no }}" required>
                      <span class="text-danger">{{ $errors->has('passport_no') ? $errors->first('passport_no') : '' }}</span>
                    </div>

                    <div class="form-group">
                      <label for="password">Passport Expired Date <span class="text-red">*</span></label>
                      <input type="date" class="form-control" name="passport_expired_date" value="{{ $single->passport_expired_date }}" required>
                      <span class="text-danger">{{ $errors->has('passport_expired_date') ? $errors->first('passport_expired_date') : '' }}</span>
                    </div>

                    <div class="form-group">
                      <label for="gender">Gender <span class="text-red">*</span></label>
                      <select class="form-control" name="gender"  required>
                        <option value="0">Please Select</option>
                        <option value="1">Male</option>
                        <option value="2">Female</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Address <span class="text-red">*</span></label>
                      <textarea class="form-control" name="address" placeholder="Enter Address" required>
                        {{ $single->address }}
                      </textarea>
                      <span class="text-danger">{{ $errors->has('address') ? $errors->first('address') : '' }}</span>
                    </div>

                    <input type="hidden" name="id" value="<?php echo $single->id; ?>"  />

                    <div class="form-group">
                      <label for="address">Update Photograph</label>
                      <input type="file" id="userfile" class="form-control" name="image" value="" onchange="getPreview('userfile','img_preview','none');">
                      <code>(Max photo size: 400x400, 512kb)</code>
                    </div>

                    <div class="form-group">
                      <label for="address">Update Passport </label>
                      <input type="file" class="form-control" name="passport_doc" value="">
                      <br>
                      <code>(Max photo size: 400x400, 512kb)</code>
                    </div>

                    <div class="form-group">
                      <button style="width:100%" type="submit" name="submit" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update Data</button>
                    </div>

                </div>
              </form>

              <!-- update password if needed-->
              <div class="col-md-6">
                  <img src="{{ imageShow($single->image) }}" id="img_preview" class="img-responsive img-thumbnail"/>
              </div>
            </div>

          </div><!-- /.box-body -->
        </div><!-- /.box -->
      @endisset
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

   <script type="text/javascript">
        document.forms['form'].elements['gender'].value='<?php echo $single->gender?>';

        function validate(){
            if(document.form.gender.value == 0){
                // swal("Alert","Required field can't be Empty","error",{
                //     button:"ok"
                // });
                alert("Required field can't be Empty")
                return false;
            }
            return true;
        }
    </script>

@endsection