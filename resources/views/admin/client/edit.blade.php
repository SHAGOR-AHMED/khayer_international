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
            <div class="box-tools pull-right">
            </div>
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
                      <label>Passport No <span class="text-red">*</span></label>
                      <input type="text" class="form-control" name="passport_no" placeholder="Enter Passport No" value="{{ $single->passport_no }}" required>
                      <span class="text-danger">{{ $errors->has('passport_no') ? $errors->first('passport_no') : '' }}</span>
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
                        <img src="<?= (empty($single->image))? asset('admin/img/unknown.png') : asset($single->image) ?>" style="width:100px; margin-top:5px" id="img_preview" class="img-responsive img-thumbnail"/><br>
                        <code>(Max photo size: 400x400, 512kb)</code>
                    </div>

                    <div class="form-group">
                        <label for="address">Update Passport <code>(PDF ONLY)</code> </label>
                        <input type="file" class="form-control" name="passport_doc" value="">
                        <br>
                        <code>(Max photo size: 400x400, 512kb)</code>
                    </div>

                    <div class="form-group">
                      <button style="width:100%" type="submit" name="submit" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update Data</button>
                    </div>

                </div>
              </form>


            <!-- update password -->
            <div class="col-md-6">
                <form action="{{ route('user.update-password') }}" name="notice" method="post">
                @csrf
                    <div class="form-group">
                        <label for="password">Old Password <span class="text-red">*</span></label>
                        <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Enter Old Password" value="" required>
                        <span class="text-danger">{{ $errors->has('old_password') ? $errors->first('old_password') : '' }}</span>
                    </div>

                    <div class="form-group">
                        <label for="password">Password <span class="text-red">*</span></label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" value="" required>
                        <span class="text-danger">{{ $errors->has('password') ? $errors->first('password') : '' }}</span>
                    </div>

                    <div class="form-group">
                        <label for="password">Confirm Password <span class="text-red">*</span></label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Enter Confirm Password" value="" required onkeyup="checkPass();">
                        <span class="text-danger">{{ $errors->has('confirm_password') ? $errors->first('confirm_password') : '' }}</span>
                        <span id="confirmMessage" class="confirmMessage"></span>
                    </div>

                    <input type="hidden" name="id" value="{{ $single->id }}" class="form-control">

                    <div class="form-group">
                        <label for=""></label>
                        <a href="" class="btn btn-info btn-sm btn-warning">Cancel</a>
                        <input type="submit" name="submit" class="btn btn-primary btn-sm pull-right" value="Update Password">
                    </div>

                </form>
              </div>
            </div>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      @endisset
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

   <script type="text/javascript">
      document.forms['form'].elements['gender'].value='<?php echo $single->gender?>';
        function checkPass(){
            var password = document.getElementById('password');
            var confirm_password = document.getElementById('confirm_password');
            var message = document.getElementById('confirmMessage');
            var goodColor = "#66cc66";
            var badColor = "#ff6666";
            if(password.value == confirm_password.value){
                confirm_password.style.backgroundColor = goodColor;
                message.style.color = goodColor;
                message.innerHTML = "Password Match!"
            }else{
                confirm_password.style.backgroundColor = badColor;
                message.style.color = badColor;
                message.innerHTML = "Password Does Not Match!"
            }
        }

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