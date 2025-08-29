@extends('admin.layout.default')
@section('title')
  Create User
@endsection
@section('content')

  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      @isset($add)
        <div class="box box-warning">
          <div class="box-header with-border">
            <h3 class="box-title">Create User</h3>
            <div class="box-tools pull-right">
              <a href="{{ route('user.index') }}" class="btn btn-success">View All</a>
            </div>
          </div>
          <div class="box-body">
          <form action="{{ route('user.store') }}" method="post" name="form" enctype="multipart/form-data" autocomplete="off" onsubmit="return(validate())">
          @csrf
            <div class="row">
              <div class="col-md-6">

                <div class="form-group">
                    <label for="Name">Name <span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{ old('name') }}" required>
                    <span class="text-danger">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                </div>

                <div class="form-group">
                    <label for="password">Email <span class="text-red">*</span></label>
                    <input type="email" class="form-control" name="email" placeholder="Enter Email" value="{{ old('email') }}" required>
                    <span class="text-danger">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
                </div>

                <div class="form-group">
                    <label for="password">Phone No <span class="text-red">*</span></label>
                    <input type="number" class="form-control" name="phone" placeholder="Enter Phone No" value="{{ old('phone') }}" required>
                    <span class="text-danger">{{ $errors->has('phone') ? $errors->first('phone') : '' }}</span>
                </div>

                <div class="form-group">
                    <label for="gender">Gender <span class="text-red">*</span></label>
                    <select class="form-control" name="gender" required>
                      <option value="0">Please Select</option>
                      <option value="1">Male</option>
                      <option value="2">Female</option>
                    </select>
                    <span class="text-danger">{{ $errors->has('gender') ? $errors->first('gender') : '' }}</span>
                </div>

                <div class="form-group">
                    <label>Address <span class="text-red">*</span></label>
                    <textarea class="form-control" name="address" placeholder="Enter Address" required>{{ old('address') }}</textarea>
                    <span class="text-danger">{{ $errors->has('address') ? $errors->first('address') : '' }}</span>
                </div>

              </div>

              <div class="col-md-6">
                <div class="form-group">
                    <label for="password">Password <span class="text-red">*</span></label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" value="{{ old('password') }}" required>
                    <span class="text-danger">{{ $errors->has('password') ? $errors->first('password') : '' }}</span>
                </div>

                <div class="form-group">
                    <label for="password">Confirm Password <span class="text-red">*</span></label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Enter Confirm Password" value="{{ old('confirm_password') }}" required onkeyup="checkPass();">
                    <span class="text-danger">{{ $errors->has('confirm_password') ? $errors->first('confirm_password') : '' }}</span>
                    <span id="confirmMessage" class="confirmMessage"></span>
                </div>

                <div class="form-group">
                    <label for="type">User Type <span class="text-red">*</span></label>
                    <select class="form-control" name="type" required  id="type">
                      <option value="admin">Admin</option>
                      <option value="manager">Manager</option>
                    </select>
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
            <div class="row">
              <div class="col-md-6">
                <form action="{{ route('user.update') }}" name="form" method="post" name="edit" enctype="multipart/form-data" autocomplete="off">
                @csrf
                    <div class="form-group">
                        <label for="regional_branch_name">Name <span class="text-red">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{ $userByID->name }}" required>
                        <span class="text-danger">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                    </div>

                    <div class="form-group">
                        <label for="password">Email <span class="text-red">*</span></label>
                        <input type="email" class="form-control" name="email" placeholder="Enter Email" value="{{ $userByID->email }}" required>
                        <span class="text-danger">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
                    </div>

                    <div class="form-group">
                        <label for="password">Phone No <span class="text-red">*</span></label>
                        <input type="text" class="form-control" name="phone" placeholder="Enter Phone No" value="{{ $userByID->phone }}" required>
                        <span class="text-danger">{{ $errors->has('phone') ? $errors->first('phone') : '' }}</span>
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender <span class="text-red">*</span></label>
                        <select class="form-control" name="gender" required>
                          <option value="0">Please Select</option>
                          <option value="1">Male</option>
                          <option value="2">Female</option>
                        </select>
                        <span class="text-danger">{{ $errors->has('gender') ? $errors->first('gender') : '' }}</span>
                    </div>

                    <div class="form-group">
                      <label>Address <span class="text-red">*</span></label>
                      <textarea class="form-control" name="address" placeholder="Enter Address" required>{{ $userByID->address }}</textarea>
                      <span class="text-danger">{{ $errors->has('address') ? $errors->first('address') : '' }}</span>
                  </div>

                    <input type="hidden" name="id" value="<?php echo $userByID->id; ?>"  />

                    <div class="form-group">
                        <label for="address">Update Photograph</label>
                        <input type="file" id="userfile" class="form-control" name="image" value="" onchange="getPreview('userfile','img_preview','none');">
                        <img src="{{ imageShow($userByID->image) }}" style="width:100px; margin-top:5px" id="img_preview" class="img-responsive img-thumbnail"/><br>
                        <code>(Max photo size: 400x400, 512kb)</code>
                    </div>

                    <div class="form-group">
                      <button style="width:100%" type="submit" name="submit" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update Data</button>
                    </div>
                </form>
            </div>

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

                    <input type="hidden" name="id" value="{{ $userByID->id }}" class="form-control">

                    <div class="form-group">
                      <button style="width:100%" type="submit" name="submit" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update Data</button>
                    </div>

                </form>
              </div>
            </div>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
        
        <script type="text/javascript">
          document.forms['form'].elements['gender'].value='<?php echo $userByID->gender?>';
        </script>
      @endisset
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

   <script type="text/javascript">
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
            if(document.form.gender.value == '0'){
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