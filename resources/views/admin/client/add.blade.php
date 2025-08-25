@extends('admin.layout.default')
@section('title')
  Create New Passenger
@endsection
@section('content')

  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      @isset($add)
        <div class="box box-warning">
          <div class="box-header with-border">
            <h3 class="box-title">Create New Passenger</h3>
            <div class="box-tools pull-right">
            </div>
          </div>
          <div class="box-body">
          <form action="{{ route('client.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
          @csrf
            <div class="row">
              <div class="col-md-6">

                <div class="form-group">
                    <label for="Name">Name <span class="text-red">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" required>
                    <span class="text-danger">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                </div>

                <div class="form-group">
                    <label for="password">Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" value="">
                </div>

                <div class="form-group">
                    <label for="password">Phone No <span class="text-red">*</span></label>
                    <input type="number" class="form-control" id="phone" name="phone" placeholder="Enter Phone No" value="" required>
                    <span class="text-danger">{{ $errors->has('phone') ? $errors->first('phone') : '' }}</span>
                </div>

                <div class="form-group">
                    <label for="password">Date Of Birth</label>
                    <input type="text" class="form-control datepicker" name="dob" value="">
                </div>

                <div class="form-group">
                    <label>Passport No <span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="passport_no" placeholder="Enter Passport No" value="" required>
                    <span class="text-danger">{{ $errors->has('passport_no') ? $errors->first('passport_no') : '' }}</span>
                </div>

                 <div class="form-group">
                    <label for="password">Passport Expired Date <span class="text-red">*</span></label>
                    <input type="text" class="form-control datepicker" name="passport_expired_date" value="" required>
                    <span class="text-danger">{{ $errors->has('passport_expired_date') ? $errors->first('passport_expired_date') : '' }}</span>
                </div>

                <div class="form-group">
                    <label for="gender">Gender <span class="text-red">*</span></label>
                    <select class="form-control" name="gender" required>
                      <option value="1">Male</option>
                      <option value="2">Female</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Address <span class="text-red">*</span></label>
                    <textarea class="form-control" name="address" placeholder="Enter Address" required></textarea>
                    <span class="text-danger">{{ $errors->has('address') ? $errors->first('address') : '' }}</span>
                </div>

              </div>

              <div class="col-md-6">

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

                <div class="form-group">
                    <label for="address">Upload Photograph</label>
                    <input type="file" id="userfile" class="form-control" name="image" value="" onchange="getPreview('userfile','img_preview','none');">
                    <img src="<?= asset('admin/img/unknown.png'); ?>" style="width:100px; margin-top:5px" id="img_preview" class="img-responsive img-thumbnail"/><br>
                    <code>(Max photo size: 400x400, 512kb)</code>
                </div>

                <div class="form-group" id="pass_doc">
                    <label for="address">Upload Passport</label>
                    <input type="file" class="form-control" name="passport_doc" value="">
                    <code>(Max size: 512kb)</code>
                </div>

                <div class="form-group">
                    <label for="gender">Is Original Passport Given? <span class="text-red">*</span></label>
                    <select class="form-control" name="is_original_passport_given" required>
                      <option value="YES">YES</option>
                      <option value="NO">NO</option>
                    </select>
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
    </script>

@endsection